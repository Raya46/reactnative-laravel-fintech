<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use App\Models\UserTransaction;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {
        $transactionsKeranjang = Transaction::with("products")->where("users_id", Auth::user()->id)->where("status", "dikeranjang")->get();
        $laporanPembayaran = Transaction::with("products")->where("users_id", Auth::user()->id)->where("status", "dibayar")->get()->groupBy('order_code');
        $transactionsBayar = Transaction::with("products")->where("users_id", Auth::user()->id)->where("status", "dibayar")->get();
        $walletSelesai = Wallet::where("users_id", Auth::user()->id)->where("status", "selesai")->get();
        $walletProcess = Wallet::where("users_id", Auth::user()->id)->where("status", "process")->get();
        $creditTotal = $walletSelesai->sum('credit');
        $debitTotal = $walletSelesai->sum('debit');
        $difference = $creditTotal - $debitTotal;

        return view("history", compact("transactionsKeranjang", "transactionsBayar", "difference", "laporanPembayaran", "walletProcess", "walletSelesai"));
    }

    public function transactionList()
    {
        $status = ['diambil', 'dibayar'];
        $transactions = Transaction::with("products", "user", "userTransactions")
            ->whereIn("status", $status)->get();

        return view("transaction", compact("transactions"));
    }

    public function takeOrder($id)
    {
        $transaction = Transaction::find($id);
        $transaction->update([
            "status" => "diambil"
        ]);

        return redirect()->back();
    }

    public function downloadAll(Request $request)
    {
        $category = $request->index;

        if ($category == "") {
            $transactions = Transaction::with("products", "user", "userTransactions")->get();
        } else {
            $transactions = Wallet::all();
        }

        return view("downloadall", compact("transactions", "category"));
    }

    public function reportList()
    {
        $status = ['diambil', 'dibayar'];
        $laporanPembayaran = Transaction::whereIn("status", $status)->get()->groupBy("order_code");

        return view('report', compact("laporanPembayaran"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function payProduct()
    {
        $wallet = Wallet::where("users_id", Auth::user()->id)->first();
        $creditTotal = $wallet->sum('credit');
        $debitTotal = $wallet->sum('debit');
        $difference = $creditTotal - $debitTotal;
        $order_code = "INV_" . Auth::user()->id . now()->format("dmYHis");
        $transactionKeranjang = Transaction::with("products")
            ->where("users_id", Auth::user()->id)
            ->where("status", "dikeranjang")
            ->withTrashed()
            ->get();
        $totalBayar = 0;
        $bayar_habis = 0;
        $barang_habis = "";
        $produk_terhapus = Product::withTrashed()
            ->whereNotNull('deleted_at')
            ->whereHas('transaction', function ($query) {
                $query->where('status', 'dikeranjang');
            })->get();
        $hapus = 0;
        $nama_hapus = "";
        $stock_habis = Transaction::whereHas('products', function ($query) {
            $query->where('stock', 0);
        })->with("products")->where('status', 'dikeranjang')->withTrashed()->get();

        foreach ($transactionKeranjang as $ts) {
            $totalBayar += ($ts->price * $ts->quantity);
            $produk = $ts->products;
            $jumlah_dibeli = $ts->quantity;
            $stok_saat_ini = $ts->products->stock;

            if ($stok_saat_ini >= $jumlah_dibeli) {
                $stok_baru = $stok_saat_ini - $jumlah_dibeli;
                $produk->stock = $stok_baru;
                $produk->save();
            } else {
                return redirect()->back()->with("message_keranjang", "stock $produk->name kurang");
            }
        }

        if ($transactionKeranjang->count() == 0) return redirect()->back()->with("message_keranjang", "keranjang kosong");

        if ($produk_terhapus->isNotEmpty()) {
            foreach ($produk_terhapus as $key) {
                $nama_hapus = $key->name;
                $hapus = $key->price * $key->transaction->quantity;
                $key->transaction->delete();
            }
            Transaction::where("users_id", Auth::user()->id)
                ->where("status", "dikeranjang")
                ->update([
                    'status' => 'dibayar',
                    'order_code' => $order_code
                ]);
            $wallet->update([
                'debit' => $wallet->debit + ($totalBayar - $hapus),
            ]);
            return redirect()->back()->with("message_keranjang", "$nama_hapus gagal beli barang dihapus");
        } else {
            Transaction::where("users_id", Auth::user()->id)
                ->where("status", "dikeranjang")
                ->update([
                    'status' => 'dibayar',
                    'order_code' => $order_code
                ]);
            $wallet->update([
                'debit' => $wallet->debit + $totalBayar,
            ]);
            return redirect()->back();
        }

        if ($difference < $totalBayar) return redirect()->back()->with("message_keranjang", "saldo tidak cukup");

        if ($stock_habis) {
            foreach ($stock_habis as $transaction) {
                $barang_habis = $transaction->products->name;
                $bayar_habis = $transaction->products->price * $transaction->quantity;
                $transaction->delete();
            }
            Transaction::where("users_id", Auth::user()->id)
                ->where("status", "dikeranjang")
                ->update([
                    'status' => 'dibayar',
                    'order_code' => $order_code
                ]);
            $wallet->update([
                'debit' => $wallet->debit + ($totalBayar - $bayar_habis),
            ]);
            return redirect()->back()->with("message_keranjang", "$barang_habis gagal beli barang habis");
        }

        Transaction::where("users_id", Auth::user()->id)
            ->where("status", "dikeranjang")
            ->update([
                'status' => 'dibayar',
                'order_code' => $order_code
            ]);
        $wallet->update([
            'debit' => $wallet->debit + $totalBayar,
        ]);


        return redirect()->back();
    }

    public function payNow(Request $request, $id)
    {
        $order_code = "INV_" . Auth::user()->id . now()->format("dmYHis");
        $wallet = Wallet::where("users_id", Auth::user()->id)->find(2);

        Transaction::create([
            "users_id" => Auth::user()->id,
            "products_id" => $id,
            "status" => "dibayar",
            "order_code" => $order_code,
            "price" => $request->price,
            "quantity" => $request->quantity
        ]);

        $wallet->update([
            'debit' => $wallet->debit + ($request->price * $request->quantity)
        ]);

        return redirect()->back();
    }

    public function cancelCart($id)
    {
        $transaction = Transaction::withTrashed()->find($id);

        if ($transaction) {
            $transaction->forceDelete();
            return redirect()->back()->with('success', 'Transaksi berhasil dihapus secara permanen.');
        } else {
            return redirect()->back()->with('error', 'Transaksi tidak ditemukan.');
        }

        return redirect()->back();
    }

    public function clearHistoryBuy()
    {
        $transactionsBayar = Transaction::with("products")->where("users_id", Auth::user()->id)->where("status", "dibayar");
        $transactionsBayar->delete();

        return redirect()->back();
    }

    public function addToCart(Request $request)
    {
        $order_code = "INV_" . Auth::user()->id . now()->format("dmYHis");
        $same_transaction = Transaction::withTrashed()->where("products_id", $request->products_id)->where("users_id", Auth::user()->id)->where("status", "dikeranjang")->first();
        $product = Product::withTrashed()->find($request->products_id);

        if ($product->stock == 0) return redirect()->back()->with("message_keranjang", "stock habis");

        if ($same_transaction) {
            $sum_quantity = $same_transaction->quantity += $request->quantity;
            $same_transaction->update([
                "quantity" => $sum_quantity,
            ]);
        } else {
            $transaction = Transaction::create([
                "users_id" => Auth::user()->id,
                "products_id" => $request->products_id,
                "status" => "dikeranjang",
                "order_code" => $order_code,
                "price" => $request->price,
                "quantity" => $request->quantity
            ]);

            UserTransaction::create([
                "user_id" => $transaction->users_id,
                "transaction_id" => $transaction->id
            ]);
        }

        return redirect()->back();
    }

    public function downloadReport($order_code)
    {
        $report = Transaction::with("products")->where("order_code", $order_code)->get();
        $code = $order_code;

        return view('download', compact('report', 'code'));
    }
}
