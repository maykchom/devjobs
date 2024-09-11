@php
    $classes = "text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
@endphp

{{-- El href viene como atributo desde login.blade.php ":href="route('register')" y se aplica automáticamente--}}
{{-- Solo hay que decirle que las clases estan en la variable "$classes" y unirlos al elemento con "merge(['class'=>$classes])"--}}
<a {{$attributes->merge(['class'=>$classes])}}>
    {{ $slot }}
</a>