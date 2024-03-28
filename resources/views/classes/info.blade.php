<x-app-layout>
    <div class="bg-white mt-6 p-6">
        @if (session('success'))
            <div class="bg-green-200 w-full p-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex justify-between pb-10">
            <div>
                <h3 class="mb-2"><strong>Turma:</strong> {{ $classe->letter }}</h3>
                <p><strong>Curso:</strong> {{ $classe->course }}</p>
            </div>

            <div>
                <p class="mb-2"><strong>Classe:</strong> {{ $classe->grade }}ª</p>
                <p><strong>Turno:</strong> {{ $classe->shift }}</p>
            </div>
        </div>

        <div class="flex justify-between">
            <div>
                <h3 class="font-bold">Disciplinas Gerais</h3>
                <ul>
                    @foreach ($lessonsGeneral as $lesso)
                        <li>{{ $lesso->name }}</li>
                    @endforeach
                </ul>
            </div>

            <div class="mt-3">
                <h3 class="font-bold">Disciplinas do curso</h3>
                <ul>
                    @foreach ($lessons as $lesson)
                        <li>{{ $lesson->name }}</li>
                    @endforeach
                </ul>
            </div>
        </div>

        @if (session('yearCurrent'))
            <div class="mt-5">
                <a href="/classes/{{ $classe->id }}/classifications/create"
                    class="border-blue-600 border-2 text-blue-600 px-4 py-2 rounded mr-2">
                    Adicionar notas
                </a>

                <a href="{{ route('classes.teachers', $classe->id) }}"
                    class="border-blue-600 border-2 text-blue-600 px-4 py-2 rounded">
                    Adicionar professores
                </a>
            </div>
        @endif
    </div>

    <div class="flex">
        <div class="bg-white mt-6 p-6 mr-2 overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Número de matrícula
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nome
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Data de nascimento
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Acção
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($classe->students as $student)
                        <tr
                            class="bg-white dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="px-6 py-4">
                                {{ $student->id }}
                            </td>
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $student->name }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $student->birthday }}
                            </td>

                            <td class="px-6 py-4">
                                <div class="flex">
                                    <a href="/students/{{ $student->id }}/profile"
                                        class="font-medium text-blue-600 dark:text-blue-500 border border-blue-600 p-1 mr-1">Perfil</a>

                                    @if (!Auth::user()->is_teacher && session('yearCurrent'))
                                        <form action="/classes/student/{{ $student->id }}/delete" method="POST">
                                            @csrf
                                            <input type="hidden" name="classe" value="{{ $classe->id }}">
                                            <button type="submit"
                                                class="font-medium text-red-500 dark:text-blue-500 border border-red-700 p-1">Apagar</button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="bg-white mt-6 p-6 overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Nome
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Disciplina
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Acção
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($classe->users as $teacher)
                        <tr
                            class="bg-white dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $teacher->name }}
                            </th>

                            <td class="px-6 py-4">
                                @php
                                    $string = $teacher->pivot->lesson;
                                    $string = trim($string, "[]");
                                    $string = str_replace('"', '', $string);
                                    $parts = explode('.', $string);
                                @endphp
                                @foreach ($parts as $le)
                                    {{ $le }}
                                @endforeach
                            </td>

                            <td class="px-6 py-4">
                                <div class="flex">
                                    <a href="/teachers/{{ $teacher->id }}/profile"
                                        class="font-medium text-blue-600 dark:text-blue-500 border border-blue-600 p-1 mr-1">Perfil</a>

                                    @if (!Auth::user()->is_teacher && session('yearCurrent'))
                                        <form action={{ route('teachers.delete', $teacher->id) }} method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="font-medium text-red-500 dark:text-blue-500 border border-red-700 p-1">Apagar</button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
