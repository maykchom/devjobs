<div class="p-10">
    <div class="mb-5">
        <h3 class="font-bold text-3xl text-gray-800 my-3">
            {{$vacante->titulo}}
        </h3>
        <div class="md:grid md:grid-cols-2 bg-gray-50 p-5 my-1">
            <p class="font-bold text-sm text-gray-800 my-3 ">Empresa: <span class="normal-case font-normal">{{$vacante->empresa}}</span></p>
            <p class="font-bold text-sm text-gray-800 my-3 ">Último día para postularse: <span class="normal-case font-normal">{{$vacante->ultimo_dia->toFormattedDateString()}}</span></p>
            {{-- Para obetener el nombre de la categoria y no el ID se debe tener una relacion en el modelo y acá poner el nombre del modelo, seguido del nombre de la funcion que hace la relacion con la otra tabla, seguido del nombre del campo --}}
            <p class="font-bold text-sm text-gray-800 my-3 ">Categoría: <span class="normal-case font-normal">{{$vacante->categoria->categoria}}</span></p>
            <p class="font-bold text-sm text-gray-800 my-3 ">Salario: <span class="normal-case font-normal">{{$vacante->salario->salario}}</span></p>
        </div>
    </div>
    <div class="md:grid md:grid-cols-6 gap-10">
        <div class="md:col-span-2">
            <img src="{{asset('storage/vacantes/'.$vacante->imagen)}}" alt="{{'Imagen vacante '.$vacante->titulo}}">
        </div>

        <div class="md:col-span-4">
            <h2 class="text-2xl font-bold mb-5">Descripción del puesto</h2>
            <p>{{$vacante->descripcion}}</p>
        </div>
    </div>
    @guest
        <div class="mt-5 bg-gray-50 border border-dashed p-5 text-center">
            <p>¿Deseas aplicar a esta vacanate? <a class="font-bold text-indigo-600" href="{{route('register')}}">Obtenen una cuenta y aplica a esta y otras vacantes</a></p>
        </div>        
    @endguest

    {{-- Se verifica con base a un policy de rol, en este caso a VacantePolicy.php --}}
    {{-- @can('viewAny', App\Models\Vacante::class) --}}
    {{-- Acá se ejecuta si se cumple la policy (Solo Reclutadores)--}}
        {{-- <p>Este es un reclutador</p> --}}
    {{-- @else --}}
    {{-- Acá se ejecuta si no se cumple la policy (Solo Devs)--}}
        {{-- <p>Estes es un Dev</p> --}}
    {{-- @endcan --}}
    
    {{-- Se muestra a quienes no cumplen el rol según la policy (VacantePolicy.php) --}}
    @cannot('viewAny', App\Models\Vacante::class)
        <livewire:postular-vacante :vacante="$vacante"/>    
    @endcannot


</div>
