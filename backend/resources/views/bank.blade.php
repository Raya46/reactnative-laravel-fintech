@extends('template.app_home')

@section('sidebar_features')
    <li class="flex items-center gap-3">
        <div class="flex flex-col items-center justify-center bg-slate-950 rounded-full p-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="fill-white"
                viewBox="0 0 16 16">
                <path
                    d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.707 1.5ZM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5 5 5Z" />
            </svg>
        </div>
        <a href="/bank" class="hover:text-gray-300">Home</a>
    </li>
    <li class="flex items-center gap-3">
        <div class="flex flex-col items-center justify-center bg-slate-950 rounded-full p-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="fill-white"
                viewBox="0 0 16 16">
                <path
                    d="M14.778.085A.5.5 0 0 1 15 .5V8a.5.5 0 0 1-.314.464L14.5 8l.186.464-.003.001-.006.003-.023.009a12.435 12.435 0 0 1-.397.15c-.264.095-.631.223-1.047.35-.816.252-1.879.523-2.71.523-.847 0-1.548-.28-2.158-.525l-.028-.01C7.68 8.71 7.14 8.5 6.5 8.5c-.7 0-1.638.23-2.437.477A19.626 19.626 0 0 0 3 9.342V15.5a.5.5 0 0 1-1 0V.5a.5.5 0 0 1 1 0v.282c.226-.079.496-.17.79-.26C4.606.272 5.67 0 6.5 0c.84 0 1.524.277 2.121.519l.043.018C9.286.788 9.828 1 10.5 1c.7 0 1.638-.23 2.437-.477a19.587 19.587 0 0 0 1.349-.476l.019-.007.004-.002h.001M14 1.221c-.22.078-.48.167-.766.255-.81.252-1.872.523-2.734.523-.886 0-1.592-.286-2.203-.534l-.008-.003C7.662 1.21 7.139 1 6.5 1c-.669 0-1.606.229-2.415.478A21.294 21.294 0 0 0 3 1.845v6.433c.22-.078.48-.167.766-.255C4.576 7.77 5.638 7.5 6.5 7.5c.847 0 1.548.28 2.158.525l.028.01C9.32 8.29 9.86 8.5 10.5 8.5c.668 0 1.606-.229 2.415-.478A21.317 21.317 0 0 0 14 7.655V1.222z" />
            </svg>
        </div>
        <a href="/report-bank" class="hover:text-gray-300">Reports</a>
    </li>
@endsection

@section('content')
    <div class="container mx-auto">
        <div class="flex py-2 gap-3 mb-3">
            <div class="flex flex-col w-full bg-white p-4 rounded-lg h-full">
                <span class="text-2xl">Saldo</span>
                <span>{{ $difference_bank }}</span>
            </div>
            <div class="flex flex-col w-full bg-white p-4 rounded-lg h-full">
                <span class="text-2xl">Nasabah</span>
                <span>{{ $nasabah }}</span>
            </div>
            <div class="flex flex-col w-full bg-white p-4 rounded-lg h-full">
                <span class="text-2xl">Transaksi</span>
                <span>{{ $wallet_count }}</span>
            </div>
        </div>
        <div class="flex flex-col w-full bg-white p-4 rounded-lg h-full">
            <span class="text-2xl">List of expand</span>
            <div class="flex justify-between my-4">
                <div class="flex items-center justify-between w-full">
                    <div class="flex items-center gap-2">
                        <span class="text-lg text-slate-400">Filter By</span>
                        <select name="" id="" class="border rounded p-2 px-3">
                            <option value="">ascending</option>
                            <option value="">descending</option>
                        </select>
                    </div>

                    <a href="/report/all?index=topup-download" class="bg-green-400 p-3 rounded-md" target="_blank">Download
                        All</a>
                </div>
            </div>
            <div class="flex w-full">
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
                        @foreach ($wallets as $key => $wallet)
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
            </div>
        </div>

        <div class="h-20"></div>
    </div>
@endsection
