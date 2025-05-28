<x-dashboardComponent.admin>
    <x-slot name="header">Table level</x-slot>
    <!-- succes validasi -->
        @if(session('success'))
            <div id="success" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 flex flex-row gap-1.5">
                <i class="bi bi-check-circle-fill"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif
        <div class="w-full text-end mb-6">
            <a href="{{ route('level.create') }}" class="bg-secondary-600 px-4 py-3 rounded-2xl hover:bg-secondary-800 text-white transition-colors duration-100">Tambah Level</a>
        </div>
    <x-dashboardComponent.table>
        <x-slot name="header">Table level</x-slot>
        <x-slot name="thead">
            <th class="px-6 py-3 text-left text-[14px] font-semibold uppercase w-1/6">Level</th>
            <th class="px-6 py-3 text-left text-[14px] font-semibold uppercase w-1/6">Required XP</th>
            <th class="px-6 py-3 text-left text-[14px] font-semibold uppercase w-1/6">Action</th>
        </x-slot>
        {{-- Ganti nama variabel loop dari $levelTreshodls menjadi $levelTreshold --}}
        @foreach ($levelTreshodls as $levelTreshold)
            <tr class="{{ $loop->even ? 'bg-amber-50':'' }}">
                <td class="px-6 py-3 text-left w-1/6">{{$levelTreshold->level}}</td>
                <td class="px-6 py-3 text-left w-1/6">{{$levelTreshold->required_xp}}</td>
                <td class="px-5 py-3 text-left w-1/6">
                    {{-- Gunakan variabel loop yang baru --}}
                    <form action="{{ route('destroyLevel', $levelTreshold->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-500" type="submit" style="cursor:pointer"><i class="bi bi-trash3-fill"></i></button>
                        <a href="{{ route('level.edit', $levelTreshold->id )}}" class="text-sky-700"><i class="bi bi-pencil-square"></i></a>
                    </form>
                </td>
            </tr>
        @endforeach
        
    </x-dashboardComponent.table>
</x-dashboardComponent.admin>