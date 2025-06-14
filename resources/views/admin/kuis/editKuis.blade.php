<x-dashboardComponent.admin>
    <a href="{{ route('tableKuis') }}" class="hidden md:block"><i class="bi bi-arrow-left text-4xl hover:text-primary transition-colors duration-200"></i></a>
    <div class="max-w-3xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl shadow-lg p-6 sm:p-8">
            <h2 class="text-2xl font-bold text-primary mb-8 text-center">Tambah Kuis Baru</h2>

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

            <form action="{{ route('kuis.update', $kuis->id) }}" method="POST" class="space-y-6">
                @csrf

                <!-- Pilih Buku -->
                <div class="space-y-2">
                    <label for="buku_id" class="block text-sm font-medium text-teks">Pilih Buku <span class="text-red-500">*</span></label>
                    <select id="buku_id" name="buku_id" required class="w-full px-4 py-2.5 rounded-xl border-2 border-gray-200 focus:border-primary focus:ring focus:ring-primary/20 focus:outline-none transition-all duration-200">
                        <option value="" {{ is_null($kuis->buku_id) ? 'selected' : '' }}>-- Pilih Buku --</option>
                        @foreach ($bukus as $book)
                            <option value="{{ $book->id }}" {{ $kuis->buku_id == $book->id ? 'selected' : '' }}>{{ $book->judul }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Pertanyaan Kuis -->
                <div class="space-y-2">
                    <label for="pertanyaan" class="block text-sm font-medium text-teks">Pertanyaan Kuis <span class="text-red-500">*</span></label>
                    <input value="{{ $kuis->pertanyaan }}" type="text" id="pertanyaan" name="pertanyaan" required placeholder="Masukan pertanyaan kuis" value="{{ old('pertanyaan') }}" class="w-full px-4 py-2.5 rounded-xl border-2 border-gray-200 focus:border-primary focus:ring focus:ring-primary/20 focus:outline-none transition-all duration-200">
                </div>

                <!-- Pilihan Jawaban -->
                <div id="choices-container" class="space-y-4">
                    <h3 class="text-lg font-semibold text-teks">Pilihan Jawaban <span class="text-red-500">*</span></h3>
                    <!-- Pilihan jawaban akan ditambahkan di sini oleh JavaScript -->
                    @if (old('choices'))
                        @foreach (old('choices') as $index => $oldChoice)
                            <div class="flex items-center space-x-4 choice-item">
                                <input type="text" name="choices[{{ $index }}][choice_text]" placeholder="Teks Pilihan" value="{{ $oldChoice['choice_text'] ?? '' }}" required class="flex-grow px-4 py-2.5 rounded-xl border-2 border-gray-200 focus:border-primary focus:ring focus:ring-primary/20 focus:outline-none transition-all duration-200">
                                <label class="flex items-center space-x-2 text-sm font-medium text-teks">
                                    <input type="radio" name="correct_choice_index" value="{{ $index }}" {{ old('correct_choice_index') == $index ? 'checked' : '' }} class="form-radio text-primary focus:ring-primary/20">
                                    <span>Benar</span>
                                </label>
                                <button type="button" class="text-red-500 hover:text-red-700 remove-choice">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </div>
                        @endforeach
                    @else
                        @foreach ($kuis->choices as $index => $choice)
                            <div class="flex items-center space-x-4 choice-item">
                                <input type="text" name="choices[{{ $index }}][choice_text]" placeholder="Teks Pilihan"
                                    value="{{ $choice->choice_text }}" required
                                    class="flex-grow px-4 py-2.5 rounded-xl border-2 border-gray-200 focus:border-primary focus:ring focus:ring-primary/20 focus:outline-none transition-all duration-200">
                                <label class="flex items-center space-x-2 text-sm font-medium text-teks">
                                    <input type="radio" name="correct_choice_index" value="{{ $index }}"
                                        {{ $choice->is_correct ? 'checked' : '' }}
                                        class="form-radio text-primary focus:ring-primary/20">
                                    <span>Benar</span>
                                </label>
                                <button type="button" class="text-red-500 hover:text-red-700 remove-choice">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </div>
                        @endforeach
                    @endif
                </div>

                <button type="button" id="add-choice" class="px-4 py-2 bg-gray-200 text-teks rounded-xl hover:bg-gray-300 transition-colors duration-200">Tambah Pilihan</button>

                <!-- submit button -->
                <div class="flex justify-center mt-8">
                    <button type="submit"
                        class="px-8 py-3 bg-primary text-white rounded-xl font-medium hover:bg-hover transition-all duration-200 shadow-[0px_4px_0px_0px_rgba(201,144,75,1.00)] hover:shadow-[0px_2px_0px_0px_rgba(201,144,75,1.00)] hover:-translate-y-0.5 active:translate-y-0 active:shadow-[0px_0px_0px_0px_rgba(201,144,75,1.00)]">
                        Simpan Kuis
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
    <script>
        console.log('Script uploadKuis.blade.php dimuat.'); // Tambahkan log ini

        document.addEventListener('DOMContentLoaded', function () {
            console.log('DOMContentLoaded terpicu.'); // Tambahkan log ini

            const choicesContainer = document.getElementById('choices-container');
            const addChoiceButton = document.getElementById('add-choice');

            if (!choicesContainer || !addChoiceButton) {
                console.error('Elemen choices-container atau add-choice tidak ditemukan!'); // Log error jika elemen tidak ada
                return; // Hentikan eksekusi jika elemen tidak ditemukan
            }

            function addChoice(choiceText = '', isCorrect = false) {
                const choiceCount = choicesContainer.querySelectorAll('.choice-item').length;
                const choiceHtml = `
                    <div class="flex items-center space-x-4 choice-item">
                        <input type="text" name="choices[${choiceCount}][choice_text]" placeholder="Teks Pilihan" value="${choiceText}" required class="flex-grow px-4 py-2.5 rounded-xl border-2 border-gray-200 focus:border-primary focus:ring focus:ring-primary/20 focus:outline-none transition-all duration-200">
                        <label class="flex items-center space-x-2 text-sm font-medium text-teks">
                            <input type="radio" name="correct_choice_index" value="${choiceCount}" ${isCorrect ? 'checked' : ''} class="form-radio text-primary focus:ring-primary/20">
                            <span>Benar</span>
                        </label>
                        <button type="button" class="text-red-500 hover:text-red-700 remove-choice">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </button>
                    </div>
                `;
                choicesContainer.insertAdjacentHTML('beforeend', choiceHtml);
                 console.log('Pilihan baru ditambahkan. Jumlah pilihan:', choicesContainer.querySelectorAll('.choice-item').length); // Log penambahan
            }

            // Add event listener for adding choices
            addChoiceButton.addEventListener('click', function () {
                addChoice();
            });

            // Add event listener for removing choices using event delegation
            choicesContainer.addEventListener('click', function (event) {
                if (event.target.closest('.remove-choice')) {
                    const choiceItem = event.target.closest('.choice-item');
                    if (choicesContainer.querySelectorAll('.choice-item').length > 2) { // Minimal 2 pilihan
                         choiceItem.remove();
                         console.log('Pilihan dihapus. Jumlah pilihan:', choicesContainer.querySelectorAll('.choice-item').length); // Log penghapusan
                         // Re-index choices after removal
                         choicesContainer.querySelectorAll('.choice-item').forEach((item, index) => {
                            item.querySelector('input[type="text"]').name = `choices[${index}][choice_text]`;
                            const radio = item.querySelector('input[type="radio"]');
                            radio.value = index;
                            // If the removed item was the checked one, uncheck it
                            // This part might need adjustment depending on exact behavior needed
                            // For simplicity, let's just re-check the first one if none are checked
                         });
                         // Ensure one radio is checked after removal if items > 0
                         if (choicesContainer.querySelectorAll('input[type="radio"]:checked').length === 0 && choicesContainer.querySelectorAll('.choice-item').length > 0) {
                             choicesContainer.querySelector('input[type="radio"]').checked = true;
                         }

                    } else {
                        alert('Minimal harus ada 2 pilihan jawaban.');
                    }
                }
            });

            // Add initial choices if none exist (e.g., on first load or validation error without old input)
            if (choicesContainer.querySelectorAll('.choice-item').length === 0) {
                 console.log('Menambahkan 2 pilihan awal.'); // Log penambahan awal
                 addChoice();
                 addChoice();
            }
             // Ensure one radio is checked on load if items > 0
            if (choicesContainer.querySelectorAll('input[type="radio"]:checked').length === 0 && choicesContainer.querySelectorAll('.choice-item').length > 0) {
                 console.log('Memastikan radio button pertama terpilih.'); // Log pemilihan radio awal
                choicesContainer.querySelector('input[type="radio"]').checked = true;
            }
        });
    </script>
    @endpush
</x-dashboardComponent.admin>