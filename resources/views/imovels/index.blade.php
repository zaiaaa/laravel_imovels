<?php
    function formataData(String $data) {
        $dateTime = new DateTime($data);
        return $dateTime->format('Y/m/d H:i:s');
    }
?>

{{-- use AppLayout Component located in app\View\Components\AppLayout.php which use resources\views\layouts\app.blade.php view --}}
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ 'Imovels' }}
            </h2>
            <!-- erro na cor do botao -->
            <a href="{{ route('imovels.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md">NOVO IMÓVEL</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="border-collapse table-auto w-full text-sm">
                        <thead>
                            <tr>
                                <th class="border-b font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 text-left">Endereço</th>
                                <th class="border-b font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 text-left">Descrição</th>
                                <th class="border-b font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 text-left">Proprietário</th>
                                <th class="border-b font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 text-left">Foto</th>
                                <th class="border-b font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 text-left">Created At</th>
                                <th class="border-b font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 text-left">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            {{-- populate our imovel data --}}
                            @foreach ($imovels as $imovel)
                                <tr>
                                    <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">{{ $imovel->endereco }}</td>
                                    <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">{{ $imovel->descricao }}</td>
                                    <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">{{ $imovel->proprietario }}</td>
                                    <!-- LEMBRAR DE USAR O COMANDO "php artisan storage:link" -->
                                    <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400"> <img width="100px" src="storage/{{ $imovel->foto }}" alt="" srcset=""> </td>
                                    <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">{{ formataData($imovel->created_at) }}</td>
                                    
                                    <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">
                                        <div class="flex flex-col gap-y-2">
                                            <a href="{{ route('imovels.show', $imovel->id) }}" class="border border-blue-500 hover:bg-blue-500 hover:text-white px-4 py-2 rounded-md block">VER</a>
                                            <a href="{{ route('imovels.edit', $imovel->id) }}" class="border border-yellow-500 hover:bg-yellow-500 hover:text-white px-4 py-2 rounded-md block">EDITAR</a>

                                            {{-- add delete button using form tag --}}
                                            <form method="post" action="{{ route('imovels.destroy', $imovel->id) }}" class="inline">
                                                @csrf
                                                @method('delete')
                                                <button class="border border-red-500 hover:bg-red-500 hover:text-white px-4 py-2 rounded-md block">DELETAR</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>