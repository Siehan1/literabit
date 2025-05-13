<div id="navside" class="text-teks font-poppins px-4 w-full sm:w-[250px] h-16 sm:min-h-screen fixed bottom-0 sm:top-0 sm:bottom-auto shadow-[2px_0_5px_0_rgba(0,0,0,0.05)] transition-all duration-300 bg-white">
    <div class="hidden sm:flex flex-row items-center gap-2 pt-8 pb-7">
        <img src="{{ asset('asset/images/icon.svg') }}" alt="" class="w-10">
        <div id="brandText" class="flex flex-col gap-0 transition-opacity duration-300">
            <span class="text-primary font-bold text-[20px]">LittleRabbit</span>
            <span class="text-primary font-medium text-[14px]">Little Reading Habbit</span>
        </div>
    </div>

    <!-- Tombol Hamburger - hanya tampil di desktop -->
    <button id="toggleNav" class="hidden sm:block absolute -right-4 top-9 bg-white p-1.5 rounded-lg shadow-md hover:bg-gray-50 transition-colors duration-200">
        <svg xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="20" class="fill-teks transition-transform duration-300">
            <path d="M400-280v-400l200 200-200 200Z"/>
        </svg>
    </button>

    <div class="flex flex-row sm:flex-col justify-around sm:justify-start sm:gap-3 gap-4 h-full sm:h-auto items-center sm:items-start">
        @php
            $menuItems = [
                'Beranda' => [
                    'link' => '#home',
                    'icon' => '<path d="M160-120v-480l320-240 320 240v480H560v-280H400v280H160Z"/>'
                ],
                'Koleksi Buku Saya' => [
                    'link' => '#koleksi',
                    'icon' => '<path d="M560-564v-68q33-14 67.5-21t72.5-7q26 0 51 4t49 10v64q-24-9-48.5-13.5T700-600q-38 0-73 9.5T560-564Zm0 220v-68q33-14 67.5-21t72.5-7q26 0 51 4t49 10v64q-24-9-48.5-13.5T700-380q-38 0-73 9t-67 27Zm0-110v-68q33-14 67.5-21t72.5-7q26 0 51 4t49 10v64q-24-9-48.5-13.5T700-490q-38 0-73 9.5T560-454ZM260-320q47 0 91.5 10.5T440-278v-394q-41-24-87-36t-93-12q-36 0-71.5 7T120-692v396q35-12 69.5-18t70.5-6Zm260 42q44-21 88.5-31.5T700-320q36 0 70.5 6t69.5 18v-396q-33-14-68.5-21t-71.5-7q-47 0-93 12t-87 36v394Zm-40 118q-48-38-104-59t-116-21q-42 0-82.5 11T100-198q-21 11-40.5-1T40-234v-482q0-11 5.5-21T62-752q46-24 96-36t102-12q58 0 113.5 15T480-740q51-30 106.5-45T700-800q52 0 102 12t96 36q11 5 16.5 15t5.5 21v482q0 23-19.5 35t-40.5 1q-37-20-77.5-31T700-240q-60 0-116 21t-104 59ZM280-494Z"/>'
                ],
                'Profile' => [
                    'link' => '#profile',
                    'icon' => '<path d="M480-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM160-160v-112q0-34 17.5-62.5T224-378q62-31 126-46.5T480-440q66 0 130 15.5T736-378q29 15 46.5 43.5T800-272v112H160Z"/>'
                ],
                'Lainnya' => [
                    'link' => '#lainnya',
                    'icon' => '<path d="M240-400q-33 0-56.5-23.5T160-480q0-33 23.5-56.5T240-560q33 0 56.5 23.5T320-480q0 33-23.5 56.5T240-400Zm240 0q-33 0-56.5-23.5T400-480q0-33 23.5-56.5T480-560q33 0 56.5 23.5T560-480q0 33-23.5 56.5T480-400Zm240 0q-33 0-56.5-23.5T640-480q0-33 23.5-56.5T720-560q33 0 56.5 23.5T800-480q0 33-23.5 56.5T720-400Z"/>'
                ]
            ];
        @endphp

        @foreach ($menuItems as $label => $item)
            @if($label !== 'Lainnya')
                <a href="{{ $item['link'] }}" class="flex flex-col sm:flex-row items-center gap-1 sm:gap-2 px-2 py-1 sm:py-4 rounded-lg group transition-all duration-200 hover:bg-[#e3e3e3]/20 focus:bg-wave/30 focus:border-[1px] focus:border-primary w-full">
                    <svg xmlns="http://www.w3.org/2000/svg" height="26px" viewBox="0 -960 960 960" width="26px" class="fill-teks group-hover:fill-teks group-focus:fill-primary transition-colors duration-200">
                        {!! $item['icon'] !!}
                    </svg>
                    <span class="nav-text hidden sm:block group-focus:text-primary font-medium transition-opacity duration-300">{{ $label }}</span>
                </a>
            @endif
        @endforeach

        <!-- Dropdown Menu -->
        <div class="relative w-full">
            <button id="dropdownBtn" class="flex flex-col sm:flex-row items-center gap-1 sm:gap-2 px-2 py-1 sm:py-4 rounded-lg transition-all duration-200 hover:bg-[#e3e3e3]/20 focus:bg-wave/30 focus:border-[1px] focus:border-primary w-full">
                <svg xmlns="http://www.w3.org/2000/svg" height="26px" viewBox="0 -960 960 960" width="26px" class="fill-teks group-hover:fill-teks group-focus:fill-primary transition-colors duration-200">
                    <path d="M240-400q-33 0-56.5-23.5T160-480q0-33 23.5-56.5T240-560q33 0 56.5 23.5T320-480q0 33-23.5 56.5T240-400Zm240 0q-33 0-56.5-23.5T400-480q0-33 23.5-56.5T480-560q33 0 56.5 23.5T560-480q0 33-23.5 56.5T480-400Zm240 0q-33 0-56.5-23.5T640-480q0-33 23.5-56.5T720-560q33 0 56.5 23.5T800-480q0 33-23.5 56.5T480-400Z"/>
                </svg>
                <span class="nav-text hidden sm:block group-focus:text-primary font-medium transition-opacity duration-300">Lainnya</span>
            </button>

            <!-- Dropdown Content -->
            <div id="dropdownContent" class="absolute bottom-16 sm:bottom-auto sm:top-0 sm:left-full right-0 sm:right-auto mb-2 sm:mb-0 sm:ml-2 bg-white rounded-lg shadow-lg min-w-[200px] py-2 z-50 hidden">
                <a href="#pengaturan" class="flex items-center gap-3 px-4 py-2.5 text-sm hover:bg-[#e3e3e3]/20 transition-colors duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" height="18px" viewBox="0 -960 960 960" width="18px" fill="#e3e3e3" class="fill-teks"><path d="m370-80-16-128q-13-5-24.5-12T307-235l-119 50L78-375l103-78q-1-7-1-13.5v-27q0-6.5 1-13.5L78-585l110-190 119 50q11-8 23-15t24-12l16-128h220l16 128q13 5 24.5 12t22.5 15l119-50 110 190-103 78q1 7 1 13.5v27q0 6.5-2 13.5l103 78-110 190-118-50q-11 8-23 15t-24 12L590-80H370Zm112-260q58 0 99-41t41-99q0-58-41-99t-99-41q-59 0-99.5 41T342-480q0 58 40.5 99t99.5 41Z"/></svg>
                    </svg>
                    <span>Pengaturan</span>
                </a>
                <a href="#bantuan" class="flex items-center gap-3 px-4 py-2.5 text-sm hover:bg-[#e3e3e3]/20 transition-colors duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" height="18" viewBox="0 -960 960 960" width="18" class="fill-teks">
                        <path d="M478-240q21 0 35.5-14.5T528-290q0-21-14.5-35.5T478-340q-21 0-35.5 14.5T428-290q0 21 14.5 35.5T478-240Zm-36-154h74q0-33 7.5-52t42.5-52q26-26 41-49.5t15-56.5q0-56-41-86t-97-30q-57 0-92.5 30T342-618l66 26q5-18 22.5-39t53.5-21q32 0 48 17.5t16 38.5q0 20-12 37.5T506-526q-44 39-54 59t-10 73Zm38 314q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q134 0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Zm0-320Z"/>
                    </svg>
                    <span>Bantuan</span>
                </a>
                <div class="h-[1px] bg-gray-200 my-1"></div>
                <a href="#keluar" class="flex items-center gap-3 px-4 py-2.5 text-sm text-red-500 hover:bg-red-50 transition-colors duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" height="18" viewBox="0 -960 960 960" width="18" class="fill-red-500">
                        <path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h280v80H200v560h280v80H200Zm440-160-55-58 102-102H360v-80h327L585-622l55-58 200 200-200 200Z"/>
                    </svg>
                    <span>Keluar</span>
                </a>
            </div>
        </div>
    </div>
</div>



