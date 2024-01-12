<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $categories_delete = Category::onlyTrashed()->get();

        return view('category', compact('categories', 'categories_delete'));
    }

    public function store(Request $request)
    {
        Category::create([
            "name" => $request->name,
        ]);
        return redirect()->back();
    }

    public function destroy($id)
    {
        $category = Category::find($id);

        $category->delete();

        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);

        $category->update([
            "name" => $request->name
        ]);

        return redirect()->back();
    }

    public function deletedPermanent($id)
    {
        $categoryDelete = Category::onlyTrashed()->find($id);
        $categoryDelete->forceDelete();

        return redirect()->back();
    }

    public function restoreCategory($id)
    {
        $product = Category::onlyTrashed()->find($id);
        $product->restore();

        return redirect()->back();
    }
}
