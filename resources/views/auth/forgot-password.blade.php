<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('¿Olvidaste tu contraseña? Ingresa tu email de registro y enviaremos un enlace para que puedas cambiar el anterior') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        <div class="flex justify-between my-5">
            <x-link :href="route('login')">
                Iniciar sesión
            </x-link>
            
            <x-link :href="route('register')">
                {{-- El textp "Olvidaste tu contraseña lo recibe el componente con una variable llamada $slot automáticamente" --}}
                Crear cuenta
            </x-link>
        </div>

        <x-primary-button class="w-full justify-center mb-2">
            {{ __('Enviar correo para reestablecer') }}
        </x-primary-button>
    </form>
</x-guest-layout>
