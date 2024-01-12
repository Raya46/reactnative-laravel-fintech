@extends('template.app')

@section('content')
    <div class="container mx-auto">
        <div class="flex flex-col">
            <form action="{{ route('login') }}" method="post" class="flex flex-col gap-5">
                @csrf
                <input type="text" name="name" class="bg-slate-200 p-4 rounded-lg border border-black">
                <input type="text" name="password" class="bg-slate-200 p-4 rounded-lg border border-black">
                <button type="submit" class="bg-slate-200 p-4 rounded-lg w-20">Login</button>
            </form>
        </div>
    </div>
@endsection
