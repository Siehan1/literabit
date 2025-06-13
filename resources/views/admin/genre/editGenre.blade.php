<x-dashboardComponent.admin>
    <a href="{{ route('tableGenre') }}" class="hidden md:block"><i class="bi bi-arrow-left text-4xl hover:text-primary transition-colors duration-200"></i></a>
    <div class="max-w-3xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl shadow-lg p-6 sm:p-8">
            <h2 class="text-2xl font-bold text-primary mb-8 text-center">Edit Genre {{$genre->nama_genre}}</h2>

            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Oops!</strong>
                    <span class="block sm:inline">Ada beberapa masalah dengan input Anda.</span>
                    <ul class="mt-2 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('genre.update', $genre->id) }}" method="POST" class="space-y-6">
                @csrf

                <!-- Pertanyaan Kuis -->
                <div class="space-y-2">
                    <label for="pertanyaan" class="block text-sm font-medium text-teks">Nama Genre <span class="text-red-500">*</span></label>
                    <input type="text" id="nama" name="genre" value="{{ $genre->nama_genre }}" required placeholder="ex: Petualangan" value="{{ old('genre') }}" class="w-full px-4 py-2.5 rounded-xl border-2 border-gray-200 focus:border-primary focus:ring focus:ring-primary/20 focus:outline-none transition-all duration-200">
                </div>

                <!-- submit button -->
                <div class="flex justify-center mt-8">
                    <button type="submit"
                        class="px-8 py-3 bg-primary text-white rounded-xl font-medium hover:bg-hover transition-all duration-200 shadow-[0px_4px_0px_0px_rgba(201,144,75,1.00)] hover:shadow-[0px_2px_0px_0px_rgba(201,144,75,1.00)] hover:-translate-y-0.5 active:translate-y-0 active:shadow-[0px_0px_0px_0px_rgba(201,144,75,1.00)]">
                        Simpan Genre
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-dashboardComponent.admin>