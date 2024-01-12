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
        @if (URL::current() == 'http://127.0.0.1:8000/transaction-kantin')
            <a href="/kantin" class="hover:text-gray-300">Home</a>
        @else
            <a href="/admin" class="hover:text-gray-300">Home</a>
        @endif
    </li>
    @if (URL::current() == 'http://127.0.0.1:8000/transaction-kantin')
        <span></span>
    @else
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
    @endif

    <li class="flex items-center gap-3">
        <div class="flex flex-col items-center justify-center bg-slate-950 rounded-full p-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="fill-white"
                viewBox="0 0 16 16">
                <path
                    d="M12.136.326A1.5 1.5 0 0 1 14 1.78V3h.5A1.5 1.5 0 0 1 16 4.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 13.5v-9a1.5 1.5 0 0 1 1.432-1.499L12.136.326zM5.562 3H13V1.78a.5.5 0 0 0-.621-.484L5.562 3zM1.5 4a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-13z" />
            </svg>
        </div>
        @if (URL::current() == 'http://127.0.0.1:8000/transaction-kantin')
            <a href="/transaction-kantin" class="hover:text-gray-300">Transaction</a>
        @else
            <a href="/transaction-admin" class="hover:text-gray-300">Transaction</a>
        @endif
    </li>
    @if (URL::current() == 'http://127.0.0.1:8000/transaction-kantin')
        <span></span>
    @else
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
    @endif
@endsection

@section('content')
    <div class="container mx-auto">
        <div class="flex flex-col w-full bg-white p-4 rounded-lg h-full">
            <span class="text-2xl">List of transactions</span>
            <div class="flex justify-between my-4">
                <div class="flex gap-2 items-center ">
                    <span class="text-lg text-slate-400">Filter By</span>
                    <select name="" id="" class="border rounded p-2 px-3">
                        <option value="">ascending</option>
                        <option value="">descending</option>
                    </select>
                </div>
            </div>
            <div class="flex w-full">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-gray-200">
                            <th class="p-3">No</th>
                            <th class="p-3">Name</th>
                            <th class="p-3">Product</th>
                            <th class="p-3">Order Code</th>
                            <th class="p-3">Price</th>
                            <th class="p-3">Quantity</th>
                            <th class="p-3">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- {{ $products }} --}}
                        @foreach ($transactions as $key => $transaction)
                            <tr class="border-b border-gray-200">
                                <td class="text-center p-2">{{ $key + 1 }}</td>
                                <td class="text-center p-2">
                                    @foreach ($transaction->userTransactions as $uts)
                                        {{ $uts->name }}
                                    @endforeach
                                </td>
                                <td class="text-center p-2">{{ $transaction->products->name }}</td>
                                <td class="text-center p-2">{{ $transaction->order_code }}</td>
                                <td class="text-center p-2">{{ $transaction->price }}</td>
                                <td class="text-center p-2">{{ $transaction->quantity }}</td>
                                @if ($transaction->status == 'dibayar')
                                    <td class="text-center p-2">
                                        <div class="flex items-center justify-center gap-2">
                                            <div class="flex btn btn-success justify-between">
                                                <span>
                                                    {{ $transaction->status }}
                                                </span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                    fill="currentColor" class="bi bi-check-all" viewBox="0 0 16 16">
                                                    <path
                                                        d="M8.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L2.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093L8.95 4.992a.252.252 0 0 1 .02-.022zm-.92 5.14.92.92a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 1 0-1.091-1.028L9.477 9.417l-.485-.486-.943 1.179z" />
                                                </svg>
                                            </div>
                                            @if (URL::current() == 'http://127.0.0.1:8000/transaction-admin')
                                                <span></span>
                                            @else
                                                <form action="/transaction-kantin/{{ $transaction->id }}" method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn btn-warning">Verifikasi
                                                        Diambil</button>
                                                </form>
                                            @endif

                                        </div>

                                    </td>
                                @else
                                    <td class="text-center p-2">
                                        <div class="flex items-center justify-center gap-2">
                                            <div class="flex btn btn-secondary p-2 justify-between">
                                                <span>
                                                    {{ $transaction->status }}
                                                </span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                    fill="currentColor" class="bi bi-check-all" viewBox="0 0 16 16">
                                                    <path
                                                        d="M8.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L2.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093L8.95 4.992a.252.252 0 0 1 .02-.022zm-.92 5.14.92.92a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 1 0-1.091-1.028L9.477 9.417l-.485-.486-.943 1.179z" />
                                                </svg>
                                            </div>
                                        </div>

                                    </td>
                                @endif
                            </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>
        </div>


    </div>
@endsection
