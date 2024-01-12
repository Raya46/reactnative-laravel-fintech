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
        <a href="/admin" class="hover:text-gray-300">Home</a>
    </li>
    <li class="flex items-center gap-3">
        <div class="flex flex-col items-center justify-center bg-slate-950 rounded-full p-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="fill-white"
                viewBox="0 0 16 16">
                <path
                    d="M14.778.085A.5.5 0 0 1 15 .5V8a.5.5 0 0 1-.314.464L14.5 8l.186.464-.003.001-.006.003-.023.009a12.435 12.435 0 0 1-.397.15c-.264.095-.631.223-1.047.35-.816.252-1.879.523-2.71.523-.847 0-1.548-.28-2.158-.525l-.028-.01C7.68 8.71 7.14 8.5 6.5 8.5c-.7 0-1.638.23-2.437.477A19.626 19.626 0 0 0 3 9.342V15.5a.5.5 0 0 1-1 0V.5a.5.5 0 0 1 1 0v.282c.226-.079.496-.17.79-.26C4.606.272 5.67 0 6.5 0c.84 0 1.524.277 2.121.519l.043.018C9.286.788 9.828 1 10.5 1c.7 0 1.638-.23 2.437-.477a19.587 19.587 0 0 0 1.349-.476l.019-.007.004-.002h.001M14 1.221c-.22.078-.48.167-.766.255-.81.252-1.872.523-2.734.523-.886 0-1.592-.286-2.203-.534l-.008-.003C7.662 1.21 7.139 1 6.5 1c-.669 0-1.606.229-2.415.478A21.294 21.294 0 0 0 3 1.845v6.433c.22-.078.48-.167.766-.255C4.576 7.77 5.638 7.5 6.5 7.5c.847 0 1.548.28 2.158.525l.028.01C9.32 8.29 9.86 8.5 10.5 8.5c.668 0 1.606-.229 2.415-.478A21.317 21.317 0 0 0 14 7.655V1.222z" />
            </svg>
        </div>
        <a href="/report-admin" class="hover:text-gray-300">Reports</a>
    </li>
    <li class="flex items-center gap-3">
        <div class="flex flex-col items-center justify-center bg-slate-950 rounded-full p-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="fill-white"
                viewBox="0 0 16 16">
                <path
                    d="M12.136.326A1.5 1.5 0 0 1 14 1.78V3h.5A1.5 1.5 0 0 1 16 4.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 13.5v-9a1.5 1.5 0 0 1 1.432-1.499L12.136.326zM5.562 3H13V1.78a.5.5 0 0 0-.621-.484L5.562 3zM1.5 4a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-13z" />
            </svg>
        </div>
        <a href="/transaction-admin" class="hover:text-gray-300">Transaction</a>
    </li>
    <li class="flex items-center gap-3">
        <div class="flex flex-col items-center justify-center bg-slate-950 rounded-full p-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="fill-white"
                viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                    d="M2 2.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5V3a.5.5 0 0 0-.5-.5H2zM3 3H2v1h1V3z" />
                <path
                    d="M5 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM5.5 7a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1h-9zm0 4a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1h-9z" />
                <path fill-rule="evenodd"
                    d="M1.5 7a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H2a.5.5 0 0 1-.5-.5V7zM2 7h1v1H2V7zm0 3.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5H2zm1 .5H2v1h1v-1z" />
            </svg>
        </div>
        <a href="/category-admin" class="hover:text-gray-300">Category</a>
    </li>
@endsection

