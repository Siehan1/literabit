<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#E2F4E4" fill-opacity="1" d="M0,128L34.3,133.3C68.6,139,137,149,206,160C274.3,171,343,181,411,181.3C480,181,549,171,617,176C685.7,181,754,203,823,192C891.4,181,960,139,1029,106.7C1097.1,75,1166,53,1234,58.7C1302.9,64,1371,96,1406,112L1440,128L1440,320L1405.7,320C1371.4,320,1303,320,1234,320C1165.7,320,1097,320,1029,320C960,320,891,320,823,320C754.3,320,686,320,617,320C548.6,320,480,320,411,320C342.9,320,274,320,206,320C137.1,320,69,320,34,320L0,320Z"></path></svg>
<footer class="bg-secondary-bg lg:-mt-20 -mt-9">
    
    <div class="mx-4">
        <!-- logo brand -->
        <div class="inline-flex justify-center items-center gap-2 pt-2">
            <a href="#" class="flex item-center pt-3"><img src="{{asset('asset/images/icon.svg')}}" alt="LiteraBit Logo" class="lg:w-14 lg:h-max w-10"></a>
            <div class="w-24 inline-flex flex-col justify-start items-start">
                <span class="self-stretch justify-start text-primary text-base font-bold font-['Poppins'] leading-tight">LittleRabbit</span>
                <span class="LittleReadingHabit self-stretch justify-start text-orange-300 text-[10.24px] font-normal font-['Poppins'] leading-3">Little Reading Habbit</span>
            </div>
        </div>

        <!-- info -->
         <div class="w-64 text-teks font-poppins text-xs font-medium mt-4">
            <p>Membangun Kebiasaan Membaca dengan Quiz interaktif dan puzzle menyenangkan</p>
         </div>
         <div class="flex flex-row gap-5 mt-2">
            @php
                $sosialIcons =[
                    ['name' => 'facebook','link'=>'#','icon'=>'fb.svg'],
                    ['name' => 'twitter','link'=>'#','icon'=>'twt.svg'],
                    ['name' => 'instagram','link'=>'#','icon'=>'ig.svg'],
                    ['name' => 'github','link'=>'#','icon'=>'github.svg'],
                ]
            @endphp

            @foreach ($sosialIcons as $icon)
                <a href="{{ $icon['link'] }}"><img src="{{ asset('asset/images/' . $icon['icon']) }}" alt="{{ $icon['name'] }}" class="w-6 h-6"></a>
            @endforeach
         </div>
    </div>

</footer>
