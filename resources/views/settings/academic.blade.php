<x-app-layout>
    <div>
        <h2 class="text-xl">
            Configurações academicas
        </h2>
    </div>
    @if (session('success'))
        <div class="bg-green-200 w-full p-4">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="bg-red-400 w-full p-4 text-white">
            {{ session('error') }}
        </div>
    @endif
    <div class="flex flex-wrap mt-6">
        <div class="bg-white p-5 w-72 mr-3 mb-4">
            <h3 class="text-lg uppercase font-medium mb-4">Crie um ano lectivo</h3>
            <p class="text-gray-700">
                Criar sessão de um ano lectivo.
            </p>

            <form action="/settings/schoolYear_create" method="POST">
                @csrf
                <div class="mt-4">
                    <label for="">Inicio:</label>
                    <input type="date" name="initial" class="rounded border-gray-200 w-full mt-1">
                </div>

                <div class="my-4">
                    <label for="">Final:</label>
                    <input type="date" name="final" class="rounded border-gray-200 w-full mt-1">
                </div>
                <button type="submit" class="text-blue-800 border-blue-600 border-2 px-4 py-1 rounded">
                    Criar
                </button>
            </form>
        </div>

        <div class="bg-white p-5 w-72 mr-3 mb-4">
            <h3 class="text-lg uppercase font-medium mb-4">Selecione um ano lectivo</h3>
            <p class="text-gray-700">
                Selecione qualquer ano lectivo para ver as turmas deste ano
            </p>

            <form action="{{ route('settings.schoolYear.select') }}" method="GET">
                @csrf
                <div class="my-4">
                    <select name="schoolYear" class="rounded border-gray-200 w-full mt-1 mb-4">
                        @foreach ($years as $year)
                            <option value="{{ $year->id }}">{{ $year->initial }} / {{ $year->final }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="text-blue-800 border-blue-600 border-2 px-4 py-1 rounded">
                    Selecionar
                </button>
            </form>
        </div>

        @if (session('yearCurrent'))
            <div class="bg-white p-5 w-72 mr-3 mb-4">
                <h3 class="text-lg uppercase font-medium mb-4">Criar uma turma</h3>
                <p class="text-gray-700">
                    Crie uma turma ao sistema.
                </p>

                <form action="/settings/classe_create" method="POST">
                    @csrf
                    <input type="text" placeholder="Letra da turma:" name="letter"
                        class="rounded border-gray-200 w-full my-4">

                    <select name="shift" class="rounded border-gray-200 w-full mt-1 mb-4">
                        <option value="" disabled>Turno:</option>
                        <option value="Manhã">Manhã</option>
                        <option value="Tarde">Tarde</option>
                    </select>

                    <select name="grade" class="rounded border-gray-200 w-full mt-1 mb-4">
                        <option value="" disabled>Classe:</option>
                        <option value="10">10ª</option>
                        <option value="11">11ª</option>
                        <option value="12">12ª</option>
                        <option value="12">13ª</option>
                    </select>

                    <select name="course" class="rounded border-gray-200 w-full mt-1 mb-4">
                        <option value="" disabled>Curso:</option>
                        @foreach ($courses as $course)
                            <option value="{{ $course->name }}">{{ $course->name }}</option>
                        @endforeach
                    </select>

                    <button type="submit" class="text-blue-800 border-blue-600 border-2 px-4 py-1 rounded">
                        Criar
                    </button>
                </form>
            </div>
        @endif


        <div class="bg-white p-5 w-72 mr-3 mb-4">
            <h3 class="text-lg uppercase font-medium mb-4">Adicionar curso</h3>
            <p class="text-gray-700">
                Adicione um curso ao sistema.
            </p>

            <form action="/settings/course_create" method="POST">
                @csrf
                <input type="text" placeholder="Nome:" name="name" class="rounded border-gray-200 w-full my-4">
                <button type="submit" class="text-blue-800 border-blue-600 border-2 px-4 py-1 rounded">
                    Adicionar
                </button>
            </form>
        </div>

        <div class="bg-white p-5 w-72 mr-3 mb-4">
            <h3 class="text-lg uppercase font-medium mb-4">Adicionar disciplina</h3>
            <p class="text-gray-700">
                Adicione uma disciplina para um curso ou uma disciplina geral ao sistema.
            </p>

            <form action="/settings/lesson_create" method="POST">
                @csrf
                <input type="text" placeholder="Nome:" name="name" class="rounded border-gray-200 w-full my-4">
                <select name="course" class="rounded border-gray-200 w-full mt-1 mb-4">
                    <option disabled>Escolha um curso:</option>
                    <option value="NA">N/A</option>
                    @foreach ($courses as $course)
                        <option value="{{ $course->name }}">{{ $course->name }}</option>
                    @endforeach
                </select>
                <div class="py-4 flex justify-between">
                    <label for="G10">
                        <input type="checkbox" name="grade[]" id="G10" value="10">
                        10ª
                    </label>

                    <label for="G11">
                        <input type="checkbox" name="grade[]" id="G11" value="11">
                        11ª
                    </label>

                    <label for="G12">
                        <input type="checkbox" name="grade[]" id="G12" value="12">
                        12ª
                    </label>

                    <label for="G13">
                        <input type="checkbox" name="grade[]" id="G13" value="13">
                        13ª
                    </label>
                </div>

                <button type="submit" class="text-blue-800 border-blue-600 border-2 px-4 py-1 rounded">
                    Adicionar
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
