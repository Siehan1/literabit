<x-dashboardComponent.admin>
    <x-slot name="header">Daily Missions</x-slot>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 flex flex-row gap-1.5" role="alert">
            <i class="bi bi-check-circle-fill"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <div class="w-full mb-6 flex justify-center md:justify-end">
        <a href="{{route('uploadDaily')}}" class="bg-secondary-600 px-4 py-3 rounded-2xl hover:bg-secondary-800 text-white transition-colors duration-200 text-sm md:text-base w-full sm:w-auto text-center">
            <span class="hidden sm:inline">Tambah Daily Mission</span>
            <span class="sm:hidden">+ Daily Mission</span>
        </a>
    </div>

    <div class="bg-white w-full rounded-xl flex flex-col shadow-lg border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-center md:hidden">
            <h3 class="text-xl font-semibold text-gray-800 text-center">Tabel Daily Missions</h3>
        </div>

        <div class="px-6 py-4 border-b border-gray-200 hidden md:flex items-center justify-between">
            <h3 class="text-xl font-semibold text-gray-800">Tabel Daily Missions</h3>
            <div class="flex items-center gap-2">
            </div>
        </div>

        <div class="overflow-x-auto hidden md:block">
            <div class="max-h-[500px] overflow-y-auto">
                <x-dashboardComponent.table>
                    <x-slot name="thead">
                        <thead class="bg-gray-50 text-gray-600 sticky top-0 z-10">
                            <tr>
                                <th class="px-6 py-3 text-center text-[14px] font-semibold uppercase whitespace-nowrap">Tanggal</th>
                                <th class="px-6 py-3 text-left text-[14px] font-semibold uppercase whitespace-nowrap">Tipe</th>
                                <th class="px-6 py-3 text-left text-[14px] font-semibold uppercase whitespace-nowrap">Deskripsi</th>
                                <th class="px-6 py-3 text-center text-[14px] font-semibold uppercase whitespace-nowrap">Status</th>
                                <th class="px-6 py-3 text-center text-[14px] font-semibold uppercase whitespace-nowrap">Aksi</th>
                            </tr>
                        </thead>
                    </x-slot>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($misions as $i)
                            <tr class="{{ $loop->even ? 'bg-amber-50':'' }} hover:bg-gray-50">
                                <td class="px-6 py-4 text-sm text-gray-800 text-center whitespace-nowrap">
                                    {{ date('Y-m-d', strtotime($i->tanggal)) }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-800 text-left whitespace-nowrap">
                                    {{$i->template->type ?? 'N/A'}}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-800 text-left whitespace-nowrap">
                                    {{$i->template->deskripsi ?? 'No Description'}}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-800 text-center whitespace-nowrap">
                                    <span class="{{ $i->is_completed ? 'bg-green-200' : 'bg-red-200' }} {{ $i->is_completed ? 'text-green-700' : 'text-red-700' }} px-3 py-1 rounded-full text-xs font-semibold">
                                        {{ $i->is_completed ? 'Completed' : 'Not Completed' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-800 text-center whitespace-nowrap">
                                    <form action="{{ route('deleteDaily', $i->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus daily mission ini?')" class="inline-flex items-center space-x-2">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700" title="Hapus"><i class="bi bi-trash3-fill text-lg"></i></button>
                                        <a href="{{ route('editDaily', $i->id) }}" class="text-sky-700 hover:text-sky-900" title="Edit"><i class="bi bi-pencil-square text-lg"></i></a>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                    Belum ada daily mission yang ditambahkan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </x-dashboardComponent.table>
            </div>
        </div>

        <div class="md:hidden divide-y divide-gray-200">
            @forelse ($misions as $i)
                <div class="bg-white p-4">
                    <div class="flex items-start space-x-4">
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold text-gray-700">Tanggal: <span class="font-normal">{{ date('Y-m-d', strtotime($i->tanggal)) }}</span></p>
                            <h3 class="text-base font-semibold text-gray-900 leading-tight break-words mt-1">
                                {{ $i->template->deskripsi ?? 'No Description' }}
                            </h3>
                            <p class="text-sm text-gray-500 mt-1">
                                <span class="font-bold">Tipe:</span> {{ $i->template->type ?? 'N/A' }}
                            </p>
                            <p class="text-sm text-gray-500 mt-1">
                                <span class="font-bold">Status:</span>
                                <span class="{{ $i->is_completed ? 'bg-green-200' : 'bg-red-200' }} {{ $i->is_completed ? 'text-green-700' : 'text-red-700' }} px-2 py-0.5 rounded-full text-xs font-semibold">
                                    {{ $i->is_completed ? 'Completed' : 'Not Completed' }}
                                </span>
                            </p>
                            <div class="mt-3 flex space-x-4 justify-end">
                                <a href="{{ route('editDaily', $i->id) }}" class="text-sky-600 hover:text-sky-900 p-2 rounded-full bg-gray-100 hover:bg-gray-200 transition-colors" title="Edit">
                                    <i class="bi bi-pencil-square text-lg"></i>
                                </a>
                                <form action="{{ route('deleteDaily', $i->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus daily mission ini?')" class="inline-block">
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
                    Belum ada daily mission yang ditambahkan.
                </div>
            @endforelse
        </div>
    </div>
</x-dashboardComponent.admin>