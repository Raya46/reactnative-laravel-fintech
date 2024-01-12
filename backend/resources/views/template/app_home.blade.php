<!doctype html>
<html data-theme="light">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>FintechSchool</title>
</head>

<body class="bg-[#F0F7F4]">
    <!-- Navbar -->
    <div
        class="flex justify-between items-center p-4 border border-slate-300 border-r-0 border-l-0 overflow-y-hidden bg-white">
        <div class="text-3xl font-bold text-black">
            <span>EFinance.</span>
        </div>
        <div class="flex gap-3">
            <a href="{{ !Auth::check() ? '/login' : '/logout' }}"
                class="p-3 rounded-md text-white bg-slate-950">{{ !Auth::check() ? 'Login' : 'Logout' }}</a>
        </div>
    </div>

    <div class="flex h-screen fixed overflow-hidden w-full">
        <!-- Sidebar -->
        <div class="w-60 p-4 border border-slate-300 border-t-0 bg-white">
            <ul class="space-y-3 text-black">
                @yield('sidebar_features')
            </ul>
        </div>

        <!-- Konten Utama -->
        <div class="flex-1 p-4 w-full overflow-y-auto bg-[#F0F7F4]">
            @yield('content')
        </div>
    </div>
</body>

</html>
