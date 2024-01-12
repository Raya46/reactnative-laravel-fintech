<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::withTrashed()->get();
        $categories = Category::all();

        return view('home', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();

        return view("tambahProduct", compact("categories"));
    }

    public function store(Request $request)
    {
        $date = now()->format("dmYHis");
        $photoPath = "/photos/$date.png";
        if ($request->hasFile('photo')) {
            $request->file('photo')->move("photos/", "$date.png");
        }

        Product::create([
            "name" => $request->name,
            "price" => $request->price,
            "stock" => $request->stock,
            "photo" => $photoPath,
            "desc" => $request->desc,
            "categories_id" => $request->categories_id,
            "stand" => $request->stand,
        ]);


        return redirect()->back();
    }


    public function show($id)
    {
        $product = Product::findOrFail($id);
        $wallet = Wallet::where("users_id", Auth::user()->id)->where("status", "selesai")->get();
        $creditTotal = $wallet->sum('credit');
        $debitTotal = $wallet->sum('debit');
        $difference = $creditTotal - $debitTotal;
        $transactionsKeranjang = Transaction::with("products")->where("users_id", Auth::user()->id)->where("status", "dikeranjang")->get();

        return view("detail", compact("product", "transactionsKeranjang", "difference"));
    }


    public function edit(Request $request, $id)
    {
        $product = Product::find($id);
        $categories = Category::all();
        return view('editProduct', compact('product', 'categories'));
    }


    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        $productImagePath = $product->photo;
        $date = now()->format("dmYHis");

        if ($request->hasFile('photo')) {
            $request->file('photo')->move("photos/", "$date.png");
            if (!unlink(public_path($productImagePath))) {
                Storage::delete($product->photo);
            } else {
                Storage::delete($product->photo);
            }
            $photoPath = "/photos/$date.png";
        } else {
            $photoPath = $product->photo;
        }

        $product->update([
            "name" => $request->name,
            "price" => $request->price,
            "stock" => $request->stock,
            "photo" => $photoPath,
            "desc" => $request->desc,
            "categories_id" => $request->categories_id,
            "stand" => $request->stand
        ]);

        return redirect()->back();
    }


    public function destroy($id)
    {
        $productToDelete = Product::withTrashed()->find($id);

        if (!is_null($productToDelete)) {
            $photoPath = $productToDelete->photo;

            if (!empty($photoPath)) {
                if (!unlink(public_path($photoPath))) {
                    Storage::delete($productToDelete->photo);
                } else {
                    Storage::delete($productToDelete->photo);
                }
            }
            $productToDelete->delete();
        }
        return redirect()->back();
    }

    public function allProduct(Request $request)
    {
        $transactionsKeranjang = Transaction::with("products")->where("users_id", Auth::user()->id)->where("status", "dikeranjang")->get();
        $transactionsBayar = Transaction::with("products")->where("users_id", Auth::user()->id)->where("status", "dibayar")->get();
        $wallet = Wallet::where("users_id", Auth::user()->id)->where("status", "selesai")->get();
        $creditTotal = $wallet->sum('credit');
        $debitTotal = $wallet->sum('debit');
        $difference = $creditTotal - $debitTotal;

        $products = null;
        $category = $request->index;
        $category_id = Category::where("name", $category)->first();

        if ($category == "") {
            $products = Product::all();
        } else {
            $products = Product::where("categories_id", $category_id->id)->get();
        }

        return view("category_product", compact("products", "difference", "transactionsKeranjang"));
    }

    public function restoreProduct($id)
    {
        $product = Product::onlyTrashed()->find($id);

        $product->restore();

        return redirect()->back();
    }

    public function deletedPermanent($id)
    {
        try {
            $productToDelete = Product::onlyTrashed()->find($id);

            $productImagePath = $productToDelete->photo;

            if (!Storage::exists($productImagePath)) {
                $productToDelete->forceDelete();
            }

            if (!unlink(public_path($productImagePath))) {
                Storage::delete($productImagePath);
            }

            $productToDelete->forceDelete();
        } catch (\Throwable $th) {
            echo ("loading");
        }


        return redirect()->back();
    }
}
