<x-app-layout>
    <h2 class="text-xl">
        Configurações de conta
    </h2>
    @if (session('success'))
        <div class="bg-green-200 w-full p-4">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="bg-red-400 w-full p-4">
            {{ session('error') }}
        </div>
    @endif
    <div class="bg-white mt-6 p-6">
        <form action="{{ route('settings.change.password') }}" method="post">
            @csrf
            @method('PUT')
            <p class=" text-gray-500">
                Confirme a sua palavra-passe antiga para puder actualiza-la.
            </p>
            <div class="flex" style="margin-bottom: 1rem">
                <div class="py-4 w-full mr-2">
                    <input type="password" name="password_old" placeholder="Palavra-passe atual:"
                        class="rounded border-gray-200 w-full" required>
                </div>

                <div class="py-4 w-full">
                    <input type="password" name="password_new" placeholder="Palavra-passe nova:" class="rounded border-gray-200 w-full" required>
                </div>
            </div>

            <button type="submit" class="bg-primary text-white px-6 py-2 rounded" style="background-color: #0062FF">
                Mudar senha
            </button>
        </form>
    </div>
</x-app-layout>
