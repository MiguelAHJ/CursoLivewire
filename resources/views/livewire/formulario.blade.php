<div>

    <div class="bg-white shadow rounded-lg p-6 mb-8">


        @if ($postCreate->image)
            <div class="w-full flex justify-center">
                <img class="rounded-full w-32 h-32 object-cover" src="{{$postCreate->image->temporaryUrl()}}" alt="">
            </div>
        @endif

        <form wire:submit="save">
            <div class="mb-4">
                <x-label>
                    Título
                </x-label>
                <x-input class="w-full" wire:model.live="postCreate.title"/>
                <x-input-error for="postCreate.title"/>
            </div>
            <div class="mb-4">
                <x-label>
                    Contenido
                </x-label>
                <x-textarea class="w-full" wire:model="postCreate.content"></x-textarea>
                <x-input-error for="postCreate.content"/>
            </div>
            <div class="mb-4">

                <x-label>
                    Categoria
                </x-label>
                <x-select class="w-full" wire:model="postCreate.category_id">
                    <option value="">
                        Seleccione una categoría
                    </option>
                    @foreach ($categories as $category)
                        <option value="{{$category->id}}">
                            {{$category->name}}
                        </option>
                    @endforeach
                </x-select>
                <x-input-error for="postCreate.category_id"/>
            </div>

            <div class="mb-4">
        
                <x-label>
                    Imagen
                </x-label>
                <div
                    x-data="{ isUploading: false, progress: 0 }"
                    x-on:livewire-upload-start="isUploading = true"
                    x-on:livewire-upload-finish="isUploading = false"
                    x-on:livewire-upload-error="isUploading = false"
                    x-on:livewire-upload-progress="progress = $event.detail.progress"
                >
                    <input type="file" wire:model.live="postCreate.image" wire:key="{{$postCreate->imageKey}}"/>
                    
                    <div class="flex justify-center items-center mt-2" x-show="isUploading">
                        <!-- Barra de progreso personalizada -->
                        <div class="bg-blue-300 border border-gray-300 rounded-sm h-5 w-full relative">
                            <div class="bg-blue-500 rounded-sm h-full text-xs font-bold text-white" 
                                 x-bind:style="'width: ' + progress + '%'" 
                                 x-bind:class="{'transition-all': isUploading}">
                            </div>
                            <div class="absolute top-0 left-0 w-full h-full flex justify-center items-center text-white text-sm font-bold">
                                <span x-text="progress + '%'">dsadaasd</span> <!-- Usar x-text para mostrar el porcentaje -->
                            </div>
                        </div>
                        
                        
                        <!-- Texto de progreso -->
                        {{-- <span class="ml-2 text-sm text-gray-600" x-bind:style="'width: ' + progress + '%'"></span> --}}
                    </div>
                </div>
                <x-input-error for="postCreate.image"/>
            </div>

            <div class="mb-4">
                <x-label>
                    Etiquetas
                </x-label>
                <ul>
                    @foreach ($tags as $tag)
                        <li>
                            <label>
                                <x-checkbox wire:model="postCreate.tags" value="{{$tag->id}}" />
                                {{$tag->name}}
                            </label>
                        </li>
                    @endforeach
                </ul>
                <x-input-error for="postCreate.tags"/>
            </div>
            <div class="flex justify-end">
                <x-button wire:loading.attr="disabled" wire:loading.class="opacity-25">
                    Crear
                </x-button>
            </div>
        </form>
        <div wire:loading wire:target="save">
            <p>Procesando ...</p>
        </div>
    </div>

    <div class="bg-white shadow rounded-lg p-6" >
        <div class="mb-4">
            <x-input class="w-full" placeholder="Buscar ..." wire:model.live="search"/>
        </div>
        <ul class="list-disc list-inside space-y-2" >
            @foreach ($posts as $post)
                <li class="flex justify-between" wire:key="post-{{$post->id}}" >
                    {{$post->title}}
                    <div >
                        <x-button wire:click="edit({{$post->id}})">Editar</x-button>
                        <x-danger-button wire:click="destroy({{$post->id}})">Eliminar</x-danger-button>
                    </div>
                </li>
            @endforeach
        </ul>
        <div class="mt-4">
            {{$posts->links(data: ['scrollTo' => false])}}
        </div>
    </div>
    {{-- Formulario de edición --}}
    <form wire:submit="update">
        <x-dialog-modal wire:model="postEdit.open">
            <x-slot name="title">
                Actualizar post
            </x-slot>
            <x-slot name="content">
                    <div class="mb-4">
                        <x-label>
                            Título
                        </x-label>
                        <x-input class="w-full" wire:model="postEdit.title"/>
                    </div>
                    <div class="mb-4">
                        <x-label>
                            Contenido
                        </x-label>
                        <x-textarea class="w-full" wire:model="postEdit.content"></x-textarea>
                    </div>
                    <div class="mb-4">
        
                        <x-label>
                            Categoria
                        </x-label>
                        <x-select class="w-full" wire:model="postEdit.category_id">
                            <option value="">
                                Seleccione una categoría
                            </option>
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}">
                                    {{$category->name}}
                                </option>
                            @endforeach
                        </x-select>
        
                    </div>     
                    <div class="mb-4">
                        <x-label>
                            Etiquetas
                        </x-label>
                        <ul>
                            @foreach ($tags as $tag)
                                <li>
                                    <label>
                                        <x-checkbox wire:model="postEdit.tags" value="{{$tag->id}}" />
                                        {{$tag->name}}
                                    </label>
                                </li>
                            @endforeach
                        </ul>
                    </div>
            </x-slot>
            <x-slot name="footer">
                <div class="flex justify-end">
                    <x-danger-button class="mr-2" wire:click="$set('postEdit.open', false)">
                        Cancelar
                    </x-danger-button>
                    <x-button>
                        Actualizar
                    </x-button>
                </div>
            </x-slot>
        </x-dialog-modal>
    </form>
</div>
