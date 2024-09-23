<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Notificaciones') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl font-bold text-center my-10">Mis notificaciones</h1>
                    @forelse ($notificaciones as $notificacion)
                        <div class="p-5 border border-gray-200 lg:flex lg:justify-between lg:items-center">
                            <div class="">
                                <p class="font-bold">Tienes un nuevo candidato en: <span>{{$notificacion->data['nombre_vacante']}}</span></p>
                                <p class="text-sm text-gray-400"><span>{{$notificacion->created_at->diffForHumans()}}</span></p>
                            </div>
                            <div class="mt-5 lg:mt-0">
                                <a href="{{route('candidatos.index', $notificacion->data['id_vacante'])}}" class="bg-indigo-500 p-3 text-sm font-bold text-white rounded-lg">ver candidatos</a>
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-gray-600">No hay notificaciones nuevas</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>