<x-buku.layout-buku>
    @section('content')
    <div class="min-h-screen bg-[#FEE8CD] flex items-center justify-center py-10">
        <div class="book-container relative w-[800px] h-[600px] bg-white rounded-xl shadow-lg flex flex-col items-center justify-center p-6">
            <!-- Tombol tutup -->
            
            <a href="{{ route('buku.beranda') }}" class="cancel absolute top-3 right-3 bg-red-500 hover:bg-red-700 text-white rounded-full w-8 h-8 flex items-center justify-center text-lg font-bold">
                &times;
            </a>

            <!-- Halaman -->
            <div class="page flex-1 w-full flex items-center justify-center overflow-hidden">
                <canvas id="pdf-render" class="max-w-full max-h-full object-contain"></canvas>
            </div>

            <!-- Navigasi Halaman -->
            <div class="flex items-center justify-between w-full mt-4">
                <button id="prev-page" class="px-4 py-2 bg-gray-300 hover:bg-gray-400 rounded">Sebelumnya</button>
                <span>Halaman <span id="page-num">1</span> / <span id="page-count">-</span></span>
                <button id="next-page" class="px-4 py-2 bg-gray-300 hover:bg-gray-400 rounded">Selanjutnya</button>
            </div>
            <div class="absolute bottom-4 bg-white flex flex-row justify-center gap-2 items-center">
                <a href="{{ route('buku.beranda') }}"
                    id="keBeranda" 
                    class="hidden transform  bg-green-600 hover:bg-green-700 text-white px-8 py-2 rounded-lg font-semibold">
                    ke beranda
                </a>

                <!-- Tombol Selesai -->
                @if (!$sudahKuis)
                    <a href="{{ route('kuis.intro', $buku->slug) }}"
                        id="selesai-btn" 
                        class="hidden transform bg-purple-600 hover:bg-purple-700 text-white px-6 py-2 rounded-lg font-semibold">
                        Kerjakan Kuis
                    </a>
                @endif
            </div>
            
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.4.120/pdf.min.js"></script>
    <script>
        const url = "{{ route('bacaBuku.pdf', $buku->slug) }}";
        const pdfjsLib = window['pdfjs-dist/build/pdf'];
        pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.4.120/pdf.worker.min.js';
        const sudahKuis = {{ $sudahKuis ? 'true' : 'false' }};

        let pdfDoc = null,
            pageNum = {{ $lastPage }},
            pageIsRendering = false,
            pageNumIsPending = null;

        const scale = 1.5,
            canvas = document.getElementById('pdf-render'),
            ctx = canvas.getContext('2d');

        const renderPage = num => {
            pageIsRendering = true;

            pdfDoc.getPage(num).then(page => {
                const viewport = page.getViewport({ scale });
                canvas.height = viewport.height;
                canvas.width = viewport.width;

                const renderCtx = {
                    canvasContext: ctx,
                    viewport
                };

                page.render(renderCtx).promise.then(() => {
                    pageIsRendering = false;

                    if (pageNumIsPending !== null) {
                        renderPage(pageNumIsPending);
                        pageNumIsPending = null;
                    }

                    document.getElementById('page-num').textContent = num;

                    if (num === pdfDoc.numPages) {
                        document.getElementById('keBeranda').classList.remove('hidden');

                        if (!sudahKuis) {
                            document.getElementById('selesai-btn').classList.remove('hidden');
                        } else {
                            document.getElementById('selesai-btn').classList.add('hidden');
                        }

                        updateProgress(num, 'completed');
                    } else {
                        document.getElementById('keBeranda').classList.add('hidden');
                        document.getElementById('selesai-btn').classList.add('hidden');
                        updateProgress(num, 'reading');
                    }
                });
            });
        };

        const queueRenderPage = num => {
            if (pageIsRendering) {
                pageNumIsPending = num;
            } else {
                renderPage(num);
            }
        };

        const showPrevPage = () => {
            if (pageNum <= 1) return;
            pageNum--;
            queueRenderPage(pageNum);
        };

        const showNextPage = () => {
            if (pageNum >= pdfDoc.numPages) return;
            pageNum++;
            queueRenderPage(pageNum);
        };

        pdfjsLib.getDocument(url).promise.then(pdfDoc_ => {
            pdfDoc = pdfDoc_;
            document.getElementById('page-count').textContent = pdfDoc.numPages;
            renderPage(pageNum);
        });

        
        document.getElementById('prev-page').addEventListener('click', showPrevPage);
        document.getElementById('next-page').addEventListener('click', showNextPage);

        const updateProgress = (page, status = 'reading') => {
            fetch("{{ route('bacaBuku.progress') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    buku_id: {{ $buku->id }},
                    halaman: page,
                    status: status
                })
            });
        };
        
    </script>
    @endsection
</x-buku.layout-buku>
