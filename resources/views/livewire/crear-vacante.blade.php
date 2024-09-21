
{{-- 
Es necesario colocar "wire:submit.prevent='crearVacante" para poder validar el fomrulario
Se debe crear una funcion en la clase del componente de livewire (CrearVacante.php) 
del mismo nombre que se declaró en wire:submit.prevent='crearVacante'
--}}
<form class="md:w-1/2 space-y-5" action="" wire:submit.prevent='crearVacante'>
    <div>
        <x-input-label for="titulo" :value="__('Título vacante')" />
        <x-text-input id="titulo" class="block mt-1 w-full" type="text" wire:model="titulo" :value="old('titulo')" placeholder="Ingresa un título" />
        @error('titulo')
            <livewire:mostrar-alerta :message="$message"/>
        @enderror
    </div>
    <div>
        <x-input-label for="salario" :value="__('Salario mensual')" />
        <select wire:model="salario" id="salario" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full">
            <option value="">-- Seleccione --</option>
            @foreach ($salarios as $salario)
                <option value="{{$salario->id}}">{{$salario->salario}}</option>
            @endforeach
        </select>
        @error('salario')
            <livewire:mostrar-alerta :message="$message"/>
        @enderror
    </div>
    <div>
        <x-input-label for="categoria" :value="__('Categoría')" />
        <select wire:model="categoria" id="categoria" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full">
            <option value="">-- Selecciona una categoria --</option>
            @foreach ($categorias as $categoria)
                <option value="{{$categoria->id}}">{{$categoria->categoria}}</option>
            @endforeach
        </select>
        @error('categoria')
        <livewire:mostrar-alerta :message="$message"/>
        @enderror
    </div>
    <div>
        <x-input-label for="empresa" :value="__('Empresa')" />
        <x-text-input id="empresa" class="block mt-1 w-full" type="text" wire:model="empresa" :value="old('empresa')" placeholder="Ingresa una empresa" />
        @error('empresa')
        <livewire:mostrar-alerta :message="$message"/>
        @enderror
    </div>
    <div>
        <x-input-label for="ultimo_dia" :value="__('Último día para postularse')" />
        <x-text-input id="ultimo_dia" class="block mt-1 w-full" type="date" wire:model="ultimo_dia" :value="old('ultimo_dia')"/>
        @error('ultimo_dia')
        <livewire:mostrar-alerta :message="$message"/>
        @enderror
        
    </div>
    <div>
        <x-input-label for="imagen" :value="__('Imagen')" />
        <x-text-input id="imagen" class="block mt-1 w-full" type="file" wire:model="imagen" accept="image/*"/>
        
        {{-- Previsualizar imagen seleccionada --}}
        <div class="my-5 w-80">
            @if ($imagen)
                Imagen:
                <img src="{{$imagen->temporaryUrl()}}" alt="">
            @endif
        </div>
        @error('imagen')
        <livewire:mostrar-alerta :message="$message"/>
        @enderror        
    </div>
    <div>
        <x-input-label for="descripcion" :value="__('Descripción del puesto')" />
        <textarea wire:model="descripcion" id="descripcion" placeholder="Descripción general del puesto" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full h-72"></textarea>
        @error('descripcion')
        <livewire:mostrar-alerta :message="$message"/>
        @enderror 
    </div>
    <x-primary-button>
        Crear vacante
    </x-primary-button>
</form>