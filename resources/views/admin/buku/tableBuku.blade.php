<x-dashboardComponent.admin>
    <x-slot name="header">Daftar Buku</x-slot>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 flex flex-row gap-1.5" role="alert">
            <i class="bi bi-check-circle-fill"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <div class="w-full mb-6 flex justify-center md:justify-end">
        <a href="{{ route('buku.create') }}" class="bg-secondary-600 px-4 py-3 rounded-2xl hover:bg-secondary-800 text-white transition-colors duration-200 text-sm md:text-base w-full sm:w-auto text-center">
            <span class="hidden sm:inline">Tambah Buku</span>
            <span class="sm:hidden">+ Buku</span>
        </a>
    </div>

    <div class="bg-white w-full rounded-xl flex flex-col shadow-lg border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-center md:hidden">
            <h3 class="text-xl font-semibold text-gray-800 text-center">Tabel Buku</h3>
        </div>

        <div class="px-6 py-4 border-b border-gray-200 hidden md:flex items-center justify-between">
            <h3 class="text-xl font-semibold text-gray-800">Tabel Buku</h3>
            <div class="flex items-center gap-2">
            </div>
        </div>

        <div class="overflow-x-auto hidden md:block">
            <div class="max-h-[500px] overflow-y-auto">
                <x-dashboardComponent.table>
                    <x-slot name="thead">
                        <thead class="bg-gray-50 text-gray-600 sticky top-0 z-10">
                            <tr>
                                <th class="px-6 py-3 text-left text-[14px] font-semibold uppercase whitespace-nowrap">No</th>
                                <th class="px-6 py-3 text-left text-[14px] font-semibold uppercase whitespace-nowrap">Cover</th>
                                <th class="px-6 py-3 text-left text-[14px] font-semibold uppercase whitespace-nowrap">Judul</th>
                                <th class="px-6 py-3 text-left text-[14px] font-semibold uppercase whitespace-nowrap">Penulis</th>
                                <th class="px-6 py-3 text-left text-[14px] font-semibold uppercase whitespace-nowrap">Level Required</th>
                                <th class="px-6 py-3 text-left text-[14px] font-semibold uppercase whitespace-nowrap">Genre</th>
                                <th class="px-6 py-3 text-left text-[14px] font-semibold uppercase whitespace-nowrap">Action</th>
                            </tr>
                        </thead>
                    </x-slot>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($bukus as $index => $buku)
                            <tr class="{{ $loop->even ? 'bg-amber-50':'' }} hover:bg-gray-50">
                                <td class="px-6 py-3 text-left whitespace-nowrap">{{$index+1}}</td>
                                <td class="px-6 py-3 text-center whitespace-nowrap">
                                    <img src="{{ asset('storage/' . $buku->cover_path)}}" alt="Cover-{{$buku->slug}}" class="w-16 h-24 object-cover mx-auto rounded">
                                </td>
                                <td class="px-6 py-3 text-left whitespace-nowrap">{{$buku->judul}}</td>
                                <td class="px-6 py-3 text-left whitespace-nowrap">{{$buku->penulis}}</td>
                                <td class="px-6 py-3 text-left whitespace-nowrap">{{$buku->level_required}}</td>
                                <td class="px-6 py-3 text-left whitespace-nowrap">{{$buku->genre->nama_genre}}</td>
                                <td class="px-5 py-3 text-left whitespace-nowrap">
                                    <form action="{{ route('buku.destroy', $buku->slug) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus buku {{ $buku->judul }}?')" class="flex flex-row gap-2">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-red-500 hover:text-red-700" type="submit" title="Hapus"><i class="bi bi-trash3-fill"></i></button>
                                        <a href="{{ route('buku.edit', $buku->slug )}}" class="text-sky-700 hover:text-sky-900" title="Edit"><i class="bi bi-pencil-square"></i></a>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                                    Belum ada buku yang ditambahkan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </x-dashboardComponent.table>
            </div>
        </div>

        <div class="md:hidden divide-y divide-gray-200">
            @forelse ($bukus as $buku)
                <div class="bg-white p-4">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <img src="{{ asset('storage/' . $buku->cover_path)}}" alt="Cover-{{$buku->slug}}" class="w-20 h-28 object-cover rounded-lg">
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex flex-col">
                                <h3 class="text-base font-semibold text-gray-900 leading-tight">
                                    {{$buku->judul}}
                                </h3>
                                <p class="text-sm text-gray-500 mt-1">
                                    <span class="font-bold">Penulis:</span> {{$buku->penulis}}
                                </p>
                                <p class="text-sm text-gray-500 mt-1">
                                    <span class="font-bold">Level Required:</span> {{$buku->level_required}}
                                </p>
                                <p class="text-sm text-gray-500 mt-1">
                                    <span class="font-bold">Genre:</span> {{$buku->genre->nama_genre}}
                                </p>
                            </div>
                            <div class="mt-3 flex space-x-4 justify-end">
                                <a href="{{ route('buku.edit', $buku->slug )}}" class="text-sky-600 hover:text-sky-900 p-2 rounded-full bg-gray-100 hover:bg-gray-200 transition-colors" title="Edit">
                                    <i class="bi bi-pencil-square text-lg"></i>
                                </a>
                                <form action="{{ route('buku.destroy', $buku->slug) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus buku {{ $buku->judul }}?')" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-500 hover:text-red-700 p-2 rounded-full bg-gray-100 hover:bg-gray-200 transition-colors" type="submit" title="Hapus">
                                        <i class="bi bi-trash3-fill text-lg"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="px-6 py-4 text-center text-gray-500">
                    Belum ada buku yang ditambahkan.
                </div>
            @endforelse
        </div>
    </div>
</x-dashboardComponent.admin>