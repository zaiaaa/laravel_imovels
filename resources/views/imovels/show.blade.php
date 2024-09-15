<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ 'Show' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ 'Endereço' }}
                        </h2>
                
                        <p class="mt-1 text-sm text-gray-600">
                            {{ $imovel->endereco }}
                        </p>
                    </div>
                    <div class="mb-6">
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ 'Descrição' }}
                        </h2>
                
                        <p class="mt-1 text-sm text-gray-600">
                            {{ $imovel->descricao }}
                        </p>
                    </div>
                    <div class="mb-6">
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ 'Foto' }}
                        </h2>
                
                        <p class="mt-1 text-sm text-gray-600">
                            <img class="h-64 w-128" src="{{ Storage::url($imovel->foto) }}" alt="{{ $imovel->endereco }}" srcset="">
                        </p>
                    </div>
                    <div class="mb-6">
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ 'Proprietário' }}
                        </h2>
                
                        <p class="mt-1 text-sm text-gray-600">
                            {{ $imovel->proprietario }}
                        </p>
                    </div>
                    <div class="mb-6">
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ 'Cadastrado em' }}
                        </h2>
                
                        <p class="mt-1 text-sm text-gray-600">
                            {{ $imovel->created_at }}
                        </p>
                    </div>
                    <a href="{{ route('imovels.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md">BACK</a>
                    <form action="{{ route('imovels.destroy', $imovel->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este imóvel?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md">EXCLUIR</button>
                    </form>                

                </div>
            </div>
        </div>
    </div>
</x-app-layout>