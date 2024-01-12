@extends('template.app')

@section('content')
    <div class="container mx-auto">
        <span>{{ $code }}</span>
        @php
            $totalPrice = 0;
        @endphp
        @foreach ($report as $rp)
            <div class="flex items-center gap-4">
                <span class="my-3">{{ $rp->products->name }} | {{ $rp->price }} | {{ $rp->quantity }}</span>
            </div>
            @php
                $totalPrice += $rp->price * $rp->quantity;
            @endphp
        @endforeach
        <span>
            Total harga: {{ $totalPrice }}
        </span>
    </div>
    <script>
        window.print()
    </script>
@endsection
