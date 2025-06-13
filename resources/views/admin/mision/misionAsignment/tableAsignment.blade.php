<x-dashboardComponent.admin>
    <x-slot name="header">Mission Assignment</x-slot>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 flex flex-row gap-1.5" role="alert">
            <i class="bi bi-check-circle-fill"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <div class="w-full mb-6 flex justify-center md:justify-end">
        <a href="{{ route('create.Asignment') }}" class="bg-secondary-600 px-4 py-3 rounded-2xl hover:bg-secondary-800 text-white transition-colors duration-200 text-sm md:text-base w-full sm:w-auto text-center">
            <span class="hidden sm:inline">Tambah Missions</span>
            <span class="sm:hidden">+ Mission</span>
        </a>
    </div>

    <div class="bg-white w-full rounded-xl flex flex-col shadow-lg border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-center md:hidden">
            <h3 class="text-xl font-semibold text-gray-800 text-center">Tabel Assignments</h3>
        </div>

        <div class="px-6 py-4 border-b border-gray-200 hidden md:flex items-center justify-between">
            <h3 class="text-xl font-semibold text-gray-800">Tabel Assignments</h3>
            <div class="flex items-center gap-2">
            </div>
        </div>

        <div class="overflow-x-auto hidden md:block">
            <div class="max-h-[500px] overflow-y-auto">
                <x-dashboardComponent.table>
                    <x-slot name="thead">
                        <thead class="bg-gray-50 text-gray-600 sticky top-0 z-10">
                            <tr>
                                <th class="px-6 py-3 text-left text-[14px] font-semibold uppercase whitespace-nowrap">Judul</th>
                                <th class="px-6 py-3 text-left text-[14px] font-semibold uppercase whitespace-nowrap">Jumlah Selesai</th>
                                <th class="px-6 py-3 text-left text-[14px] font-semibold uppercase whitespace-nowrap">Status</th>
                                <th class="px-6 py-3 text-left text-[14px] font-semibold uppercase whitespace-nowrap">Aksi</th>
                            </tr>
                        </thead>
                    </x-slot>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($assignments as $a)
                        <tr class="border-b hover:bg-gray-50 {{ $loop->even ? 'bg-amber-50':'' }}">
                            <td class="px-6 py-4 whitespace-nowrap">{{ $a->judul }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $a->jumlah_selesai }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="{{ $a->is_done ? 'bg-green-200' : 'bg-red-200' }} {{ $a->is_done ? 'text-green-700' : 'text-red-700' }} px-3 py-1 rounded-full text-xs font-semibold">
                                    {{ $a->is_done ? 'Completed' : 'Pending' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <form action="{{ route('missionTemplate.destroy', $a->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus assignment {{ $a->judul }}?')" class="inline-flex gap-2">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700" title="Hapus">
                                        <i class="bi bi-trash3-fill text-lg"></i>
                                    </button>
                                    <a href="{{ route('missionTemplate.edit', $a->id) }}" class="text-sky-700 hover:text-sky-900" title="Edit">
                                        <i class="bi bi-pencil-square text-lg"></i>
                                    </a>
                                </form>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                                    Belum ada assignment misi yang ditambahkan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </x-dashboardComponent.table>
            </div>
        </div>

        <div class="md:hidden divide-y divide-gray-200">
            @forelse ($assignments as $a)
                <div class="bg-white p-4">
                    <div class="flex flex-col gap-2">
                        <h3 class="text-base font-semibold text-gray-900 leading-tight break-words">
                            {{ $a->judul }}
                        </h3>
                        <p class="text-sm font-semibold text-gray-700">Jumlah Selesai: <span class="font-normal">{{ $a->jumlah_selesai }}</span></p>
                        <p class="text-sm font-semibold text-gray-700">Status:
                            <span class="{{ $a->is_done ? 'bg-green-200' : 'bg-red-200' }} {{ $a->is_done ? 'text-green-700' : 'text-red-700' }} px-2 py-0.5 rounded-full text-xs font-semibold">
                                {{ $a->is_done ? 'Completed' : 'Pending' }}
                            </span>
                        </p>
                        <div class="mt-3 flex space-x-4 justify-end">
                            <a href="{{ route('missionTemplate.edit', $a->id) }}" class="text-sky-600 hover:text-sky-900 p-2 rounded-full bg-gray-100 hover:bg-gray-200 transition-colors" title="Edit">
                                <i class="bi bi-pencil-square text-lg"></i>
                            </a>
                            <form action="{{ route('missionTemplate.destroy', $a->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus assignment {{ $a->judul }}?')" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-500 hover:text-red-700 p-2 rounded-full bg-gray-100 hover:bg-gray-200 transition-colors" type="submit" title="Hapus">
                                    <i class="bi bi-trash3-fill text-lg"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="px-6 py-4 text-center text-gray-500">
                    Belum ada assignment misi yang ditambahkan.
                </div>
            @endforelse
        </div>
    </div>
</x-dashboardComponent.admin>