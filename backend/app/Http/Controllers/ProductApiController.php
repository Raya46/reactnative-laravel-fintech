<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductApiController extends Controller
{
    public function index()
    {
        $products = Product::withTrashed()->get();
        $categories = Category::all();

        return response()->json([
            'message' => 'index product',
            'products' => $products,
            'categories' => $categories
        ], 200);
    }

    public function store(Request $request)
    {
        $date = now()->format("dmYHis");
        $photoPath = "/photos/$date.png";
        if ($request->hasFile('photo')) {
            $request->file('photo')->move("photos/", "$date.png");
        }

        $product = Product::create([
            "name" => $request->name,
            "price" => $request->price,
            "stock" => $request->stock,
            "photo" => $photoPath,
            "desc" => $request->desc,
            "categories_id" => $request->categories_id,
            "stand" => $request->stand,
        ]);

        return response()->json([
            'message' => 'store product',
            'data' => $product
        ], 200);
    }

    public function storeUrl(Request $request)
    {
        $product = Product::create([
            "name" => $request->name,
            "price" => $request->price,
            "stock" => $request->stock,
            "photo" => $request->photo,
            "desc" => $request->desc,
            "categories_id" => $request->categories_id,
            "stand" => $request->stand,
        ]);

        return response()->json([
            'message' => 'store product',
            'data' => $product
        ], 200);
    }


    public function show($id)
    {
        $product = Product::findOrFail($id);
        $wallet = Wallet::where("users_id", Auth::user()->id)->where("status", "selesai")->get();
        $creditTotal = $wallet->sum('credit');
        $debitTotal = $wallet->sum('debit');
        $difference = $creditTotal - $debitTotal;
        $transactionsKeranjang = Transaction::with("products")->where("users_id", Auth::user()->id)->where("status", "dikeranjang")->get();

        return response()->json([
            'message' => 'show product',
            'product' => $product,
            'wallet' => $wallet,
            'creditTotal' => $creditTotal,
            'debitTotal' => $debitTotal,
            'difference' => $difference,
            'transactionsKeranjang' => $transactionsKeranjang,
        ], 200);
    }

    public function edit($id)
    {
        $products = Product::withTrashed()->find($id);
        $categories = Category::all();

        return response()->json([
            'products' => $products,
            'categories' => $categories
        ], 200);
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

        return response()->json([
            'message' => 'update product',
            'data' => $product
        ], 200);
    }

    public function updateProductUrl(Request $request, $id)
    {
        $product = Product::find($id);
        $product->update([
            "name" => $request->name,
            "price" => $request->price,
            "stock" => $request->stock,
            "photo" => $request->photo,
            "desc" => $request->desc,
            "categories_id" => $request->categories_id,
            "stand" => $request->stand
        ]);

        return response()->json([
            'message' => 'update product',
            'data' => $product
        ], 200);
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

        return response()->json([
            'message' => 'delete product',
            'data' => $productToDelete
        ], 200);
    }

    public function destroyProductUrl($id)
    {
        $productToDelete = Product::withTrashed()->find($id);

        $productToDelete->delete();

        return response()->json([
            'message' => 'delete product',
            'data' => $productToDelete
        ], 200);
    }

    public function deletedPermanentUrl($id)
    {
        $productToDelete = Product::withTrashed()->find($id);

        $productToDelete->forceDelete();

        return response()->json([
            'message' => 'delete product',
            'data' => $productToDelete
        ], 200);
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
        return response()->json([
            'message' => 'all products',
            'products' => $products,
            'difference' => $difference,
            'transactionsKeranjang' => $transactionsKeranjang,
            'transactionsBayar' => $transactionsBayar,
        ], 200);
    }

    public function restoreProduct($id)
    {
        $product = Product::withTrashed()->find($id);

        $product->restore();

        return response()->json([
            'message' => 'restore product',
            'data' => $product
        ], 200);
    }

    public function deletedPermanent($id)
    {
        try {
            $productToDelete = Product::withTrashed()->find($id);

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

        return response()->json([
            'message' => 'deleted permanent',
            'data' => $productToDelete
        ], 200);
    }
}
