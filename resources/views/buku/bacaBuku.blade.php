<x-buku.layout-buku>
    @section('content')
        <div class="min-h-screen bg-[#FEE8CD] flex items-center justify-center py-10">
            <div
                class="book-container relative w-[800px] h-[600px] bg-white rounded-xl shadow-lg flex flex-col items-center justify-center p-6">
                <!-- Tombol tutup -->
                <a href="{{ route('buku.beranda') }}"
                    class="cancel absolute top-3 right-3 bg-red-500 hover:bg-red-700 text-white rounded-full w-8 h-8 flex items-center justify-center text-lg font-bold">
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
                    <a href="{{ route('buku.beranda') }}" id="keBeranda"
                        class="hidden transform bg-green-600 hover:bg-green-700 text-white px-8 py-2 rounded-lg font-semibold">
                        ke beranda
                    </a>

                    <!-- Tombol Selesai -->
                    @if (!$sudahKuis)
                        <a href="{{ route('kuis.intro', $buku->slug) }}" id="selesai-btn"
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

                        const keBerandaBtn = document.getElementById('keBeranda');
                        const selesaiBtn = document.getElementById('selesai-btn');

                        if (num === pdfDoc.numPages) {
                            if (keBerandaBtn) keBerandaBtn.classList.remove('hidden');

                            if (!sudahKuis && selesaiBtn) {
                                selesaiBtn.classList.remove('hidden');
                            }
                            updateProgress(num, 'completed');
                        } else {
                            if (keBerandaBtn) keBerandaBtn.classList.add('hidden');
                            if (selesaiBtn) selesaiBtn.classList.add('hidden');
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
                })
                .then(response => {
                    if (!response.ok) {
                        console.error('Failed to save progress');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Progress saved:', data);

                    // Jika selesai membaca (mencapai halaman terakhir)
                    if (status === 'completed') {
                        recordBookRead({{ auth()->id() }}, {{ $buku->id }});
                    }
                })
                .catch(error => console.error('Error:', error));
            };

            // FUNGSI YANG DIPERBAIKI untuk mencatat pembacaan buku
            function recordBookRead(userId, bookId) {
                console.log('Recording book read for user:', userId, 'book:', bookId);
                
                // OPSI 1: Jika route menggunakan parameter URL
                const recordUrl = `/record-reading/${userId}/${bookId}`;
                
                fetch(recordUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({}) // Body kosong karena data ada di URL
                })
                .then(response => {
                    console.log('Response status:', response.status);
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        console.log('Book reading recorded successfully:', data);
                        
                        // Tampilkan notifikasi jika ada misi yang terupdate
                        if (data.data && data.data.updated_missions_count > 0) {
                            showMissionUpdateNotification(data.data.updated_missions_count);
                        }
                    } else {
                        console.error('Error recording book read:', data.message);
                    }
                })
                .catch(error => {
                    console.error('Error in recordBookRead:', error);
                });
            }

            // Fungsi untuk menampilkan notifikasi
            function showMissionUpdateNotification(count) {
                // Buat elemen notifikasi
                const notification = document.createElement('div');
                notification.className = 'fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 transition-all duration-300';
                notification.innerHTML = `
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        <span>Selamat! ${count} misi harian telah terupdate!</span>
                    </div>
                `;
                
                document.body.appendChild(notification);
                
                // Animasi masuk
                setTimeout(() => {
                    notification.style.transform = 'translateX(0)';
                }, 100);
                
                // Hilangkan notifikasi setelah 4 detik
                setTimeout(() => {
                    notification.style.transform = 'translateX(100%)';
                    setTimeout(() => {
                        if (notification.parentNode) {
                            notification.parentNode.removeChild(notification);
                        }
                    }, 300);
                }, 4000);
            }

        </script>
    @endsection
</x-buku.layout-buku>