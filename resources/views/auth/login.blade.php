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

            <h2 class="text-2xl font-bold text-white mb-6 text-center">Iniciar Sesión</h2>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4 text-sm text-green-500 text-center" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" class="text-gray-300 mb-1" />
                    <x-text-input id="email" class="input-field w-full px-4 py-3 rounded-lg"
                                  type="email" name="email" :value="old('email')" required autofocus />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-pink-400" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Password')" class="text-gray-300 mb-1" />
                    <x-text-input id="password" class="input-field w-full px-4 py-3 rounded-lg"
                                  type="password" name="password" required />
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-pink-400" />
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input type="checkbox" id="remember_me" name="remember" class="h-4 w-4 checkbox-purple rounded">
                        <label for="remember_me" class="ml-2 text-sm text-gray-300">Recordarme</label>
                    </div>
                    @if (Route::has('password.request'))
                        <a class="text-sm font-medium link-text" href="{{ route('password.request') }}">
                            ¿Olvidaste tu contraseña?
                        </a>
                    @endif
                </div>

                <button type="submit" class="btn-primary w-full py-3 px-4 rounded-lg text-white font-medium">
                    Iniciar Sesión
                </button>

                <p class="text-center text-sm text-gray-400 mt-4">
                    ¿No tienes una cuenta?
                    <a href="{{ route('register') }}" class="font-medium link-text">Regístrate</a>
                </p>
            </form>
        </div>
    </div>
</x-guest-layout>
