<x-guest-layout>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #121212;
            color: #e0e0e0;
        }
        .auth-container {
            min-height: 100vh;
            background: linear-gradient(135deg, #a855f7 0%, #ec4899 100%);
        }
        .form-container {
            background-color: #1e1e1e;
            border-radius: 1rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
        }
        .input-field {
            background-color: #2d2d2d;
            border: 1px solid #3d3d3d;
            color: #e0e0e0;
            transition: all 0.3s ease;
        }
        .input-field:focus {
            border-color: #d946ef;
            box-shadow: 0 0 0 3px rgba(217, 70, 239, 0.3);
        }
        .btn-primary {
            background: linear-gradient(135deg, #a855f7 0%, #ec4899 100%);
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(217, 70, 239, 0.5);
            background: linear-gradient(135deg, #bf7af0 0%, #f472b6 100%);
        }
        .logo-text {
            background: linear-gradient(135deg, #a855f7 0%, #ec4899 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .link-text {
            color: #d946ef;
        }
        .link-text:hover {
            color: #f0abfc;
        }
        .checkbox-purple {
            accent-color: #d946ef;
        }
    </style>
     <div class=" flex items-center justify-center ">
        <div class="form-container w-full max-w-md p-8">
            <div class="text-center mb-8">
                <div class="text-3xl font-bold logo-text inline-block">Eventify</div>
                <p class="text-gray-400 mt-2">Organiza y descubre eventos increíbles</p>
            </div>

            <h2 class="text-2xl font-bold text-white mb-6 text-center">Registro</h2>
    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" class="text-gray-300 mb-1"/>
            <x-text-input id="name" class="input-field w-full px-4 py-3 rounded-lg" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-sm text-pink-400" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" class="text-gray-300 mb-1"/>
            <x-text-input id="email" class="input-field w-full px-4 py-3 rounded-lg" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-pink-400" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" class="text-gray-300 mb-1"/>

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" class="input-field w-full px-4 py-3 rounded-lg"/>

            <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-pink-400" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-gray-300 mb-1"/>

            <x-text-input id="password_confirmation" class="input-field w-full px-4 py-3 rounded-lg"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-sm text-pink-400" />
        </div>

       
        <button type="submit" class="btn-primary w-full py-3 px-4 rounded-lg text-white font-medium">
            Registrarse
        </button>
        <p class="text-center text-sm text-gray-400 mt-4">
                ¿Ya tienes una cuenta?
                <a href="{{ route('login') }}" class="font-medium link-text">Inicia Sesión</a>
        </p>
        
    </form>
    </div>
    </div>
</x-guest-layout>
