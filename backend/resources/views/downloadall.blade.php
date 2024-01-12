@extends('template.app')

@section('content')
    <div class="container mx-auto">
        <div class="flex flex-col w-full bg-white p-4 rounded-lg h-full">
            @if ($category == 'topup-download')
                <span class="text-2xl">List of Top Up</span>
            @else
                <span class="text-2xl">List of Transactions</span>
            @endif
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
                @if ($category == 'topup-download')
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-gray-200">
                                <th class="p-3">No</th>
                                <th class="p-3">Name</th>
                                <th class="p-3">Credit</th>
                                <th class="p-3">Debit</th>
                                <th class="p-3">Status</th>
                                <th class="p-3">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $key => $wallet)
                                <tr class="border-b border-gray-200">
                                    <td class="text-center p-2">{{ $key + 1 }}</td>
                                    <td class="text-center p-2">
                                        {{ $wallet->user->name }}
                                    </td>
                                    <td class="text-center p-2">
                                        {{ $wallet->credit ? $wallet->credit : '0' }}
                                    </td>
                                    <td class="text-center p-2">
                                        {{ $wallet->debit ? $wallet->debit : '0' }}
                                    </td>
                                    <td>{{ $wallet->status }}</td>
                                    @if ($wallet->status == 'process')
                                        <td class="text-center p-2">
                                            <span class="p-2 bg-yellow-400">
                                                {{ $wallet->status }}
                                            </span>
                                        </td>
                                    @else
                                        <td class="text-center p-2">
                                            <span class="p-2 bg-green-400">
                                                {{ $wallet->status }}
                                            </span>
                                        </td>
                                    @endif


                                    @if ($wallet->status == 'selesai')
                                        <td class="text-center p-3">
                                            <span class="bg-green-400 p-2 rounded">OK</span>
                                        </td>
                                    @else
                                        <td class="text-center p-2">
                                            <form action="/topup/{{ $wallet->id }}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="bg-sky-400 p-2 rounded">Accept</button>
                                            </form>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-gray-200">
                                <th class="p-3">Name</th>
                                <th class="p-3">Product</th>
                                <th class="p-3">Order Code</th>
                                <th class="p-3">Price</th>
                                <th class="p-3">Quantity</th>
                                <th class="p-3">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $key => $transaction)
                                <tr class="border-b border-gray-200">
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
                                            <div class="flex bg-green-400 rounded items-center p-2 justify-between">
                                                <span>
                                                    {{ $transaction->status }}
                                                </span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                    fill="currentColor" class="bi bi-check-all" viewBox="0 0 16 16">
                                                    <path
                                                        d="M8.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L2.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093L8.95 4.992a.252.252 0 0 1 .02-.022zm-.92 5.14.92.92a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 1 0-1.091-1.028L9.477 9.417l-.485-.486-.943 1.179z" />
                                                </svg>
                                            </div>
                                        </td>
                                    @elseif ($transaction->status == 'dikeranjang')
                                        <td class="text-center p-2">
                                            <div class="flex bg-yellow-400 rounded items-center p-2 justify-between">
                                                <span>
                                                    {{ $transaction->status }}
                                                </span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                    fill="currentColor" class="" viewBox="0 0 16 16">
                                                    <path
                                                        d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1v4.5a2.5 2.5 0 0 1-2.5 2.5h-9A2.5 2.5 0 0 1 1 13.5V9a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h1.217L5.07 1.243a.5.5 0 0 1 .686-.172zM2 9v4.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V9H2zM1 7v1h14V7H1zm3 3a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 4 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 6 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 8 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5z" />
                                                </svg>
                                            </div>
                                        </td>
                                    @else
                                        <td class="text-center p-2">
                                            <div class="flex bg-yellow-400 rounded items-center p-2 justify-between">
                                                <span>
                                                    {{ $transaction->status }}
                                                </span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                    fill="currentColor" class="bi bi-check-all" viewBox="0 0 16 16">
                                                    <path
                                                        d="M8.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L2.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093L8.95 4.992a.252.252 0 0 1 .02-.022zm-.92 5.14.92.92a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 1 0-1.091-1.028L9.477 9.417l-.485-.486-.943 1.179z" />
                                                </svg>
                                            </div>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                @endif

            </div>
        </div>


    </div>
    <script>
        window.print()
    </script>
@endsection
