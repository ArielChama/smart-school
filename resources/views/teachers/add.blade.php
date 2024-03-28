<x-app-layout>
    <h2 class="text-xl">
        Adicionar professor
    </h2>
    <div class="bg-white mt-6 p-6">
        @if (session('success'))
            <div class="bg-green-200 w-full p-4">
                {{ session('success') }}
            </div>
        @endif
        <form action="/teachers/create" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="flex" style="margin-bottom: 2rem">
                <div class="w-full mr-2">
                    <div class="py-4">
                        <input type="text" name="name" placeholder="Nome completo:"
                            class="rounded border-gray-200 w-full">
                    </div>

                    <div class="py-4">
                        <input type="password" name="password" placeholder="Senha:"
                            class="rounded border-gray-200 w-full">
                    </div>

                    <div class="py-4">
                        <input type="text" name="nationality" placeholder="Nacionalidade:"
                            class="rounded border-gray-200 w-full">
                    </div>

                    <div class="py-4">
                        <input type="text" name="address" placeholder="Localização"
                            class="rounded border-gray-200 w-full">
                    </div>
                </div>

                <div class="w-full">
                    <div class="py-4">
                        <input type="email" name="email" placeholder="Email:"
                            class="rounded border-gray-200 w-full">
                    </div>

                    <div class="py-4">
                        <input type="text" name="number_phone" placeholder="Número de telefone:"
                            class="rounded border-gray-200 w-full">
                    </div>

                    <div class="py-4">
                        <select name="gender" id="" class="rounded border-gray-200 w-full">
                            <option value="Masculino">Masculino</option>
                            <option value="Feminino">Feminino</option>
                        </select>
                    </div>

                    <div class="py-4">
                        <input type="file" name="image" accept="image/*"
                            class="rounded border border-gray-200 w-full">
                    </div>
                </div>
            </div>

            <button type="submit" class="bg-primary text-white px-6 py-2 rounded" style="background-color: #0062FF">
                Adicionar novo professor
            </button>
        </form>
    </div>
</x-app-layout>
