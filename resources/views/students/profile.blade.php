<x-app-layout>
    <div class="flex flex-wrap">
        <div class="bg-white mt-6 p-6 mr-5 ">
            <img src="/images/students/{{ $student->image }}" alt="" class="w-40 rounded-full">
            <div class="py-4 mb-5 text-center">
                <h3 class="font-medium uppercase mb-2">{{ $student->name }}</h3>
                <p>{{ $student->course->name }}</p>
            </div>

            @if ((!Auth::user()->is_teacher) && (session('yearCurrent')))
                <a href="/classes/{{ $student->id }}/insert"
                    class="text-blue-500 px-6 py-2 rounded border-2 border-blue-500">
                    Matricular aluno
                </a>
            @endif
        </div>

        <div class="bg-white mt-6 p-6">
            <table class="text-xs text-gray-700 uppercase text-left bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tbody>
                    <tr
                        class="bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-600">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">Número de
                            processo</th>
                        <td>{{ $student->process_number }}</td>
                    </tr>

                    <tr
                        class="bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-600">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">Nome</th>
                        <td>{{ $student->name }}</td>
                    </tr>

                    <tr
                        class="bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-600">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">Email</th>
                        <td>{{ $student->email }}</td>
                    </tr>

                    <tr
                        class="bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-600">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">Enedereço
                        </th>
                        <td>{{ $student->address }}</td>
                    </tr>

                    <tr
                        class="bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-600">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Nacionalidade</th>
                        <td>{{ $student->nationality }}</td>
                    </tr>

                    <tr
                        class="bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-600">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">Número de
                            telefone</th>
                        <td>{{ $student->number_phone }}</td>
                    </tr>

                    <tr
                        class="bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-600">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">Género
                        </th>
                        <td>{{ $student->gender }}</td>
                    </tr>

                    <tr
                        class="bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-600">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">Linguagem de
                            opção
                        </th>
                        <td>{{ $student->language_option }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
