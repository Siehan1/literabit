<header class="flex flex-row justify-between item-center mx-7 h-20 text-teks font-poppins">
    <!-- Logo dan Brand -->
    <div class="inline-flex justify-center items-center gap-2 pt-2">
        <a href="#" class="flex item-center pt-3"><img src="{{asset('asset/images/icon.svg')}}" alt="LiteraBit Logo" class="lg:w-14 lg:h-max w-12"></a>
        <div class="w-24 inline-flex flex-col justify-start items-start">
            <span class="self-stretch justify-start text-primary text-base font-bold font-['Poppins'] leading-tight">LittleRabbit</span>
            <span class="LittleReadingHabit self-stretch justify-start text-orange-300 text-[10.24px] font-normal font-['Poppins'] leading-3">Little Reading Habbit</span>
        </div>
    </div>

    <!-- Menu Navigasi -->
    <nav id="nav-menu" class="hidden lg:flex flex-col lg:flex-row items-center fixed lg:static -right-full lg:right-0 top-0 bg-white lg:bg-white w-full lg:w-auto h-screen lg:h-auto py-5 lg:py-0 shadow lg:shadow-none z-50 transition-all duration-300 ease-in-out">
        <!-- Tombol Close untuk Mobile -->
        <button class="lg:hidden absolute right-4 top-4 text-teks hover:fill-primary transition-colors ease duration-100">
            <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24">
                <path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/>
            </svg>
        </button>

        <ul class="flex flex-col lg:flex-row gap-8 mb-4 lg:mb-0 mt-20 lg:mt-0">
            @foreach ([
                'Beranda' => '#beranda',
                'Tentang' => '#tentang',
                'Buku' => '#buku',
                'Testimoni' => '#testimoni',
                'Kontak' => '#kontak'
            ] as $text => $link)
                <li class="text-center">
                    <a href="{{ $link }}" class="text-teks relative group px-4 py-2 block hover:text-primary transition-colors duration-200">
                        {{ ucfirst($text) }}
                        <div class="absolute w-full h-0.5 bg-primary scale-x-0 group-hover:scale-x-100 transition-transform left-0 mt-1 group-active:scale-x-100"></div>
                    </a>
                </li>
            @endforeach
        </ul>
    </nav>

    <!-- Tombol Login dan Hamburger -->
    <div class="flex flex-row gap-3 items-center">
        <a href="#" class="bg-primary lg:px-9 lg:py-2 px-4 py-1.5 rounded-4xl font-medium transition-colors ease-in duration-200 hover:bg-hover shadow-[0px_4px_0px_0px_rgba(201,144,75,1.00)]">Login</a>
        <button class="group lg:hidden">
            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3" class="lg:hidden block fill-teks group-hover:fill-primary transition-colors duration-200">
                <path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z"/>
            </svg>
        </button>
    </div>
</header>

