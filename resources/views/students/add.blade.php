<x-app-layout>
    <h2 class="text-xl">
        Inscrever aluno
    </h2>
    <div class="bg-white mt-6 p-6">
        @if (session('success'))
            <div class="bg-green-200 w-full p-4">
                {{ session('success') }}
            </div>
        @endif
        <form action="/students/create" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="flex" style="margin-bottom: 2rem">
                <div class="w-full mr-2">
                    <div class="py-4">
                        <input type="text" name="name" placeholder="Nome completo:"
                            class="rounded border-gray-200 w-full" required>
                    </div>

                    <div class="py-4">
                        <input type="date" name="birthday" class="rounded border-gray-200 w-full" required>
                    </div>

                    <div class="py-4">
                        <input type="text" name="process_number" placeholder="Número de processo:"
                            class="rounded border-gray-200 w-full" required>
                    </div>

                    <div class="py-4">
                        <input type="text" name="address" placeholder="Localização:"
                            class="rounded border-gray-200 w-full" required>
                    </div>

                    <div class="py-4">
                        <select name="gender" id="" class="rounded border-gray-200 w-full">
                            <option value="Masculino">Masculino</option>
                            <option value="Feminino">Feminino</option>
                        </select>
                    </div>

                    <div class="py-4">
                        <select name="grade" class="rounded border-gray-200 w-full">
                            <option value="" disabled>Classe:</option>
                            <option value="7">7ª</option>
                            <option value="8">8ª</option>
                            <option value="9">9ª</option>
                            <option value="10">10ª</option>
                            <option value="11">11ª</option>
                            <option value="12">12ª</option>
                            <option value="13">13ª</option>
                        </select>
                    </div>

                    <div class="py-4">
                        <input type="file" name="image" accept="image/*" class="rounded border-gray-200 w-full"
                            required>
                    </div>
                </div>

                <div class="w-full">
                    <div class="py-4">
                        <input type="email" name="email" placeholder="Email(opcional):"
                            class="rounded border-gray-200 w-full">
                    </div>

                    <div class="py-4">
                        <input type="text" name="number_bi" placeholder="Número do BI:"
                            class="rounded border-gray-200 w-full" required>
                    </div>

                    <div class="py-4">
                        <input type="number" name="number_phone" placeholder="Número de telefone:"
                            class="rounded border-gray-200 w-full" required>
                    </div>

                    <div class="py-4">
                        <input type="text" name="nationality" placeholder="Nacionalidade:"
                            class="rounded border-gray-200 w-full" required>
                    </div>

                    <div class="py-4">
                        <select name="course" class="rounded border-gray-200 w-full">
                            <option value="" disabled>Curso:</option>
                            @foreach ($courses as $course)
                                <option value="{{ $course->name }}">{{ $course->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="py-4">
                        <select name="language_option" class="rounded border-gray-200 w-full">
                            <option value="" disabled>Linguagem de opção:</option>
                            <option value="ingles">Inglês</option>
                            <option value="frances">Francês</option>
                        </select>
                    </div>
                </div>
            </div>

            <button type="submit" class="bg-primary text-white px-6 py-2 rounded" style="background-color: #0062FF">
                Concluir inscrição
            </button>
        </form>
    </div>
</x-app-layout>
