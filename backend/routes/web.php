<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WalletController;
use Illuminate\Support\Facades\Route;

Route::get("/login", [UserController::class, 'getlogin']);
Route::post("/login", [UserController::class, 'postLogin'])->name("login");
Route::post("/register", [UserController::class, 'registerUser'])->name("register");
Route::get("/register", [UserController::class, 'getRegisterUser']);
Route::get("/logout", [UserController::class, 'logout'])->name("logout");
Route::get("/", [UserController::class, 'index']);

Route::middleware('user')->group(function () {
    Route::post("/", [TransactionController::class, 'addToCart'])->name("addToCart");
    Route::put("/", [TransactionController::class, 'payProduct'])->name("payProduct");
    Route::delete("/keranjang/delete/{id}", [TransactionController::class, 'cancelCart']);
    Route::get("/history", [TransactionController::class, 'index']);
    Route::delete("/history", [TransactionController::class, 'clearHistoryBuy'])->name('clearHistoryBuy');
    Route::post("/topup", [WalletController::class, "topUp"])->name("topUp");
    Route::get("/category-product", [ProductController::class, "allProduct"]);
    Route::get("/product/{id}", [ProductController::class, "show"]);
    Route::post("/product/{id}", [TransactionController::class, "addToCart"]);
    Route::put("/product/{id}", [TransactionController::class, "payProduct"]);
});

Route::middleware('admin')->group(function () {
    Route::get("/admin", [UserController::class, 'index']);
    Route::get("/report-admin", [TransactionController::class, 'reportList']);
    Route::get("/transaction-admin", [TransactionController::class, "transactionList"]);
    Route::get("/category-admin", [CategoryController::class, "index"]);
    Route::post("/category-admin-store", [CategoryController::class, "store"]);
    Route::delete("/category-admin-delete/{id}", [CategoryController::class, "destroy"]);
    Route::put("/category-admin-update/{id}", [CategoryController::class, "update"]);
    Route::post("/restore-category/{id}", [CategoryController::class, "restoreCategory"]);
    Route::delete("/delete-permanent-category/{id}", [CategoryController::class, "deletedPermanent"]);
    Route::post("/user-admin-store", [UserController::class, "store"])->name('storeUser');
    Route::delete("/user-admin-delete/{id}", [UserController::class, "destroy"]);
    Route::put("/user-admin-update/{id}", [UserController::class, "update"]);
    Route::post("/user-admin-restore/{id}", [UserController::class, "restoreUser"]);
    Route::delete("/user-admin-trash/{id}", [UserController::class, "deletedPermanent"]);
});

Route::middleware('bank')->group(function () {
    Route::get("/bank", [UserController::class, "index"]);
    Route::get("/report-bank", [TransactionController::class, 'reportList']);
    Route::put("/topup/{id}", [WalletController::class, "topUpSuccess"]);
});

Route::middleware('kantin')->group(function () {
    Route::get("/kantin", [UserController::class, 'index']);
    Route::get("/transaction-kantin", [TransactionController::class, "transactionList"]);
    Route::get("/create-product", [ProductController::class, "create"]);
    Route::post("/create-product", [ProductController::class, "store"])->name('storeProduct');
    Route::get("/edit-product/{id}", [ProductController::class, "edit"]);
    Route::put("/product-update/{id}", [ProductController::class, "update"])->name("updateProduct");
    Route::delete("/delete-product/{id}", [ProductController::class, "destroy"])->name('destroyProduct');
    Route::put("/transaction-kantin/{id}", [TransactionController::class, "takeOrder"]);
    Route::post("/restore-kantin/{id}", [ProductController::class, "restoreProduct"]);
    Route::delete("/delete-permanent-kantin/{id}", [ProductController::class, "deletedPermanent"]);
});

Route::get("/history/{order_code}", [TransactionController::class, 'downloadReport']);
Route::get("/report/all", [TransactionController::class, "downloadAll"]);
