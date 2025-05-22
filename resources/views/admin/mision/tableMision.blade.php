<x-dashboardComponent.admin>
<x-slot name="header">Template Missions</x-slot>
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 flex flex-row gap-1.5">
            <i class="bi bi-check-circle-fill"></i>
            <span>{{ session('success') }}</span>
            
        </div>
    @endif
    <div class="w-full text-end mb-6">
        <a href="{{ route('uploadTemplate') }}" class="bg-secondary-600 px-4 py-3 rounded-2xl hover:bg-secondary-800 text-white transition-colors duration-100">Tambah Buku</a>
    </div>
    <x-dashboardComponent.table>
        <x-slot name="thead">
            <th class="px-6 py-3 text-left text-[14px] font-semibold uppercase w-1/6">Tipe</th>
            <th class="px-6 py-3 text-left text-[14px] font-semibold uppercase w-1/6">Deskripsi</th>
            <th class="px-6 py-3 text-left text-[14px] font-semibold uppercase w-1/6">Jumlah Targe</th>
            <th class="px-6 py-3 text-left text-[14px] font-semibold uppercase w-1/6">XP Reward</th>
            @foreach ($template as $t)
            <tr>
                <td class="px-5 py-3 text-left w-1/6">{{ $t->type }}</td>
                <td class="px-5 py-3 text-left w-1/6">{{ $t->deskripsi }}</td>
                <td class="px-5 py-3 text-left w-1/6">{{ $t->jumlah_target }}</td>
                <td class="px-5 py-3 text-left w-1/6">{{ $t->xp_reward }}</td>
                <td class="px-5 py-3 text-left w-1/6">
                    {{-- Gunakan variabel loop yang baru --}}
                    <form action="{{ route('destroyMission', $t->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class=""><i class="bi bi-trash3-fill"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </x-slot>

    </x-dashboardComponent.table>
</x-dashboardComponent.admin>