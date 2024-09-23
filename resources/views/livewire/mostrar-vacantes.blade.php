<div class="">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        @forelse( $vacantes as $vacante)
            <div class="p-6 text-gray-900 border-b md:flex md:justify-between md:items-center">
                <div class="space-y-3">
                    <a href="{{route('vacantes.show', $vacante->id)}}" class="text-xl font-bold">
                        {{$vacante->titulo}}
                    </a>
                    <p class="text-sm font-bold text-gray-600">{{$vacante->empresa}}</p>
                    {{-- Para poder usar format(), debe haberse casteado en el modelo de Vacante que "ultimo_dia" es fecha "datetime" --}}
                    <p class="text-sm text-gray-500">Último día: {{$vacante->ultimo_dia->format('d/m/Y')}}</p>
                </div>
                <div class="flex flex-col md:flex-row items-stretch gap-3  mt-5 md:mt-0">
                    <a href="{{route('candidatos.index', $vacante)}}" class="bg-slate-800 py-2 px-4 rounded-lg text-white text-xs font-bold uppercase text-center">{{$vacante->candidatos->count()}} Candidatos</a>
                    <a href="{{route('vacantes.edit', $vacante->id)}}" class="bg-blue-800 py-2 px-4 rounded-lg text-white text-xs font-bold uppercase text-center">Editar</a>
                    {{-- EL evento click llamdado 'prueba' puede ser lanzado desde MostrarVacantes.php, o desde un archivo .js --}}
                    {{-- PARA LLAMARLO DESDE MostrarVacantes.php O desde algun script js --}}          
                    {{-- El parámetro 'vacanteId' es muy importante y no se debe de cambiar de nombre en donde se pase o se envíe como parámetro --}}
                    <button wire:click="$dispatch('mostrarAlerta',{vacanteId: {{$vacante->id}}})" class="bg-red-600 py-2 px-4 rounded-lg text-white text-xs font-bold uppercase text-center">Eliminar</button>                                        
                    {{-- <button wire:click="$dispatch('mostrarAlerta',{id: '{{$vacante->titulo}}'})" class="bg-red-600 py-2 px-4 rounded-lg text-white text-xs font-bold uppercase text-center">Eliminar</button>                                         --}}
                    {{-- <button wire:click="$dispatch('mostrarAlerta', {{$vacante->id}})" class="bg-red-600 py-2 px-4 rounded-lg text-white text-xs font-bold uppercase text-center">Eliminar</button>                                         --}}
                </div>
    
            </div> 
        @empty
        <p class="p-3 text-center text-sm text-gray-600">No hay vacantes que mostrar</p>       
        @endforelse
    </div>
    
    <div class="mt-10">
        {{$vacantes->links()}}
    </div>

</div>

@push('scripts')
    {{-- Importamos el script de sweetalert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>

        // Evento que se dispara al darle click al botton "Eliminar", al mismo tiempo recibe un parámetro "$id"
        // El parámetro debe tener el mismo nombre del valor que se está enviando acá
        Livewire.on('mostrarAlerta',({vacanteId})=>{
            // alert(vacanteId);
            Swal.fire({
                title: "¿Eliminar vacante?",
                text: "Una vacante eliminada no se puede recuperar",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Eliminar",
                cancelButtonText: 'Cancelar'
            }).then((result) => {
            if (result.isConfirmed) {
                // Eliminar la vacante en el servidor
                //Forma 1 (NO NECESITA #[On('eliminarVacante')] en su funcion en la clase MostrarVacantes.php)
                // @this.call('eliminarVacante', ({id}))
                //Forma 2 (NECESITA #[On('eliminarVacante')] en su funcion en la clase MostrarVacantes.php)
                // Livewire.dispatch('eliminarVacante', ({id}));
                Livewire.dispatch('eliminarVacante', ({vacanteId}));

                Swal.fire({
                    title: "Se eliminó la vacante",
                    text: "Eliminado correctamente",
                    icon: "success"
                });
            }
            });
        })

    </script>
@endpush