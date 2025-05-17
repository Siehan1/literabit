<x-layout.admin>
    <x-slot name="header">Admin Dashboard</x-slot>
    <x-layout.card-admin>
        <x-slot name="header">Total User</x-slot>
        <x-slot name="subheader">{{$users -> count()}}</x-slot>
        <x-slot name="paragraph">Terdaftar</x-slot>
    </x-layout.card-admin>
    <x-layout.table :users="$users"></x-layout.table>

</x-layout.admin>
