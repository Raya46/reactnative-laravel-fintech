<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WalletController extends Controller
{

    public function index()
    {
        $wallets = Wallet::with("user")->get();

        return view("bank", compact("wallets"));
    }

    public function topUp(Request $request)
    {
        $user = Auth::user()->id;

        Wallet::create([
            "users_id" => $user,
            "credit" => $request->credit,
            "status" => "process"
        ]);

        return redirect()->back();
    }

    public function topUpSuccess($id)
    {
        $wallet = Wallet::find($id);

        $wallet->update([
            "status" => "selesai"
        ]);

        return redirect()->back();
    }
}
