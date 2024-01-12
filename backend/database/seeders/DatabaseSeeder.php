<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Product;
use App\Models\Role;
use App\Models\Transaction;
use App\Models\User;
use App\Models\UserTransaction;
use App\Models\Wallet;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Role::create([
            "name" => "admin",
        ]);
        Role::create([
            "name" => "kantin",
        ]);
        Role::create([
            "name" => "bank",
        ]);
        Role::create([
            "name" => "siswa",
        ]);

        Category::create([
            "name" => "minuman"
        ]);
        Category::create([
            "name" => "makanan"
        ]);
        Category::create([
            "name" => "pakaian"
        ]);

        User::create([
            "name" => "raya",
            "password" => "123",
            "roles_id" => 1,

        ]);
        User::create([
            "name" => "iksan",
            "password" => "678",
            "roles_id" => 2,

        ]);
        User::create([
            "name" => "rizki",
            "password" => "999",
            "roles_id" => 3,

        ]);
        User::create([
            "name" => "rapael",
            "password" => "890",
            "roles_id" => 4,

        ]);
        User::create([
            "name" => "faris",
            "password" => "345",
            "roles_id" => 4,

        ]);

        Product::create([
            "name" => "lemon ice tea",
            "price" => 5000,
            "stock" => 100,
            "desc" => "desc lemon es rrq lemon",
            "photo" => "/photos/lemon.png",
            "categories_id" => 1,
            "stand" => 2,
            "created_at" => "2023-10-25 01:50:58"
        ]);
        Product::create([
            "name" => "bakso",
            "price" => 10000,
            "stock" => 50,
            "desc" => "desc bakso evos bakso",
            "photo" => "/photos/bakso.png",
            "categories_id" => 2,
            "stand" => 1,
            "created_at" => "2023-10-25 01:50:59"
        ]);
        Product::create([
            "name" => "celana hypebeast",
            "price" => 500000,
            "stock" => 15,
            "desc" => "desc celana hypebeast evos celana hypebeast",
            "photo" => "/photos/clg3.png",
            "categories_id" => 3,
            "stand" => 4,
            "created_at" => "2023-10-25 01:50:51"
        ]);
        Product::create([
            "name" => "baju hypebeast",
            "price" => 3000,
            "stock" => 10,
            "desc" => "desc baju hypebeast evos baju hypebeast",
            "photo" => "/photos/clg2.png",
            "categories_id" => 3,
            "stand" => 4,
            "created_at" => "2023-10-25 01:50:52"
        ]);
        Product::create([
            "name" => "topi hypebeast",
            "price" => 200000,
            "stock" => 60,
            "desc" => "desc topi hypebeast evos topi hypebeast",
            "photo" => "/photos/clg1.png",
            "categories_id" => 3,
            "stand" => 4,
            "created_at" => "2023-10-25 01:50:40"
        ]);

        Wallet::create([
            "users_id" => 4,
            "credit" => 100000,
            "debit" => NULL,
            "status" => "selesai"
        ]);
        Wallet::create([
            "users_id" => 4,
            "credit" => NULL,
            "debit" => 15000,
            "status" => "selesai"
        ]);

        Transaction::create([
            "users_id" => 4,
            "products_id" => 1,
            "status" => "dibayar",
            "order_code" => "INV_12345",
            "price" => 5000,
            "quantity" => 1
        ]);
        Transaction::create([
            "users_id" => 4,
            "products_id" => 2,
            "status" => "dibayar",
            "order_code" => "INV_12345",
            "price" => 10000,
            "quantity" => 1
        ]);
        Transaction::create([
            "users_id" => 4,
            "products_id" => 3,
            "status" => "dibayar",
            "order_code" => "INV_12345",
            "price" => 3000,
            "quantity" => 2
        ]);

        UserTransaction::create([
            "user_id" => 4,
            "transaction_id" => 1,
        ]);
        UserTransaction::create([
            "user_id" => 4,
            "transaction_id" => 2,
        ]);
        UserTransaction::create([
            "user_id" => 4,
            "transaction_id" => 3,
        ]);
    }
}
