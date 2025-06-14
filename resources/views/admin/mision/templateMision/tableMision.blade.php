<x-dashboardComponent.admin>
    <x-slot name="header">Template Missions</x-slot>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 flex flex-row gap-1.5" role="alert">
            <i class="bi bi-check-circle-fill"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <div class="w-full mb-6 flex justify-center md:justify-end">
        <a href="{{ route('missionTemplate.create') }}" class="bg-secondary-600 px-4 py-3 rounded-2xl hover:bg-secondary-800 text-white transition-colors duration-200 text-sm md:text-base w-full sm:w-auto text-center">
            <span class="hidden sm:inline">Tambah Missions</span>
            <span class="sm:hidden">+ Mission</span>
        </a>
    </div>

    <div class="bg-white w-full rounded-xl flex flex-col shadow-lg border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-center md:hidden">
            <h3 class="text-xl font-semibold text-gray-800 text-center">Tabel Missions</h3>
        </div>

        <div class="px-6 py-4 border-b border-gray-200 hidden md:flex items-center justify-between">
            <h3 class="text-xl font-semibold text-gray-800">Tabel Missions</h3>
            <div class="flex items-center gap-2">
            </div>
        </div>

        <div class="overflow-x-auto hidden md:block">
            <div class="max-h-[500px] overflow-y-auto">
                <x-dashboardComponent.table>
                    <x-slot name="thead">
                        <thead class="bg-gray-50 text-gray-600 sticky top-0 z-10">
                            <tr>
                                <th class="px-6 py-3 text-left text-[14px] font-semibold uppercase whitespace-nowrap">Tipe</th>
                                <th class="px-6 py-3 text-left text-[14px] font-semibold uppercase whitespace-nowrap">Deskripsi</th>
                                <th class="px-6 py-3 text-left text-[14px] font-semibold uppercase whitespace-nowrap">Jumlah Target</th>
                                <th class="px-6 py-3 text-left text-[14px] font-semibold uppercase whitespace-nowrap">XP Reward</th>
                                <th class="px-6 py-3 text-left text-[14px] font-semibold uppercase whitespace-nowrap">Action</th>
                            </tr>
                        </thead>
                    </x-slot>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($template as $t)
                            <tr class="{{ $loop->even ? 'bg-amber-50':'' }} hover:bg-gray-50">
                                <td class="px-5 py-3 text-left whitespace-nowrap">{{ $t->type }}</td>
                                <td class="px-5 py-3 text-left whitespace-nowrap">{{ $t->deskripsi }}</td>
                                <td class="px-5 py-3 text-left whitespace-nowrap">{{ $t->jumlah_target }}</td>
                                <td class="px-5 py-3 text-left whitespace-nowrap">{{ $t->xp_reward }}</td>
                                <td class="px-5 py-3 text-left whitespace-nowrap">
                                    <form action="{{ route('missionTemplate.destroy', $t->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus misi template ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700" title="Hapus"><i class="bi bi-trash3-fill text-lg"></i></button>
                                        <a href="{{ route('missionTemplate.edit', $t->id) }}" class="text-sky-700 hover:text-sky-900 ml-2" title="Edit"><i class="bi bi-pencil-square text-lg"></i></a>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                    Belum ada template misi yang ditambahkan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </x-dashboardComponent.table>
            </div>
        </div>

        <div class="md:hidden divide-y divide-gray-200">
            @forelse ($template as $t)
                <div class="bg-white p-4">
                    <div class="flex items-start space-x-4">
                        <div class="flex-1 min-w-0">
                            <h3 class="text-base font-semibold text-gray-900 leading-tight mb-1 break-words">
                                {{ $t->deskripsi }}
                            </h3>
                            <p class="text-sm text-gray-500 mt-1">
                                <span class="font-bold">Tipe:</span> {{ $t->type }}
                            </p>
                            <p class="text-sm text-gray-500 mt-1">
                                <span class="font-bold">Jumlah Target:</span> {{ $t->jumlah_target }}
                            </p>
                            <p class="text-sm text-gray-500 mt-1">
                                <span class="font-bold">XP Reward:</span> {{ $t->xp_reward }}
                            </p>
                            <div class="mt-3 flex space-x-4 justify-end">
                                <a href="{{ route('missionTemplate.edit', $t->id) }}" class="text-sky-600 hover:text-sky-900 p-2 rounded-full bg-gray-100 hover:bg-gray-200 transition-colors" title="Edit">
                                    <i class="bi bi-pencil-square text-lg"></i>
                                </a>
                                <form action="{{ route('missionTemplate.destroy', $t->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus misi template ini?')" class="inline-block">
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
                    Belum ada template misi yang ditambahkan.
                </div>
            @endforelse
        </div>
    </div>
</x-dashboardComponent.admin>