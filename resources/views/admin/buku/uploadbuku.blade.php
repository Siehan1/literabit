<x-dashboardComponent.admin>
    <a href="{{route('tableBuku')}}" class="hidden md:block"><i class="bi bi-arrow-left text-4xl hover:text-primary transition-colors duration-200"></i></a>
    <div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl shadow-lg p-6 sm:p-8">
            <h2 class="text-2xl font-bold text-primary mb-8 text-center">Upload Buku Baru</h2>
            
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 flex flex-row gap-1.5">
                        @foreach ($errors->all() as $error)
                            <i class="bi bi-exclamation-triangle-fill text-red-700 "></i>
                            <span>{{$error}}</span>
                        @endforeach
                </div>
            @endif
            <form action="{{route('buku.store')}}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Judul Buku -->
                    <div class="space-y-2">
                        <label for="judul" class="block text-sm font-medium text-teks">Judul Buku <span class="text-red-500">*</span></label>
                        <input type="text" id="judul" required
                            class="w-full px-4 py-2.5 rounded-xl border-2 border-gray-200 focus:border-primary focus:ring focus:ring-primary/20 focus:outline-none transition-all duration-200"
                            placeholder="Masukkan judul buku"
                            name="judul">
                    </div>

                    <!-- Penulis -->
                    <div class="space-y-2">
                        <label for="penulis" class="block text-sm font-medium text-teks">Penulis <span class="text-red-500">*</span></label>
                        <input type="text" id="penulis" required
                            class="w-full px-4 py-2.5 rounded-xl border-2 border-gray-200 focus:border-primary focus:ring focus:ring-primary/20 focus:outline-none transition-all duration-200"
                            placeholder="Masukkan nama penulis"
                            name="penulis">
                    </div>

                    <!-- Genre -->
                    <div class="space-y-2">
                        <label for="genre" class="block text-sm font-medium text-teks">Genre <span class="text-red-500">*</span></label>
                        <select id="genre" required
                            class="w-full px-4 py-2.5 rounded-xl border-2 border-gray-200 focus:border-primary focus:ring focus:ring-primary/20 focus:outline-none transition-all duration-200"
                            name="genre">
                            <option value="" disabled selected>Pilih genre buku</option>
                            @foreach ($genres as $genre)
                            <option value="{{ $genre->id }}">{{ $genre->nama_genre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Level -->
                    <div class="space-y-2">
                        <label for="level" class="block text-sm font-medium text-teks">Level Minimum <span class="text-red-500">*</span></label>
                        <input type="number" id="level" required 
                            class="w-full px-4 py-2.5 rounded-xl border-2 border-gray-200 focus:border-primary focus:ring focus:ring-primary/20 focus:outline-none transition-all duration-200" 
                            placeholder="Masukkan level minimum" 
                            name="level" min="0" value="0">
                    </div>

                    <!-- Sinopsis -->
                    <div class="space-y-2 md:col-span-2">
                        <label for="sinopsis" class="block text-sm font-medium text-teks">Sinopsis <span class="text-red-500">*</span></label>
                        <textarea id="sinopsis" required
                            class="w-full px-4 py-2.5 rounded-xl border-2 border-gray-200 focus:border-primary focus:ring focus:ring-primary/20 focus:outline-none transition-all duration-200"
                            placeholder="Masukkan sinopsis buku"
                            name="sinopsis"
                            rows="4"></textarea>
                    </div>

                    <!-- File Upload -->
                    <div class="space-y-2 md:col-span-2">
                        <label for="pdf_file" class="block text-sm font-medium text-teks">File PDF <span class="text-red-500">*</span></label>
                        <div class="flex items-center justify-center w-full">
                            <label for="pdf_file" id="uploadLabel" class="flex flex-col items-center justify-center w-full h-32 sm:h-40 md:h-48 border-2 border-gray-200 border-dashed rounded-xl cursor-pointer hover:bg-gray-50 transition-all duration-200">
                                <div class="flex flex-col items-center justify-center px-4 py-5 sm:py-6" id="uploadContent">
                                    <svg class="w-6 h-6 sm:w-8 sm:h-8 mb-2 sm:mb-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                    </svg>
                                    <p class="mb-1 sm:mb-2 text-xs sm:text-sm text-center text-gray-500"><span class="font-semibold">Klik untuk upload</span> atau drag and drop</p>
                                    <p class="text-xs text-gray-500 text-center">PDF (MAX. 10MB)</p>
                                </div>
                                <input id="pdf_file" type="file" class="hidden" accept=".pdf" name="pdf_file" required />
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-center mt-8">
                    <button type="submit"
                        class="px-8 py-3 bg-primary text-white rounded-xl font-medium hover:bg-hover transition-all duration-200 shadow-[0px_4px_0px_0px_rgba(201,144,75,1.00)] hover:shadow-[0px_2px_0px_0px_rgba(201,144,75,1.00)] hover:-translate-y-0.5 active:translate-y-0 active:shadow-[0px_0px_0px_0px_rgba(201,144,75,1.00)]">
                        Upload Buku
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-dashboardComponent.admin>