<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>FintechSchool</title>
</head>

<body>
    <div class="container mx-auto">
        <div class="flex justify-between p-4">
            <div class="flex text-3xl font-bold">
                <a href="/">EFinance.</a>
            </div>
            <div class="gap-3 items-center hidden lg:flex">
                @if (Auth::check())
                    <a href="/history" class="bg-black p-2 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                            class="fill-white" viewBox="0 0 16 16">
                            <path
                                d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z" />
                        </svg></a>
                    <span class="cursor-pointer bg-black p-2 rounded-full" id="openModal"><svg
                            xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                            class="fill-white" viewBox="0 0 16 16">
                            <path
                                d="M4 10.781c.148 1.667 1.513 2.85 3.591 3.003V15h1.043v-1.216c2.27-.179 3.678-1.438 3.678-3.3 0-1.59-.947-2.51-2.956-3.028l-.722-.187V3.467c1.122.11 1.879.714 2.07 1.616h1.47c-.166-1.6-1.54-2.748-3.54-2.875V1H7.591v1.233c-1.939.23-3.27 1.472-3.27 3.156 0 1.454.966 2.483 2.661 2.917l.61.162v4.031c-1.149-.17-1.94-.8-2.131-1.718H4zm3.391-3.836c-1.043-.263-1.6-.825-1.6-1.616 0-.944.704-1.641 1.8-1.828v3.495l-.2-.05zm1.591 1.872c1.287.323 1.852.859 1.852 1.769 0 1.097-.826 1.828-2.2 1.939V8.73l.348.086z" />
                        </svg></span>
                @else
                    <span></span>
                @endif
                <div id="myModal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
                    <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>

                    <div
                        class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">

                        <!-- Isi Modal Anda -->
                        <div class="modal-content py-4 text-left px-6">
                            <h1 class="text-2xl font-semibold mb-4">Top Up Wallet</h1>
                            <form action="{{ route('topUp') }}" method="post">
                                @csrf
                                <span class="text-lg mr-2">Rp</span>
                                <input type="number" name="credit" class="rounded border border-slate-300 p-2 mr-3"
                                    value="10000">
                                <button type="submit"
                                    class="px-4 py-2 bg-gray-900 text-white rounded-lg focus:outline-none focus:shadow-outline">Top
                                    Up</button>
                            </form>
                            <!-- Tombol Tutup Modal -->
                            <div class="mt-5">
                                <button id="closeModal"
                                    class="modal-close px-4 py-2 bg-gray-900 text-white rounded-lg focus:outline-none focus:shadow-outline">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="/{{ !Auth::check() ? 'login' : 'logout' }}"
                    class="p-3 rounded-md text-white bg-slate-950">{{ !Auth::check() ? 'Login' : 'Logout' }}</a>
                @if (!Auth::check())
                    <a href="/register" class="p-3 rounded-md border border-slate-950">Register</a>
                @endif
            </div>
        </div>
    </div>

    @yield('content')

    <script>
        const modal = document.getElementById('myModal');
        const openModal = document.getElementById('openModal');
        const closeModal = document.getElementById('closeModal');

        function open() {
            modal.classList.remove('hidden');
        }

        function close() {
            modal.classList.add('hidden');
        }

        openModal.addEventListener('click', open);

        closeModal.addEventListener('click', close);
    </script>
</body>

</html>
