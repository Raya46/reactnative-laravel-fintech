@extends('template.app')

@section('content')
    <div class="container mx-auto h-full overflow-y-auto">
        <div class="flex flex-col">
            <div class="flex flex-col ml-3">
                <span class="text-xl mb-3">Rp {{ $difference }}</span>
                <div class="flex items-center gap-3">
                    <a href="/category-product?index=pakaian" class="rounded-lg border p-2 hover:bg-gray-300">clothings</a>
                    <a href="/category-product?index=makanan" class="rounded-lg border p-2 hover:bg-gray-300">foods</a>
                    <a href="/category-product?index=minuman" class="rounded-lg border p-2 hover:bg-gray-300">drinks</a>
                </div>
            </div>
            <div class="flex-col w-full flex lg:flex-row">
                <div class="flex gap-4 flex-wrap basis-[70%]">
                    @foreach ($products as $key => $product)
                        <div class="lg:w-[30%] md:w-1/2 w-full p-2">
                            <div class="bg-gray-50 rounded-lg shadow-md border border-slate-300">
                                <img src="{{ $product->photo }}" alt="{{ $product->name }}"
                                    class="w-full h-48 object-cover rounded-t-lg">
                                <div class="p-4">
                                    <div class="text-lg font-semibold">
                                        <a href="/product/{{ $product->id }}">
                                            {{ $product->name }}
                                        </a>
                                    </div>
                                    <div class="text-gray-600">Rp. {{ $product->price }}</div>
                                    <form action="{{ route('addToCart') }}" method="post">
                                        @csrf
                                        <div class="mt-4">
                                            <input type="number" name="quantity"
                                                class="w-full border border-black rounded-md p-2" value="1"
                                                min="1">
                                            <input type="hidden" name="products_id" value="{{ $product->id }}">
                                            <input type="hidden" name="price" value="{{ $product->price }}">
                                        </div>
                                        <div class="mt-4">
                                            <button type="submit" class="bg-green-400 text-white rounded-lg w-full p-2">Add
                                                to Cart</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="flex flex-col basis-[25%] mt-2">
                    <div class="flex flex-col gap-3 border border-slate-300 rounded-xl p-4">
                        <span>Keranjang</span>
                        @php
                            $totalPrice = 0;
                        @endphp
                        @foreach ($transactionsKeranjang as $ts)
                            <div class="flex items-center gap-2 w-full">
                                <span class="w-full">{{ $ts->products->name }} | {{ $ts->price }}
                                    ({{ $ts->quantity }})
                                </span>
                                <form action="/keranjang/delete" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="id" value="{{ $ts->id }}">
                                    <button type="submit" class="bg-red-400 p-2 rounded-md">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            fill="currentColor" class="fill-white" viewBox="0 0 16 16">
                                            <path
                                                d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
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
                        <div class="flex w-full bg-slate-300 border border-b-1"></div>
                        <p>total harga: {{ $totalPrice }}</p>
                        <form action="{{ route('payProduct') }}" method="post" class="flex w-full mt-2">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="p-2 bg-green-400 text-white rounded-lg w-full">Buy</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="flex flex-col h-20"></div>
        </div>

    </div>
@endsection
