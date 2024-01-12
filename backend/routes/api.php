<?php

use App\Http\Controllers\CategoryApiController;
use App\Http\Controllers\ProductApiController;
use App\Http\Controllers\TransactionApiController;
use App\Http\Controllers\UserApiController;
use App\Http\Controllers\WalletApiController;
use Illuminate\Support\Facades\Route;

// Authentication
Route::post("/login", [UserApiController::class, 'postLogin'])->name("login");
Route::post("/register", [UserApiController::class, 'registerUser'])->name("register");

Route::middleware("auth:sanctum")->group(function () {
    // User endpoints
    Route::get("/getsiswa", [UserApiController::class, 'index']);
    Route::get("/profilesiswa", [UserApiController::class, 'profileUser']);
    Route::post("/logout", [UserApiController::class, 'logout'])->name("logout");
    Route::get("/history/{order_code}", [TransactionApiController::class, 'downloadReport']);
    Route::get("/report/all", [TransactionApiController::class, "downloadAll"]);
    Route::get("/get-product-siswa", [ProductApiController::class, "allProduct"]);

    // User-Product endpoints
    Route::post("/addcart", [TransactionApiController::class, 'addToCart']);
    Route::put("/pay-product", [TransactionApiController::class, 'payProduct']);
    Route::delete("/keranjang/delete/{id}", [TransactionApiController::class, 'cancelCart']);
    Route::get("/history", [TransactionApiController::class, 'index']);
    Route::delete("/history-clear", [TransactionApiController::class, 'clearHistoryBuy'])->name('clearHistoryBuy');
    Route::post("/topup", [WalletApiController::class, "topUp"])->name("topUp");
    Route::get("/product/{id}", [ProductApiController::class, "show"]);

    // Admin endpoints
    Route::get("/admin", [UserApiController::class, 'index']);
    Route::get("/report-admin", [TransactionApiController::class, 'reportList']);
    Route::get("/transaction-admin", [TransactionApiController::class, "transactionList"]);

    // Admin category endpoints
    Route::get("/category-admin", [CategoryApiController::class, "index"]);
    Route::post("/category-admin-store", [CategoryApiController::class, "store"]);
    Route::delete("/category-admin-delete/{id}", [CategoryApiController::class, "destroy"]);
    Route::put("/category-admin-update/{id}", [CategoryApiController::class, "update"]);
    Route::get("/category-admin-edit/{id}", [CategoryApiController::class, "edit"]);
    Route::post("/restore-category/{id}", [CategoryApiController::class, "restoreCategory"]);
    Route::delete("/delete-permanent-category/{id}", [CategoryApiController::class, "deletedPermanent"]);

    // Admin user endpoints
    Route::get("/user-admin-create", [UserApiController::class, "createUser"]);
    Route::post("/user-admin-store", [UserApiController::class, "store"])->name('storeUser');
    Route::delete("/user-admin-delete/{id}", [UserApiController::class, "destroy"]);
    Route::get("/user-admin-edit/{id}", [UserApiController::class, "edit"]);
    Route::put("/user-admin-update/{id}", [UserApiController::class, "update"]);
    Route::post("/user-admin-restore/{id}", [UserApiController::class, "restoreUser"]);
    Route::delete("/user-admin-delete-permanent/{id}", [UserApiController::class, "deletedPermanent"]);

    // Bank endpoints
    Route::get("/bank", [UserApiController::class, "index"]);
    Route::get("/roles", [UserApiController::class, "roles"]);
    Route::get("/report-bank", [TransactionApiController::class, 'reportList']);
    Route::put("/topup-success/{id}", [WalletApiController::class, "topUpSuccess"]);
    Route::post("/withdraw", [WalletApiController::class, "withDraw"]);
    Route::post("/withdraw-bank", [WalletApiController::class, "withDrawBank"]);

    // Kantin endpoints
    Route::get("/kantin", [UserApiController::class, 'index']);
    Route::get("/categories", [CategoryApiController::class, 'index']);
    Route::get("/transaction-kantin", [TransactionApiController::class, "transactionList"]);
    Route::post("/create-product", [ProductApiController::class, "store"]);
    Route::post("/create-product-url", [ProductApiController::class, "storeUrl"]);
    Route::put("/product-update/{id}", [ProductApiController::class, "update"]);
    Route::put("/product-update-url/{id}", [ProductApiController::class, "updateProductUrl"]);
    Route::get("/product-edit/{id}", [ProductApiController::class, "edit"]);
    Route::delete("/delete-product/{id}", [ProductApiController::class, "destroy"]);
    Route::delete("/delete-product-url/{id}", [ProductApiController::class, "destroyProductUrl"]);
    Route::put("/transaction-kantin/{id}", [TransactionApiController::class, "takeOrder"]);
    Route::post("/restore-kantin/{id}", [ProductApiController::class, "restoreProduct"]);
    Route::delete("/delete-permanent-kantin/{id}", [ProductApiController::class, "deletedPermanent"]);
    Route::delete("/delete-permanent-kantin-url/{id}", [ProductApiController::class, "deletedPermanent"]);
});
