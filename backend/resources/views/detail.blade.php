@extends('template.app')

@section('content')
    <div class="container mx-auto">
        <div class="flex gap-6">
            <div class="flex flex-col basis-[35%]">
                <img src="{{ $product->photo }}" alt="" class="object-cover rounded-xl">
            </div>
            <div class="flex flex-col basis-[30%]">
                <span>{{ $product->name }}</span>
                <span>Rp{{ $product->price }}</span>
                <span>Stock {{ $product->stock }} items</span>
                <span>Stand {{ $product->stand }}</span>
                <span>desc item: {{ $product->desc }}</span>
                <span>Category {{ $product->category->name }}</span>
            </div>
            <div class="flex flex-col basis-[30%]">
                <div class="flex flex-col gap-3 border border-slate-300 rounded-xl p-4">
                    <span>keranjang</span>
                    @php
                        $totalPrice = 0;
                    @endphp
                    @foreach ($transactionsKeranjang as $ts)
                        <div class="flex items-center gap-2 w-full">
                            <li class="w-full">{{ $ts->products->name }} | {{ $ts->price }} | {{ $ts->quantity }}
                            </li>
                            <form action="/keranjang/delete" method="post">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="id" value="{{ $ts->id }}">
                                <button type="submit" class="bg-red-400 p-2 rounded-md">cancel</button>
                            </form>
                        </div>
                        @php
                            $totalPrice += $ts->price * $ts->quantity;
                        @endphp
                    @endforeach
                    <p>total harga: {{ $totalPrice }}</p>
                    <div class="flex flex-col">
                        <form action="/product/{{ $product->id }}" method="post">
                            @csrf
                            <input type="number" name="quantity" class="w-full border border-black rounded-md p-2"
                                value="0">
                            <input type="hidden" name="products_id" value="{{ $product->id }}">
                            <input type="hidden" name="price" value="{{ $product->price }}">
                            <div class="flex gap-3 mt-2">
                                <button type="submit"
                                    class="p-3 bg-green-400 rounded-lg w-1/4 mt-2 flex justify-center"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                        class="fill-white" viewBox="0 0 16 16">
                                        <path
                                            d="M11.354 6.354a.5.5 0 0 0-.708-.708L8 8.293 6.854 7.146a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0l3-3z" />
                                        <path
                                            d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zm3.915 10L3.102 4h10.796l-1.313 7h-8.17zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                                    </svg>
                                </button>
                        </form>
                        <form action="/product/{{ $product->id }}" method="post" class="flex w-full mt-2">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="p-3 bg-slate-200 rounded-lg w-full">Buy</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
