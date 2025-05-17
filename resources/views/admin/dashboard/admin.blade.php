<x-dashboardComponent.admin>
    <x-slot name="header">Admin Dashboard</x-slot>

    {{-- card untuk informasi jumlah --}}
    <div class="flex flex-col gap-6">
        <div class="flex flex-row gap-4">
            <x-dashboardComponent.card-admin>
                <x-slot name="header">Total User</x-slot>
                <x-slot name="icon">
                    <i class="bi bi-person-fill text-3xl text-sec"></i>
                </x-slot>
                <x-slot name="subheader">{{$users->count()}}</x-slot>
                <x-slot name="paragraph">Total pengguna terdaftar</x-slot>
            </x-dashboarComponent.card-admin>
            <x-dashboardComponent.card-admin>
                <x-slot name="header">Total Buku</x-slot>
                <x-slot name="icon">
                    <i class="bi bi-book-fill text-3xl text-sec"></i>
                </x-slot>

                <x-slot name="subheader">{{$users -> count()}}</x-slot>
                <x-slot name="paragraph">Koleksi</x-slot>
            </x-dashboardComponent.card-admin>
        </div>

        {{-- table berisi data data user --}}
        <x-dashboardComponent.table>
            <x-slot name="thead">
                <th class="px-6 py-3 text-left text-[14px] font-semibold uppercase w-1/5">Username</th>
                <th class="px-6 py-3 text-left text-[14px] font-semibold uppercase w-1/5">Email</th>
                <th class="px-6 py-3 text-left text-[14px] font-semibold uppercase w-1/5">Level</th>
                <th class="px-6 py-3 text-left text-[14px] font-semibold uppercase w-1/5">Total Exp</th>
                <th class="px-6 py-3 text-left text-[14px] font-semibold uppercase w-1/5">Bergabung pada</th>
            </x-slot>

            @foreach ($users as $user)
            <tr class="{{ $loop->even ? 'bg-amber-50':'' }}">
                <td class="px-6 py-3 text-left w-1/5">{{$user->username}}</td>
                <td class="px-6 py-3 text-left w-1/5">{{$user->email}}</td>
                <td class="px-6 py-3 text-left w-1/5">{{$user->level}}</td>
                <td class="px-6 py-3 text-left w-1/5">{{$user->xp}} EXP</td>
                <td class="px-6 py-3 text-left w-1/5">{{$user->created_at}}</td>
            </tr>
        @endforeach
        </x-dashboardComponent.table>
    </div>

    {{-- tabel berisi data data buku --}}



</x-dashboardComponent.admin>
