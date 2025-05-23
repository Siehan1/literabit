<x-dashboardComponent.admin>
    <a href="{{route('tableBadges')}}"><i class="bi bi-arrow-left text-4xl hover:text-primary transition-colors duration-200"></i></a>
    <div class="max-w-3xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl shadow-lg p-6 sm:p-8">
            <h2 class="text-2xl font-bold text-primary mb-8 text-center">Upload Badges Baru</h2>
            <div>
                <!-- for success -->
                @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 flex flex-row gap-1.5">
                        @foreach ($errors->all() as $error)
                            <i class="bi bi-exclamation-triangle-fill text-red-700 "></i>
                            <span>{{$error}}</span>
                        @endforeach
                </div>
            @endif
                
            </div>

            <form action="{{route('badge.update', $badge->id)}}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                <!-- name badges -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label for="nama_badge" class="block text-sm font-medium text-teks ">Nama Badges <span class="text-red-500">*</span></label>
                        <input value="{{$badge->nama_badge}}" type="text" id="nama_badge" required name="nama_badge" placeholder="Masukan nama badges" class="w-full px-4 py-2.5 rounded-xl border-2 border-gray-200 focus:border-primary focus:ring focus:ring-primary/20 focus:outline-none transition-all duration-200">
                    </div>


                    <!-- description Badge -->
                    <div class="space-y-2">
                        <label for="description" class="block text-sm font-medium text-teks">Deskripsi Badges <span class="text-red-500">*</span></label>
                        <input value="{{$badge->description}}" type="text" id="description" required name="description" placeholder="Masukan Deskripsi" class="w-full px-4 py-2.5 rounded-xl border-2 border-gray-200 focus:border-primary focus:ring focus:ring-primary/20 focus:outline-none transition-all duration-200">
                    </div>

                    <!-- icon badges -->
                    <div class="space-y-2 md:col-span-2">
                        <label for="icon_path" class="block text-sm font-medium text-teks">Icon Gambar Badges <span class="text-red-500">*</span></label>
                        <img src="{{asset('storage/' . $badge->icon_path)}}" alt="">
                        <div class="flex items-center justify-center w-full">
                            <label for="icon_path" class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-200 border-dashed rounded-xl cursor-pointer hover:bg-gray-50 transition-all duration-200">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6" id="uploadIcon">
                                    <svg class="w-8 h-8 mb-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                    </svg>
                                    <p class="mb-2 text-sm text-gray-500 dark:text-gray-400">
                                        <span class="font-semibold">Click to upload</span> or drag and drop
                                    </p>
                                    <p class="text-xs text-gray-500">Image (MAX. 2MB)</p>
                                </div>
                                <input type="file" id="icon_path" name="icon_path" class="hidden" />
                            </label>
                        </div>
                    </div>
                    
                    <!-- submit button -->
                    <div class="flex justify-center mt-8">
                    <button type="submit"
                        class="px-8 py-3 bg-primary text-white rounded-xl font-medium hover:bg-hover transition-all duration-200 shadow-[0px_4px_0px_0px_rgba(201,144,75,1.00)] hover:shadow-[0px_2px_0px_0px_rgba(201,144,75,1.00)] hover:-translate-y-0.5 active:translate-y-0 active:shadow-[0px_0px_0px_0px_rgba(201,144,75,1.00)]">
                        Simpan Badges
                    </button>
                </div>
                </div>
            </form> 
        </div>
    </div>
</x-dashboardComponent.admin>