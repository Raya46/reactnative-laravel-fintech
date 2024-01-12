@extends('template.app')
@section('content')
    <div class="container mx-auto">
        <div class="flex flex-col">
            <div class="flex mt-10">
                <div class="flex flex-col basis-[20%] mt-10">
                    <div class="flex">
                        <div class="rounded-full bg-yellow-400 p-2"></div>
                        <div class="rounded-full bg-yellow-300 p-2"></div>
                        <div class="rounded-full bg-yellow-200 p-2"></div>
                    </div>
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ab
                    quis?
                </div>
                <div class="flex flex-col text-6xl font-bold basis-[60%] items-center text-center">
                    Fastest finance technology
                    With Overpowered System
                </div>
                <div class="flex flex-col basis-[20%]">
                    <img src="https://img.freepik.com/free-vector/online-shopping-concept-landing-page_52683-12876.jpg?1&w=740&t=st=1697089348~exp=1697089948~hmac=3b6daf763b4f6600611587e87368ebac5ea72555331d38bc52b9ba137e0b4653"
                        alt="">
                </div>
            </div>
            <div class="flex gap-2">
                <div class="rounded-full bg-slate-950 text-white p-2 px-4">01</div>
                <div class="rounded-full border border-slate-950 p-2">Discount Collections</div>
            </div>
            <div class="flex justify-between gap-4 mt-10 px-8 bg-slate-50 p-10">
                <div class="flex basis-[30%]">
                    <img src="https://t3.ftcdn.net/jpg/03/68/88/12/240_F_368881299_zuSAOtaJgtj3XLAS0aHNm6tkNh8WSohH.jpg"
                        class="w-full h-full rounded-tl-[6rem] rounded-br-[6rem] object-cover overflow-hidden"
                        alt="">
                </div>
                <div class="flex flex-col rounded-full border border-slate-950 items-center justify-center p-2 basis-[20%]">
                    <span class="text-4xl font-bold">25% off</span>
                    <span class="text-lg">our all-new goods</span>
                </div>
                <div class="flex basis-[30%]">
                    <img src="https://img.freepik.com/free-photo/excited-young-girl-yellow-sweater-posing-studio-with-wavy-hair-isolated-yellow-wall_273443-4614.jpg?w=740&t=st=1697090281~exp=1697090881~hmac=6e663a9a17384f868ddf0d746d3f50c5d0c109a955c979eb21ed8e0d6da121b9"
                        class="w-full h-full rounded-tr-[6rem] rounded-bl-[6rem] object-cover overflow-hidden"
                        alt="">
                </div>
            </div>
            <div class="flex flex-col mt-10">
                <div class="flex justify-between">
                    <div class="flex gap-2">
                        <div class="rounded-full bg-slate-950 text-white p-2 px-4">FAV</div>
                        <div class="rounded-full border border-slate-950 p-2">Favorite Products</div>
                    </div>
                    <div class="flex gap-2 items-center">
                        <div class="rounded-full border border-slate-950 p-2">Clothes</div>
                        <div class="rounded-full border border-slate-950 p-2">Foods</div>
                        <div class="rounded-full border border-slate-950 p-2">Drinks</div>
                    </div>
                </div>
                <div class="flex mx-5 mt-10 gap-6">
                    <div class="flex flex-col border border-slate-400 shadow-sm rounded-md p-4 items-center">
                        <img src="https://img.freepik.com/free-photo/delicious-iced-tea_144627-27257.jpg?w=740&t=st=1697096414~exp=1697097014~hmac=851fde0ff7efbc421c7a97e93f932af1e3c45d38893ba80663a7b2cb446fe5cc"
                            alt="" class="object-cover w-28">
                        <div class="flex gap-10">
                            <div class="flex flex-col">
                                <span class="text-sm font-bold">Lemon Tea</span>
                                <span class="text-sm font-bold">RP 15000</span>
                            </div>
                            <div class="flex flex-col items-center justify-center">
                                <div class="rounded-full bg-slate-950 p-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                        fill="currentColor" class="fill-white" viewBox="0 0 16 16">
                                        <path
                                            d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1v4.5a2.5 2.5 0 0 1-2.5 2.5h-9A2.5 2.5 0 0 1 1 13.5V9a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h1.217L5.07 1.243a.5.5 0 0 1 .686-.172zM2 9v4.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V9H2zM1 7v1h14V7H1zm3 3a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 4 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 6 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 8 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col border border-slate-400 shadow-sm rounded-md p-4 items-center">
                        <img src="https://img.freepik.com/free-photo/delicious-iced-tea_144627-27257.jpg?w=740&t=st=1697096414~exp=1697097014~hmac=851fde0ff7efbc421c7a97e93f932af1e3c45d38893ba80663a7b2cb446fe5cc"
                            alt="" class="object-cover w-28">
                        <div class="flex gap-10">
                            <div class="flex flex-col">
                                <span class="text-sm font-bold">Lemon Tea</span>
                                <span class="text-sm font-bold">RP 15000</span>
                            </div>
                            <div class="flex flex-col items-center justify-center">
                                <div class="rounded-full bg-slate-950 p-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                        fill="currentColor" class="fill-white" viewBox="0 0 16 16">
                                        <path
                                            d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1v4.5a2.5 2.5 0 0 1-2.5 2.5h-9A2.5 2.5 0 0 1 1 13.5V9a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h1.217L5.07 1.243a.5.5 0 0 1 .686-.172zM2 9v4.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V9H2zM1 7v1h14V7H1zm3 3a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 4 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 6 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 8 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col border border-slate-400 shadow-sm rounded-md p-4 items-center">
                        <img src="https://img.freepik.com/free-photo/delicious-iced-tea_144627-27257.jpg?w=740&t=st=1697096414~exp=1697097014~hmac=851fde0ff7efbc421c7a97e93f932af1e3c45d38893ba80663a7b2cb446fe5cc"
                            alt="" class="object-cover w-28">
                        <div class="flex gap-10">
                            <div class="flex flex-col">
                                <span class="text-sm font-bold">Lemon Tea</span>
                                <span class="text-sm font-bold">RP 15000</span>
                            </div>
                            <div class="flex flex-col items-center justify-center">
                                <div class="rounded-full bg-slate-950 p-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                        fill="currentColor" class="fill-white" viewBox="0 0 16 16">
                                        <path
                                            d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1v4.5a2.5 2.5 0 0 1-2.5 2.5h-9A2.5 2.5 0 0 1 1 13.5V9a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h1.217L5.07 1.243a.5.5 0 0 1 .686-.172zM2 9v4.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V9H2zM1 7v1h14V7H1zm3 3a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 4 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 6 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 8 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
