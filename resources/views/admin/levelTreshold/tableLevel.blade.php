<x-dashboardComponent.admin>
    <x-slot name="header">Table level</x-slot>
    <x-dashboardComponent.table>
        <x-slot name="header">Table level</x-slot>
        <!-- succes validasi -->
        <x-slot name="thead">
            <th>Level</th>
            <th>Required XP</th>
            <th>Action</th>
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
                        <button type="submit" class=""><i class="bi bi-trash3-fill"></i></button>
                    </form>
                </td>
            </tr>
        @endforeach
        
    </x-dashboardComponent.table>
</x-dashboardComponent.admin>