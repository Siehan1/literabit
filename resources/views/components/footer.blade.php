<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" class="z-10"><path fill="#E2F4E4" fill-opacity="1" d="M0,128L34.3,133.3C68.6,139,137,149,206,160C274.3,171,343,181,411,181.3C480,181,549,171,617,176C685.7,181,754,203,823,192C891.4,181,960,139,1029,106.7C1097.1,75,1166,53,1234,58.7C1302.9,64,1371,96,1406,112L1440,128L1440,320L1405.7,320C1371.4,320,1303,320,1234,320C1165.7,320,1097,320,1029,320C960,320,891,320,823,320C754.3,320,686,320,617,320C548.6,320,480,320,411,320C342.9,320,274,320,206,320C137.1,320,69,320,34,320L0,320Z"></path></svg>
<footer class="bg-secondary-bg lg:-mt-20 md:-mt-14 -mt-9">
    <div class="mx-4 font-poppins">
        <div class="lg:flex lg:flex-row lg:justify-between lg:items-center lg:px-7 md:flex md:flex-row md:justify-between md:items-center md:px-5">
            <!-- logo brand -->
            <div class="inline-flex justify-center items-center gap-2 pt-2">
                <a href="#" class="flex item-center pt-3">
                    <img src="{{asset('asset/images/icon.svg')}}" alt="LiteraBit Logo" class="w-10 md:w-12 lg:w-14 h-max">
                </a>
                <div class="w-24 inline-flex flex-col justify-start items-start">
                    <span class="self-stretch justify-start text-primary text-sm md:text-base font-bold font-['Poppins'] leading-tight">LittleRabbit</span>
                    <span class="self-stretch justify-start text-orange-300 text-[9px] md:text-[10.24px] font-normal font-['Poppins'] leading-3">Little Reading Habbit</span>
                </div>
            </div>

            <!-- info -->
            <div class="flex flex-row gap-3 mt-5 mb-5">
                @php
                    $sosialIcons =[
                        ['name' => 'facebook','link'=>'#','icon'=>'fb.svg'],
                        ['name' => 'twitter','link'=>'#','icon'=>'twt.svg'],
                        ['name' => 'instagram','link'=>'#','icon'=>'ig.svg'],
                        ['name' => 'github','link'=>'#','icon'=>'github.svg'],
                    ]
                @endphp

                @foreach ($sosialIcons as $icon)
                    <a href="{{ $icon['link'] }}" class="group relative p-2 hover:bg-primary rounded-full transition-all duration-200">
                        <img src="{{ asset('asset/images/' . $icon['icon']) }}" 
                             alt="{{ $icon['name'] }}" 
                             class="w-5 md:w-6 h-5 md:h-6 transition-transform duration-200 group-hover:scale-110">
                    </a>
                @endforeach
            </div>
        </div>

        {{-- nav-footer --}}
        <div class="lg:flex lg:flex-row lg:justify-between md:flex md:flex-row md:justify-between lg:pt-4 md:pt-2">
            <div class="w-auto text-teks font-poppins text-4 font-medium md:text-[16px] lg:text-[20px] md:w-[350px] lg:w-[430px] lg:pl-6 md:pl-4">
                <p>Membangun Kebiasaan Membaca dengan Quiz interaktif dan puzzle menyenangkan</p>
            </div>
            <div class="pb-6 flex flex-wrap gap-6 w-auto md:gap-8 lg:gap-10 pt-6 lg:pt-0 md:pt-0 lg:pr-7 md:pr-5">
                <div class="flex flex-col leading-4">
                    <h4 class="text-teks text-sm md:text-base">Tentang Kami</h4>
                    @foreach ([
                        'Buku' => '#buku',
                        'Karir' => '#karir',
                        'Hubungi Kami' => '#kontak',
                    ] as $text => $link)
                    <a href="{{ $link }}" class="text-sec text-[10px] md:text-xs relative group py-1.5 block hover:text-primary transition-colors duration-200">
                        {{ ucfirst($text) }}
                        <div class="absolute w-full h-0.5 bg-primary scale-x-0 group-hover:scale-x-100 transition-transform left-0 mt-1 group-active:scale-x-100"></div>
                    </a>
                    @endforeach
                </div>
    
                <div class="flex flex-col leading-4">
                    <h4 class="text-teks text-sm md:text-base">Bantuan</h4>
                    @foreach ([
                        'Little Rabbit' => '#FAQ',
                        'Customer Support' => '#support'
                    ] as $text => $link)
                        <a href="{{ $link }}" class="text-sec text-[10px] md:text-xs relative group py-1.5 block hover:text-primary transition-colors duration-200">
                            {{ ucfirst($text) }}
                            <div class="absolute w-full h-0.5 bg-primary scale-x-0 group-hover:scale-x-100 transition-transform left-0 mt-1 group-active:scale-x-100"></div>
                        </a>
                    @endforeach
                </div>
                <div class="flex flex-col leading-4">
                    <h4 class="text-teks text-sm md:text-base">Legal</h4>
                    @foreach ([
                        'Kebijakan Komunitas' => '#kebijakan',
                        'Kebijakan Privasi' => '#privasi',
                        'Term of Service' => '#term',
                    ] as $text => $link)
                        <a href="{{ $link }}" class="text-sec text-[10px] md:text-xs relative group py-1.5 block hover:text-primary transition-colors duration-200">
                            {{ ucfirst($text) }}
                            <div class="absolute w-full h-0.5 bg-primary scale-x-0 group-hover:scale-x-100 transition-transform left-0 mt-1 group-active:scale-x-100"></div>
                        </a>
                    @endforeach
                </div>            
            </div>
        </div>
       
        <div class="border-t border-gray-200">
            <div class="py-4">
                <p class="text-teks text-[10px] md:text-xs text-start md:pl-5 lg:pl-7">
                    &copy; {{ date('Y') }} Little Rabbit. All rights reserved.
                </p>
            </div>
        </div>
    </div>
</footer>
