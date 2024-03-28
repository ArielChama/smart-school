<x-guest-layout>
    <div class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 "
            style="background-image: url('/images/Banner-image.jpg'); background-size: cover; background-repeat: no-repeat;">
            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                <div class="mb-6 flex justify-center flex-wrap">
                    <div>
                        <img src="/images/logo.png" alt="" style="width: 10rem;">
                    </div>

                    <div class="text-center">
                        <h2 class="uppercase">Instituto Técnico de Hotelaria e Turismo BG 1125 "Laura Vicuna" Benguela</h2>
                    </div>
                </div>

                <!-- Sessão de estado-->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <!-- Validação de erros -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div>
                        <x-label for="email" :value="__('Email')" />

                        <x-input id="email" class="block mt-1 w-full" type="email" name="email"
                            :value="old('email')" required autofocus />
                    </div>

                    <div class="mt-4">
                        <x-label for="password" :value="__('Palavra-passe')" />

                        <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                            autocomplete="current-password" />
                    </div>

                    <div class="mt-4">
                        <button type="submit"
                            class="w-full text-center px-4 py-2 bg-primary border border-transparent rounded-md text-xs text-white uppercase hover:bg-gray-700" style="font-weight: 800; font-size: 14px">
                            Entrar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
