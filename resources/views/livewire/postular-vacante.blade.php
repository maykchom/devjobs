<div class="bg-gray-100 p-5 mt-10 flex flex-col justify-center items-center">
    <h3 class="text-center text-2xl font-bold my-4">Postularme a esta vacante</h3>
    @if (session()->has('mensaje'))
        <div class="border border-green-600 bg-green-100 text-green-600 font-bold p-2 my-5 text-sm">
            {{session('mensaje')}}
        </div>
    @else
        @can('yaPostulado', $vacante)
        <div class="border border-green-600 bg-green-100 text-green-600 font-bold p-2 my-5 text-sm">
            Ya postulaste a esta vacante anteriormente
        </div>
        @else
            <form action="" wire:submit.prevenr='postularme' class="w-96 mt-5">
                <div class="mb-4">
                    <x-input-label for="cv" :value="__('Currículum o Hoja de vida (PDF)')"/>
                    <x-text-input id="cv" type="file" wire:model="cv" accept=".pdf" class="block mt-1 w-full"/>
                    @error('cv')
                    <livewire:mostrar-alerta :message="$message"/>
                    @enderror
                </div>

                <div wire:loading wire:target="cv">
                    <!-- Mostrar un spinner o mensaje de carga cuando se está subiendo el archivo -->
                    <p>Subiendo archivo...</p>
                </div>

                <x-primary-button class="my-5" wire:loading.attr="disabled" wire:target="cv">
                    {{__('Postularme')}}
                </x-primary-button>
                {{-- <button class="bg-blue-500 text-white" type="submit" wire:loading.attr="disabled" wire:target="cv">
                    Enviar
                </button> --}}
            </form>        
        @endcan
    @endif
</div>
