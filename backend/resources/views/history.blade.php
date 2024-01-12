@extends('template.app')

@section('content')
    <div class="container mx-auto h-full overflow-y-auto w-full">
        <div class="flex flex-col gap-3 w-full">
            <div class="flex items-center gap-6 w-full">
                <div class="rounded-full bg-slate-950 p-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="fill-white"
                        viewBox="0 0 16 16">
                        <path
                            d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1v4.5a2.5 2.5 0 0 1-2.5 2.5h-9A2.5 2.5 0 0 1 1 13.5V9a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h1.217L5.07 1.243a.5.5 0 0 1 .686-.172zM2 9v4.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V9H2zM1 7v1h14V7H1zm3 3a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 4 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 6 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 8 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5z" />
                    </svg>
                </div>
                <span class="w-full">Keranjang</span>
            </div>
            @php
                $totalPrice = 0;
            @endphp
            @foreach ($transactionsKeranjang as $ts)
                <div class="flex items-center gap-3 w-full">
                    <span class="flex w-full">{{ $ts->products->name }} | {{ $ts->price }} | {{ $ts->quantity }}</span>
                    <form action="/keranjang/delete" method="post">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="id" value="{{ $ts->id }}">
                        <button type="submit" class="bg-red-400 p-3 rounded-md">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor"
                                class="fill-white" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                <path
                                    d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                            </svg>
                        </button>
                    </form>
                </div>
                @php
                    $totalPrice += $ts->price * $ts->quantity;
                @endphp
            @endforeach
            <p class="mt-3">Total harga: {{ $totalPrice }}</p>
            <form action="{{ route('payProduct') }}" method="post" class="flex w-full">
                @csrf
                @method('PUT')
                <button type="submit" class="p-2 bg-green-400 text-white rounded-lg w-full">Buy</button>
            </form>
            <div class="flex w-full bg-slate-300 border border-b-1"></div>

            <div class="flex flex-col w-full">
                <div class="flex items-center gap-5 w-full">
                    <div class="rounded-full bg-slate-950 p-3 flex">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                            class="fill-white" viewBox="0 0 16 16">
                            <path
                                d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v1h14V4a1 1 0 0 0-1-1H2zm13 4H1v5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V7z" />
                            <path d="M2 10a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1v-1z" />
                        </svg>
                    </div>
                    <span class="w-full">Riwayat Top Up</span>
                </div>
                <div class="flex w-full gap-4">
                    <div class="flex flex-col w-full">
                        @foreach ($walletSelesai as $wp)
                            <div class="flex w-full items-center mt-3 justify-between">
                                @if ($wp->credit == 0)
                                    <span></span>
                                @else
                                    <span>Top Up Rp. {{ $wp->credit }}</span>
                                    <span>{{ $wp->created_at }}</span>
                                    <span class="bg-green-400 p-2 text-white rounded">
                                        {{ $wp->status }}
                                    </span>
                                @endif
                            </div>
                        @endforeach
                    </div>
                    <div class="flex flex-col w-full">
                        @foreach ($walletProcess as $wp)
                            <div class="flex w-full items-center mt-3 justify-between">
                                <span>Top Up Rp. {{ $wp->credit }} </span>
                                <span>{{ $wp->created_at }}</span>
                                <span class="bg-yellow-300 p-2 text-white rounded">
                                    {{ $wp->status }}
                                </span>
                            </div>
                        @endforeach
                    </div>

                </div>

                <div class="flex w-full bg-slate-300 border border-b-1 my-6"></div>

                <div class="flex items-center gap-5 w-full">
                    <div class="rounded-full bg-slate-950 p-3 flex">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                            class="fill-white" viewBox="0 0 16 16">
                            <path
                                d="M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022l-.074.997zm2.004.45a7.003 7.003 0 0 0-.985-.299l.219-.976c.383.086.76.2 1.126.342l-.36.933zm1.37.71a7.01 7.01 0 0 0-.439-.27l.493-.87a8.025 8.025 0 0 1 .979.654l-.615.789a6.996 6.996 0 0 0-.418-.302zm1.834 1.79a6.99 6.99 0 0 0-.653-.796l.724-.69c.27.285.52.59.747.91l-.818.576zm.744 1.352a7.08 7.08 0 0 0-.214-.468l.893-.45a7.976 7.976 0 0 1 .45 1.088l-.95.313a7.023 7.023 0 0 0-.179-.483zm.53 2.507a6.991 6.991 0 0 0-.1-1.025l.985-.17c.067.386.106.778.116 1.17l-1 .025zm-.131 1.538c.033-.17.06-.339.081-.51l.993.123a7.957 7.957 0 0 1-.23 1.155l-.964-.267c.046-.165.086-.332.12-.501zm-.952 2.379c.184-.29.346-.594.486-.908l.914.405c-.16.36-.345.706-.555 1.038l-.845-.535zm-.964 1.205c.122-.122.239-.248.35-.378l.758.653a8.073 8.073 0 0 1-.401.432l-.707-.707z" />
                            <path d="M8 1a7 7 0 1 0 4.95 11.95l.707.707A8.001 8.001 0 1 1 8 0v1z" />
                            <path
                                d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5z" />
                        </svg>
                    </div>
                    <span class="w-full">Riwayat Pembayaran</span>
                </div>
                <div class="flex flex-col">
                    @foreach ($transactionsBayar as $ts)
                        <span class="mt-3">{{ $ts->products->name }} | {{ $ts->price }} | {{ $ts->quantity }}</span>
                    @endforeach
                    <form action="{{ route('clearHistoryBuy') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="p-2 bg-red-400 text-white rounded-md w-full mt-3">Hapus
                            Riwayat</button>
                    </form>
                </div>
            </div>
            <div class="flex w-full bg-slate-300 border border-b-1"></div>
            <div class="flex flex-col w-full gap-4">
                <div class="flex items-center gap-6 w-full">
                    <div class="rounded-full bg-slate-950 p-3 flex">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="fill-white" viewBox="0 0 16 16">
                            <path
                                d="M14.778.085A.5.5 0 0 1 15 .5V8a.5.5 0 0 1-.314.464L14.5 8l.186.464-.003.001-.006.003-.023.009a12.435 12.435 0 0 1-.397.15c-.264.095-.631.223-1.047.35-.816.252-1.879.523-2.71.523-.847 0-1.548-.28-2.158-.525l-.028-.01C7.68 8.71 7.14 8.5 6.5 8.5c-.7 0-1.638.23-2.437.477A19.626 19.626 0 0 0 3 9.342V15.5a.5.5 0 0 1-1 0V.5a.5.5 0 0 1 1 0v.282c.226-.079.496-.17.79-.26C4.606.272 5.67 0 6.5 0c.84 0 1.524.277 2.121.519l.043.018C9.286.788 9.828 1 10.5 1c.7 0 1.638-.23 2.437-.477a19.587 19.587 0 0 0 1.349-.476l.019-.007.004-.002h.001M14 1.221c-.22.078-.48.167-.766.255-.81.252-1.872.523-2.734.523-.886 0-1.592-.286-2.203-.534l-.008-.003C7.662 1.21 7.139 1 6.5 1c-.669 0-1.606.229-2.415.478A21.294 21.294 0 0 0 3 1.845v6.433c.22-.078.48-.167.766-.255C4.576 7.77 5.638 7.5 6.5 7.5c.847 0 1.548.28 2.158.525l.028.01C9.32 8.29 9.86 8.5 10.5 8.5c.668 0 1.606-.229 2.415-.478A21.317 21.317 0 0 0 14 7.655V1.222z" />
                        </svg>
                    </div>
                    <span class="w-full">Laporan Pembayaran</span>
                </div>
                @foreach ($laporanPembayaran as $order_code => $laporanGroup)
                    <div class="flex items-center gap-4 w-full">
                        <span class="my-2 w-full">{{ $order_code }}</span>
                        <a href="/history/{{ $order_code }}" target="_blank"
                            class="bg-green-400 text-white p-3 rounded-md">Download</a>
                    </div>
                @endforeach
                <div class="flex w-full bg-slate-300 border border-b-1"></div>
            </div>
        </div>
        <div class="flex flex-col h-20"></div>
    </div>
@endsection
