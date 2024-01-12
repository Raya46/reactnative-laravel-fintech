@extends('template.app_home')

@section('sidebar_features')
    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.9.3/dist/full.css" rel="stylesheet" type="text/css" />
    <li class="flex items-center gap-3">
        <div class="flex flex-col items-center justify-center bg-slate-950 rounded-full p-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="fill-white"
                viewBox="0 0 16 16">
                <path
                    d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.707 1.5ZM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5 5 5Z" />
            </svg>
        </div>
        <a href="/kantin" class="hover:text-gray-300">Home</a>
    </li>
    <li class="flex items-center gap-3">
        <div class="flex flex-col items-center justify-center bg-slate-950 rounded-full p-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="fill-white"
                viewBox="0 0 16 16">
                <path
                    d="M12.136.326A1.5 1.5 0 0 1 14 1.78V3h.5A1.5 1.5 0 0 1 16 4.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 13.5v-9a1.5 1.5 0 0 1 1.432-1.499L12.136.326zM5.562 3H13V1.78a.5.5 0 0 0-.621-.484L5.562 3zM1.5 4a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-13z" />
            </svg>
        </div>
        <a href="/transaction-kantin" class="hover:text-gray-300">Transaction</a>
    </li>
@endsection

@section('content')
    <div class="container mx-auto">
        <div class="flex flex-col w-full bg-white p-4 rounded-lg h-full border border-slate-300 text-black">
            <span class="text-2xl">Hello, {{ $user->roles->name }} 👋</span>
            <div class="flex justify-between my-4">
                <div class="flex gap-2 items-center ">
                    <span class="text-lg">Filter By</span>
                    <select id="dropdown" class="border rounded p-2 px-3 bg-white">
                        <option class="selectedValue" value="asc">terbaru</option>
                        <option class="selectedValue " value="desc">terlama</option>
                    </select>
                    <select id="category" class="border rounded p-2 px-3 bg-white">
                        <option class="selectedCategory" value="1">minuman</option>
                        <option class="selectedCategory" value="2">makanan</option>
                        <option class="selectedCategory" value="3">pakaian</option>
                    </select>
                </div>
                <div class="flex gap-2">
                    <a href="#my_modal_add" class="btn btn-success">Add Product</a>
                    <a href="#my_modal_delete" class="btn btn-error">Trash</a>
                    <div class="modal" id="my_modal_delete">
                        <div class="modal-box">
                            <div class="flex flex-col w-full">
                                <div class="flex justify-between items-center">
                                    <span>Deleted Bin</span>
                                    <div class="flex gap-2">
                                        <a href="#" class="btn mb-2">X</a>
                                    </div>
                                </div>
                                @foreach ($product_deleted as $pdl)
                                    <div class="flex justify-between items-center">
                                        <span>{{ $pdl->name }}</span>
                                        <div class="flex gap-2">
                                            <form action="/restore-kantin/{{ $pdl->id }}" method="post">
                                                @csrf
                                                <button type="submit" class="btn btn-success"><svg
                                                        xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="fill-green-800" viewBox="0 0 16 16">
                                                        <path
                                                            d="M9.302 1.256a1.5 1.5 0 0 0-2.604 0l-1.704 2.98a.5.5 0 0 0 .869.497l1.703-2.981a.5.5 0 0 1 .868 0l2.54 4.444-1.256-.337a.5.5 0 1 0-.26.966l2.415.647a.5.5 0 0 0 .613-.353l.647-2.415a.5.5 0 1 0-.966-.259l-.333 1.242-2.532-4.431zM2.973 7.773l-1.255.337a.5.5 0 1 1-.26-.966l2.416-.647a.5.5 0 0 1 .612.353l.647 2.415a.5.5 0 0 1-.966.259l-.333-1.242-2.545 4.454a.5.5 0 0 0 .434.748H5a.5.5 0 0 1 0 1H1.723A1.5 1.5 0 0 1 .421 12.24l2.552-4.467zm10.89 1.463a.5.5 0 1 0-.868.496l1.716 3.004a.5.5 0 0 1-.434.748h-5.57l.647-.646a.5.5 0 1 0-.708-.707l-1.5 1.5a.498.498 0 0 0 0 .707l1.5 1.5a.5.5 0 1 0 .708-.707l-.647-.647h5.57a1.5 1.5 0 0 0 1.302-2.244l-1.716-3.004z" />
                                                    </svg>
                                                </button>
                                            </form>
                                            <form action="/delete-permanent-kantin/{{ $pdl->id }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn mb-2 btn-error">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                        <path
                                                            d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z" />
                                                        <path
                                                            d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z" />
                                                    </svg>
                                                </button>
                                            </form>

                                        </div>

                                    </div>
                                @endforeach
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal" id="my_modal_add">
                    <div class="modal-box">
                        <div class="flex flex-col w-full">
                            <div class="flex justify-between items-center">
                                <span>Add Product</span>
                                <a href="#" class="btn mb-2">X</a>
                            </div>
                            <form action="{{ route('storeProduct') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <span>Name</span>
                                <input type="text" name="name" class="mb-2 w-full input input-bordered">
                                <div class="flex w-full justify-between gap-2">
                                    <div class="flex flex-col w-full">
                                        <span>Price</span>
                                        <input type="number" name="price" class="input input-bordered">
                                        <span>Stock</span>
                                        <input type="number" name="stock" class="input input-bordered">
                                    </div>
                                    <div class="flex flex-col w-full">
                                        <span>Stand</span>
                                        <input type="number" name="stand" class="input input-bordered">
                                        <span>Category</span>
                                        <select name="categories_id" class="input input-bordered">
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <span>Photo</span>
                                <input type="file" name="photo" class="w-full">
                                <label class="mt-2">Description</label>
                                <textarea type="text" name="desc" class="input input-bordered w-full mt-2"></textarea>
                                <div class="flex justify-center w-full">
                                    <button type="submit" class="btn btn-success w-full mt-2">Add</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
            <div class="flex w-full">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-gray-200">
                            <th class="p-3">No</th>
                            <th class="p-3">Photo</th>
                            <th class="p-3">Name</th>
                            <th class="p-3">Category</th>
                            <th class="p-3">Price</th>
                            <th class="p-3">Stock</th>
                            <th class="p-3">Stand</th>
                            <th class="p-3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $key => $product)
                            <tr class="border-b border-gray-200">
                                <td class="p-2 text-center">{{ $key + 1 }}</td>
                                <td class="p-2 flex justify-center">
                                    {{-- {{ $product->photo }} --}}
                                    @if ($product->photo)
                                        <img src="{{ $product->photo }}" alt="none" class="object-cover rounded"
                                            width="100" height="100">
                                    @else
                                        <img src="{{ asset("photos/$product->photo.png") }}" alt="none"
                                            class="object-cover rounded w-8 h-8" width="100" height="100">
                                    @endif
                                </td>
                                <td class="p-2 text-center">{{ $product->name }}</td>
                                <td class="p-2 text-center">{{ $product->category->name }}</td>
                                <td class="p-2 text-center">Rp {{ $product->price }}</td>
                                <td class="p-2 text-center">{{ $product->stock }}</td>
                                <td class="p-2 text-center">{{ $product->stand }}</td>
                                <td class="p-2 text-center">
                                    <div class="flex justify-center items-center gap-2">
                                        <form action="/delete-product/{{ $product->id }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="p-2 btn btn-error" type="submit">Delete</button>
                                        </form>
                                        <a href="#my_modal_{{ $product->id }}" class="btn btn-warning">Edit</a>
                                        <div class="modal" id="my_modal_{{ $product->id }}">
                                            <div class="modal-box">
                                                <div class="flex flex-col w-full">
                                                    <div class="flex justify-between items-center w-full">
                                                        <span>Edit Product</span>
                                                        <a href="#" class="btn mb-2">X</a>
                                                    </div>
                                                    <form action="/product-update/{{ $product->id }}" method="post"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="text" value="{{ $product->name }}"
                                                            name="name" class="mb-2 w-full input input-bordered">
                                                        <div class="flex w-full justify-between gap-2">
                                                            <div class="flex flex-col w-full gap-2">
                                                                <input type="number" value="{{ $product->price }}"
                                                                    name="price" class="input input-bordered">
                                                                <input type="number" value="{{ $product->stock }}"
                                                                    name="stock" class="input input-bordered">
                                                            </div>
                                                            <div class="flex flex-col w-full gap-2">
                                                                <input type="number" value="{{ $product->stand }}"
                                                                    name="stand" class="input input-bordered">
                                                                <select name="categories_id"
                                                                    class="input input-bordered p-2">
                                                                    @foreach ($categories as $category)
                                                                        <option value="{{ $category->id }}"
                                                                            @if ($category->id == $product->category->id) selected @endif>
                                                                            {{ $category->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <img src="{{ $product->photo }}" alt="not"
                                                            class="object-cover w-20 h-20 border rounded my-2">
                                                        <input type="file" name="photo" class="w-full mb-2"
                                                            value="{{ $product->photo }}">
                                                        <textarea type="text" name="desc" class="input input-bordered p-2 w-full">{{ $product->desc }}</textarea>
                                                        <div class="flex justify-center w-full">
                                                            <button type="submit"
                                                                class="btn btn-success w-full mt-2">Edit</button>
                                                        </div>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            <div class="flex h-20"></div>
        </div>
    </div>

    <script>
        const dropdown = document.querySelector('#dropdown');
        const category = document.querySelector('#category');
        let queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        const currentFilter = urlParams.get('filter');
        const categoryFilter = urlParams.get('category');

        dropdown.addEventListener('change', (e) => {
            const filterValue = e.target.value;
            const url = window.location.origin + window.location.pathname +
                `?filter=${filterValue}&category=${categoryFilter}`;
            window.location.href = url;
        });

        category.addEventListener('change', (e) => {
            const categoryValue = e.target.value;
            const url = window.location.origin + window.location.pathname +
                `?filter=${currentFilter}&category=${categoryValue}`;
            window.location.href = url;
        });

        const selectedValue = document.querySelectorAll('.selectedValue');
        selectedValue.forEach((value) => {
            value.value === currentFilter ? value.selected = true : value.selected = false;
        });

        const selectedCategory = document.querySelectorAll('.selectedCategory');
        selectedCategory.forEach((value) => {
            value.value === categoryFilter ? value.selected = true : value.selected = false;
        });
    </script>
@endsection
