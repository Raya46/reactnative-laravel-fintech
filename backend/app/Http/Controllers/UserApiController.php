<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Role;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;

class UserApiController extends Controller
{
    public function postLogin(Request $request)
    {
        $validate = $request->validate([
            "name" => "required",
            "password" => "required",
        ]);
        $token = User::where("name", $request->name)->first()->createToken('auth')->plainTextToken;

        if (!Auth::attempt($validate)) return response()->json([
            'message' => 'wrong username or password',
            'data' => $validate
        ], 404);

        if (Auth::user()->roles_id == 1) return response()->json([
            'message' => 'admin',
            'data' => $validate,
            'token' => $token
        ], 200);

        if (Auth::user()->roles_id == 2) return response()->json([
            'message' => 'kantin',
            'data' => $validate,
            'token' => $token
        ], 200);

        if (Auth::user()->roles_id == 3) return response()->json([
            'message' => 'bank',
            'data' => $validate,
            'token' => $token
        ], 200);


        return response()->json([
            'message' => 'siswa',
            'data' => $validate,
            'token' => $token
        ], 200);
    }

    public function registerUser(Request $request)
    {
        $user = User::create([
            "name" => $request->name,
            "password" => bcrypt($request->password),
            "roles_id" => 1
        ]);

        return response()->json([
            'message' => 'success register siswa',
            'data' => $user
        ], 200);
    }

    public function logout(): JsonResponse
    {
        auth()->user()->tokens()->delete();

        return response()->json([
            'message' => 'Logout success',
        ], 200);
    }

    public function index(Request $request)
    {
        if (!Auth::user()) return response()->json([
            'message' => 'not logged in',
        ], 200);

        $transactionsKeranjang = Transaction::with("products")
            ->where("users_id", Auth::user()->id)
            ->where("status", "dikeranjang")
            ->withTrashed()
            ->get();

        $transactionsBayar = Transaction::with("products")->where("users_id", Auth::user()->id)->where("status", "dibayar")->withTrashed()->get();
        $categories = Category::all();

        $wallets = Wallet::with("user")->get();
        $wallet_count = Wallet::with("user")->where("status", "selesai")->count();
        $wallet_bank = Wallet::with("user")->where("status", "selesai")->get();

        $user = Auth::user();
        $user_deleted = User::onlyTrashed()->get();
        $roles = Role::all();
        $users = User::with("roles")->get();
        $nasabah = User::where("roles_id", "4")->count();
        $product_deleted = Product::onlyTrashed()->get();
        $products = Product::with("transaction")->withTrashed()->get();

        $wallet = Wallet::where("users_id", Auth::user()->id)->where("status", "selesai")->get();
        $creditTotal = $wallet->sum('credit');
        $debitTotal = $wallet->sum('debit');

        $credit_bank = $wallet_bank->sum('credit');
        $debit_bank = $wallet_bank->sum('debit');

        $difference = $creditTotal - $debitTotal;
        $difference_bank = $credit_bank - $debit_bank;
        $filter = $request->filter;
        $category = $request->category;

        if ($category == '' || $category == 'null') {
            $products = Product::with('transaction')->orderBy("name", $filter == '' || $filter == 'null' ? 'asc' : $filter)->get();
        } else {
            $products = Product::with('transaction')->where("categories_id", $category == '' || $category == 'null' ? '1' : $category)->orderBy("created_at", $filter == '' || $filter == 'null' ? 'asc' : $filter)->get();
        }

        if ($user->roles_id == 1) return response()->json([
            'message' => 'success get data admin',
            'user' => $user,
            'wallet' => $wallet,
            'balance' => $difference,
            'products' => $products,
            'transactionsKeranjang' => $transactionsKeranjang,
            'transactionsBayar' => $transactionsBayar,
            'users' => $users,
            'wallet_count' => $wallet_count,
            'roles' => $roles,
            'user_deleted' => $user_deleted
        ], 200);

        if ($user->roles_id == 2) return response()->json([
            'message' => 'success get data kantin',
            'user' => $user,
            'wallet' => $wallet,
            'balance' => $difference,
            'products' => $products,
            'transactionsKeranjang' => $transactionsKeranjang,
            'transactionsBayar' => $transactionsBayar,
            'categories' => $categories,
            'product_deleted' => $product_deleted
        ], 200);

        if ($user->roles_id == 3) return response()->json([
            'message' => 'success get data bank',
            'user' => $user,
            'wallets' => $wallets,
            'balanceBank' => $difference_bank,
            'nasabah' => $nasabah,
            'walletCount' => $wallet_count,
        ], 200);

        return response()->json([
            'message' => 'success get data user',
            'user' => $user,
            'wallet' => $wallet,
            'balance' => $difference,
            'products' => $products,
            'transactionsKeranjang' => $transactionsKeranjang,
            'transactionsBayar' => $transactionsBayar
        ], 200);
    }

