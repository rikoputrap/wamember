<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('List Member') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                <x-nav-link :href="route('member.create')" :active="request()->routeIs('member.create')" >Tambah Member</x-nav-link>
                </div>
                <div class="p-6 bg-white border-b border-gray-200">
                
                <table class="border-separate border border-gray-400">
                    <tr>
                        <th class="border border-gray-400">Nama</th>
                        <th class="border border-gray-400">Telepon</th>
                        <th class="border border-gray-400">Alamat</th>
                        <th colspan="2" class="border border-gray-400">Opsi</th>
                    </tr>
                    @foreach($member as $m)
                    <tr>
                        <td class="border border-gray-400">{{ $m->name }}</td>
                        <td class="border border-gray-400">{{ $m->phone }}</td>
                        <td class="border border-gray-400">{{ $m->address }}</td>
                        <td class="border border-gray-400">
                            <x-nav-link :href="route('member.edit', $m->id)" :active="request()->routeIs('member.edit', $m->id)" >Edit</x-nav-link>
                        </td>
                        <td class="border border-gray-400">
                            <form action="{{ route('member.destroy', $m->id) }}" method="post">
                            <x-nav-link action="route('member.destroy', $m->id)" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Hapus</button>
                            </x-nav-link>
                        </td>
                    </tr>
                    @endforeach
                </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>