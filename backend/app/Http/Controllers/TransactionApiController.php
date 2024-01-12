<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use App\Models\UserTransaction;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionApiController extends Controller
{

    public function index()
    {
        $status = ['diambil', 'dibayar'];
        $transactionsKeranjang = Transaction::with("products")->where("users_id", Auth::user()->id)->where("status", "dikeranjang")->get();
        $laporanPembayaran = Transaction::with("products")->where("users_id", Auth::user()->id)->whereIn("status", $status)->get()->groupBy('order_code');
        $transactionsBayar = Transaction::with("products")->where("users_id", Auth::user()->id)->whereIn("status", $status)->get();
        $walletSelesai = Wallet::where("users_id", Auth::user()->id)->where("status", "selesai")->get();
        $walletProcess = Wallet::where("users_id", Auth::user()->id)->where("status", "process")->get();
        $creditTotal = $walletSelesai->sum('credit');
        $debitTotal = $walletSelesai->sum('debit');
        $difference = $creditTotal - $debitTotal;
        $totalPrice = 0;
        $keranjanglength = 0;

        foreach ($transactionsKeranjang as $ts) {
            $totalPrice += $ts->price * $ts->quantity;
            $keranjanglength += $ts->quantity;
        }

        return response()->json([
            'message' => 'index transaction',
            'transactionsKeranjang' => $transactionsKeranjang,
            'keranjanglength' => $keranjanglength,
            'totalPrice' => $totalPrice,
            'laporanPembayaran' => $laporanPembayaran,
            'transactionsBayar' => $transactionsBayar,
            'walletSelesai' => $walletSelesai,
            'walletProcess' => $walletProcess,
            'difference' => $difference,
        ], 200);
    }

    public function transactionList()
    {
        $status = ['diambil', 'dibayar'];
        $transactions = Transaction::withTrashed()->with("products", "user", "userTransactions")
            ->whereIn("status", $status)->get();

        return response()->json([
            'message' => 'get transaction list',
            'transactions' => $transactions
        ], 200);
    }

    public function takeOrder($id)
    {
        $transaction = Transaction::find($id);
        $transaction->update([
            "status" => "diambil"
        ]);

        return response()->json([
            'message' => 'take order',
            'transaction' => $transaction
        ], 200);
    }

    public function downloadAll(Request $request)
    {
        $category = $request->index;

        if ($category == "") {
            $transactions = Transaction::with("products", "user", "userTransactions")->get();
        } else {
            $transactions = Wallet::all();
        }

        return response()->json([
            'message' => 'download all',
            'transactions' => $transactions,
            'category' => $category
        ], 200);
    }

    public function reportList()
    {
        $status = ['diambil', 'dibayar'];
        $laporanPembayaran = Transaction::withTrashed()->with("products")->whereIn("status", $status)->get()->groupBy("order_code");
        $transactions = Transaction::withTrashed()->with("products", "userTransactions")->whereIn("status", $status)->get();

        return response()->json([
            'message' => 'report list',
            'laporanPembayaran' => $laporanPembayaran,
            'transactions' => $transactions
        ], 200);
    }

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
        $transactionBayar = Transaction::withTrashed()->with("products")->where("users_id", Auth::user()->id)->where("status", "dibayar")->first();
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
                return response()->json([
                    "message" => "stock $produk->name kurang"
                ], 404);
            }
        }

        if ($transactionKeranjang->count() == 0) return response()->json(['message' => 'keranjang kosong'], 404);

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
            return response()->json([
                "message" => "$nama_hapus gagal beli barang dihapus"
            ], 404);
        } else {
            Transaction::where("users_id", Auth::user()->id)
                ->where("status", "dikeranjang")->update([
                    'status' => 'dibayar',
                    'order_code' => $order_code
                ]);
            $wallet->update([
                'debit' => $wallet->debit + $totalBayar,
            ]);
            return response()->json([
                "message" => "success buy",
                "data" => $transactionBayar
            ], 200);
        }

        if ($difference < $totalBayar) return response()->json(["message" => "saldo tidak cukup"], 404);

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
            return response()->json([
                "message" => "$barang_habis gagal beli barang habis"
            ], 404);
        }

        Transaction::where("users_id", Auth::user()->id)
            ->where("status", "dikeranjang")->update([
                'status' => 'dibayar',
                'order_code' => $order_code
            ]);
        $wallet->update([
            'debit' => $wallet->debit + $totalBayar,
        ]);

        return response()->json([
            "message" => "success buy",
            "data" => $transactionBayar
        ], 200);
    }

    public function cancelCart($id)
    {
        $transaction = Transaction::withTrashed()->find($id);

        if ($transaction) {
            $transaction->forceDelete();
            return response()->json([
                'message' => 'Transaksi berhasil dihapus secara permanen.',
                'data' => $transaction
            ], 200);
        } else {
            return response()->json([
                'message' => 'error not found',
            ], 404);
        }
    }

    public function clearHistoryBuy()
    {
        $status = ['diambil', 'dibayar'];
        $transactionsBayar = Transaction::with("products")->where("users_id", Auth::user()->id)->whereIn("status", $status);
        $transactionsBayar->delete();

        return response()->json([
            'message' => 'clear history buy',
            'data' => $transactionsBayar
        ], 200);
    }

    public function addToCart(Request $request)
    {
        $order_code = "INV_" . Auth::user()->id . now()->format("dmYHis");
        $same_transaction = Transaction::withTrashed()->where("products_id", $request->products_id)->where("users_id", Auth::user()->id)->where("status", "dikeranjang")->first();
        $product = Product::withTrashed()->find($request->products_id);

        if ($product->stock == 0)
            return response()->json([
                'message' => 'stock habis'
            ], 404);

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

        return response()->json([
            'message' => 'success add to cart',
            'data' => $transaction
        ], 200);
    }

    public function downloadReport($order_code)
    {
        $report = Transaction::withTrashed()->with("products", "userTransactions")->where("order_code", $order_code)->get();
        $code = $order_code;
        $totalPrice = 0;
        foreach ($report as $rep) {
            $totalPrice += $rep->price * $rep->quantity;
        }

        return response()->json([
            'message' => 'success download report',
            'totalPrice' => $totalPrice,
            'report' => $report,
            'code' => $code
        ], 200);
    }
}