    public function roles()
    {
        $user = User::where("roles_id", 4)->get();

        return response()->json([
            "data" => $user
        ]);
    }

    public function createUser()
    {
        $roles = Role::all();

        return response()->json([
            "data" => $roles
        ], 200);
    }

    public function store(Request $request)
    {
        $checkUsername = User::withTrashed()->where('name', $request->name)->first();
        if ($checkUsername)
            return response()->json([
                'message' => 'nama sudah digunakan'
            ], 404);
        $user = User::create([
            'name' => $request->name,
            'password' => $request->password,
            'roles_id' => $request->roles_id
        ]);

        return response()->json([
            'message' => 'store user',
            'data' => $user
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $checkUsername = User::withTrashed()->where('name', $request->name)->first();
        if ($checkUsername && $request->name != $user->name)
            return response()->json([
                'message' => 'nama sudah digunakan'
            ], 404);

        if ($request->password == null || $request->password == "") {
            $user->update([
                'name' => $request->name,
                'password' => $user->password,
                'roles_id' => $request->roles_id
            ]);
            return response()->json([
                'message' => 'success update user',
                'data' => $user
            ], 200);
        } else {
            $user->update([
                'name' => $request->name,
                'password' => $request->password,
                'roles_id' => $request->roles_id
            ]);
            return response()->json([
                'message' => 'success update user',
                'data' => $user
            ], 200);
        }
    }

    public function profileUser()
    {
        $user = Auth::user()->id;
        $dataUser = User::find($user);
        $status = ['diambil', 'dibayar'];
        $transactionsBayar = Transaction::with("products")
            ->where("users_id", $user)
            ->whereIn("status", $status)
            ->get();
        $walletSelesai = Wallet::where("users_id", $user)->where("status", "selesai")->get();
        $creditTotal = $walletSelesai->sum('credit');
        $debitTotal = $walletSelesai->sum('debit');
        $saldo = $creditTotal - $debitTotal;
        $banyak_pembelian = 0;
        $jumlah_pengeluaran = 0;

        foreach ($transactionsBayar as $ts) {
            $banyak_pembelian += $ts->quantity;
            $jumlah_pengeluaran += $ts->price * $ts->quantity;
        }

        return response()->json([
            "data" => $dataUser,
            "saldo" => $saldo,
            "banyak_pembelian" => $banyak_pembelian,
            "jumlah_pengeluaran" => $jumlah_pengeluaran
        ]);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return response()->json([
            'message' => 'success delete user',
            'data' => $user
        ], 200);
    }

    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::all();

        return response()->json([
            "user" => $user,
            "roles" => $roles
        ], 200);
    }

    public function restoreUser($id)
    {
        $user = User::onlyTrashed()->find($id);
        $user->restore();
        return response()->json([
            'message' => 'success restore user',
            'data' => $user
        ], 200);
    }

    public function deletedPermanent($id)
    {
        $userToDelete = User::withTrashed()->find($id);
        $userToDelete->forceDelete();
        return response()->json([
            'message' => 'success delete permanent user',
            'data' => $userToDelete
        ], 200);
    }
}
