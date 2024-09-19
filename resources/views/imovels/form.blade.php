<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{-- Use 'Edit' for edit mode and create for non-edit/create mode --}}
            {{ isset($imovel) ? 'Edit' : 'Create' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- don't forget to add multipart/form-data so we can accept file in our form --}}
                    <form method="post" action="{{ isset($imovel) ? route('imovels.update', $imovel->id) : route('imovels.store') }}" class="mt-6 space-y-6" enctype="multipart/form-data" class="mt-6 space-y-6">
                        @csrf
                        {{-- add @method('put') for edit mode --}}
                        @isset($imovel)
                            @method('put')
                        @endisset
                
                        <div>
                            <x-input-label for="endereco" value="Endereço" />
                            <x-text-input id="endereco" name="endereco" type="text" class="mt-1 block w-full" value="{{$imovel->endereco ?? old('endereco')}}" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('endereco')" />
                        </div>

                        <div>
                            <x-input-label for="descricao" value="descricao" />
                            {{-- use textarea-input component that we will create after this --}}
                            <x-textarea-input id="descricao" name="descricao" class="mt-1 block w-full" required autofocus>{{ $imovel->descricao ?? old('descricao') }}</x-textarea-input>
                            <x-input-error class="mt-2" :messages="$errors->get('descricao')" />
                        </div>

                        <div>
                            <x-input-label for="proprietario" value="proprietario" />
                            {{-- use textarea-input component that we will create after this --}}
                            <x-textarea-input id="proprietario" name="proprietario" class="mt-1 block w-full" required autofocus>{{ $imovel->proprietario ?? old('proprietario') }}</x-textarea-input>
                            <x-input-error class="mt-2" :messages="$errors->get('proprietario')" />
                        </div>

                        <div>
                            <x-input-label for="foto" value="Featured Image" />
                            <label class="block mt-2">
                                <span class="sr-only">Choose image</span>
                                <input type="file" id="foto" name="foto" class="block w-full text-sm text-slate-500
                                    file:mr-4 file:py-2 file:px-4
                                    file:rounded-full file:border-0
                                    file:text-sm file:font-semibold
                                    file:bg-violet-50 file:text-violet-700
                                    hover:file:bg-violet-100
                                "/>
                            </label>
                            <div class="shrink-0 my-2">
                                <img width="200px" id="foto_preview" class="h-64 w-128 object-cover rounded-md" src="{{ isset($imovel) ? Storage::url($imovel->foto) : '' }}" alt="Featured image preview" />
                            </div>
                            <x-input-error class="mt-2" :messages="$errors->get('foto')" />
                        </div>
                
                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Save') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        // create onchange event listener for foto input
        document.getElementById('foto').onchange = function(evt) {
            const [file] = this.files
            if (file) {
                // if there is an image, create a preview in foto_preview
                document.getElementById('foto_preview').src = URL.createObjectURL(file)
            }
        }
    </script>
</x-app-layout>