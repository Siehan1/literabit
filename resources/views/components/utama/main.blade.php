<main class="w-[60%] ml-[20%] mr-[20%] bg-primary-100">
    <div class="flex flex-row justify-between px-8 items-center pt-8 pb-3">
        <div class="font-bold text-teks font-poppins text-2xl flex flex-wrap">
            <h1>Selamat datang kembali {{ Auth::user()->name }}!</h1>
        </div>
        <div>
            <form action="" method="GET" class="w-full">
                <div class="relative">
                    <input type="text" name="search" placeholder="Search..." class="w-full px-5 py-1 border border-gray-300 bg-white rounded-3xl focus:outline-none focus:border-blue-500">
                    <button type="submit" class="absolute right-2 top-1/2 transform -translate-y-1/2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="mx-3 mt-2 bg-white p-4 rounded-2xl">
        <div class="flex flex-row gap-4 items-center" >
            <div class=" bg-secondary-200 flex items-center justify-center h-10 w-10 rounded-full">
                <i class="bi bi-star-fill text-secondary-600 text-[24px] w-full text-center"></i>
            </div>
            <div class="flex flex-col justify-center">
                <h1 class="text-[18px] font-poppins text-teks font-medium">Level 0: Belajar Membaca</h1>
                <p class="text-[14px] text-sec font-poppins">Mulai Belajar Membaca</p>
            </div>
            <div class="ml-auto">
                <a href="#" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg font-poppins text-sm transition duration-200">
                    Skip Level
                </a>
            </div>
        </div>
        <div>
            
        </div>
        <div>
        
        </div>
    </div>

</main>