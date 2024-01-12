<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryApiController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        // $categories_delete = Category::withTrashed()->get();

        return response()->json([
            'message' => 'index category',
            'categories' => $categories,
            // 'categories_delete' => $categories_delete
        ], 200);
    }

    public function store(Request $request)
    {
        $category = Category::create([
            "name" => $request->name,
        ]);

        return response()->json([
            'message' => 'store category',
            'data' => $category
        ], 200);
    }

    public function destroy($id)
    {
        $category = Category::find($id);

        $category->delete();

        return response()->json([
            'message' => 'delete category',
            'data' => $category
        ], 200);
    }

    public function edit($id)
    {
        $category = Category::find($id);

        return response()->json([
            "data" => $category
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);

        $category->update([
            "name" => $request->name
        ]);

        return response()->json([
            'message' => 'update category',
            'data' => $category
        ], 200);
    }

    public function deletedPermanent($id)
    {
        $categoryDelete = Category::withTrashed()->find($id);
        $categoryDelete->forceDelete();

        return response()->json([
            'message' => 'deleted permanent category',
            'data' => $categoryDelete
        ], 200);
    }

    public function restoreCategory($id)
    {
        $product = Category::withTrashed()->find($id);
        $product->restore();

        return response()->json([
            'message' => 'restore category',
            'data' => $product
        ], 200);
    }
}