@section('content')
    <div class="container mx-auto">
        <div class="flex flex-col w-full bg-white p-4 rounded-lg h-full">
            <span class="text-2xl">Hello, {{ Auth::user()->roles->name }} 👋</span>
            <div class="flex justify-between my-4">
                <div class="flex items-center justify-between w-full">
                    <div class="flex items-center gap-3">
                        <span class="text-lg text-slate-400">Filter By</span>
                        <select name="" id="" class="border rounded p-2 px-3">
                            <option value="">ascending</option>
                            <option value="">descending</option>
                        </select>
                    </div>
                    <div class="flex items-center gap-3">
                        <a href="#modal_category_add" class="btn btn-success">Add Category</a>
                        <a href="#modal_category_delete" class="btn btn-error">Trash</a>
                    </div>
                    <div class="modal" id="modal_category_add">
                        <div class="modal-box">
                            <div class="flex flex-col w-full">
                                <div class="flex justify-between items-center w-full">
                                    <span>Add Category</span>
                                    <a href="#" class="btn mb-2">X</a>
                                </div>
                                <form action="/category-admin-store" method="post">
                                    @csrf
                                    <input type="text" name="name" class="mb-2 w-full input input-bordered">
                                    <button type="submit" class="btn btn-success w-full mt-2">Add</button>
                                </form>
                            </div>

                        </div>
                    </div>
                    <div class="modal" id="modal_category_delete">
                        <div class="modal-box">
                            <div class="flex flex-col w-full">
                                <div class="flex justify-between items-center">
                                    <span>Deleted Bin</span>
                                    <div class="flex gap-2">
                                        <a href="#" class="btn mb-2">X</a>
                                    </div>
                                </div>
                                @foreach ($categories_delete as $pdl)
                                    <div class="flex justify-between items-center">
                                        <span>{{ $pdl->name }}</span>
                                        <div class="flex gap-2">
                                            <form action="/restore-category/{{ $pdl->id }}" method="post">
                                                @csrf
                                                <button type="submit" class="btn btn-success"><svg
                                                        xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="fill-green-800" viewBox="0 0 16 16">
                                                        <path
                                                            d="M9.302 1.256a1.5 1.5 0 0 0-2.604 0l-1.704 2.98a.5.5 0 0 0 .869.497l1.703-2.981a.5.5 0 0 1 .868 0l2.54 4.444-1.256-.337a.5.5 0 1 0-.26.966l2.415.647a.5.5 0 0 0 .613-.353l.647-2.415a.5.5 0 1 0-.966-.259l-.333 1.242-2.532-4.431zM2.973 7.773l-1.255.337a.5.5 0 1 1-.26-.966l2.416-.647a.5.5 0 0 1 .612.353l.647 2.415a.5.5 0 0 1-.966.259l-.333-1.242-2.545 4.454a.5.5 0 0 0 .434.748H5a.5.5 0 0 1 0 1H1.723A1.5 1.5 0 0 1 .421 12.24l2.552-4.467zm10.89 1.463a.5.5 0 1 0-.868.496l1.716 3.004a.5.5 0 0 1-.434.748h-5.57l.647-.646a.5.5 0 1 0-.708-.707l-1.5 1.5a.498.498 0 0 0 0 .707l1.5 1.5a.5.5 0 1 0 .708-.707l-.647-.647h5.57a1.5 1.5 0 0 0 1.302-2.244l-1.716-3.004z" />
                                                    </svg>
                                                </button>
                                            </form>
                                            <form action="/delete-permanent-category/{{ $pdl->id }}" method="post">
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
            </div>
            <div class="flex w-full">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-gray-200">
                            <th class="p-3">No</th>
                            <th class="p-3">Category</th>
                            <th class="p-3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $key => $category)
                            <tr class="border-b border-gray-200">
                                <td class="p-2 text-center">{{ $key + 1 }}</td>
                                <td class="p-2 text-center">{{ $category->name }}</td>
                                <td class="p-2 text-center">
                                    <div class="flex justify-center items-center gap-3">
                                        <form action="/category-admin-delete/{{ $category->id }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-error">delete</button>
                                        </form>
                                        <a href="#my_modal_category_{{ $category->id }}" class="btn btn-warning">Edit</a>
                                        <div class="modal" id="my_modal_category_{{ $category->id }}">
                                            <div class="modal-box">
                                                <div class="flex flex-col w-full">
                                                    <div class="flex justify-between items-center w-full">
                                                        <span>Edit category</span>
                                                        <a href="#" class="btn mb-2">X</a>
                                                    </div>
                                                    <form action="/category-admin-update/{{ $category->id }}"
                                                        method="post">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="text" value="{{ $category->name }}"
                                                            name="name" class="mb-2 w-full input input-bordered">
                                                        <button type="submit"
                                                            class="btn btn-success w-full mt-2">Edit</button>
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
        </div>
    </div>
@endsection
