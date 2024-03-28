<x-app-layout>
    <div class="">
        <div class="flex flex-wrap">
            <div class="bg-white mt-6 p-6 mr-5 ">
                <img src="/images/user_profile/{{ $teacher->image }}" alt="" class="w-40 rounded-full">
                <div class="py-4 text-center uppercase">
                    <h3 class="font-medium">{{ $teacher->name }}</h3>
                    <p class="my-2">Professor</p>
                </div>
            </div>

            <div class="bg-white mt-6 p-6">
                <table class="text-xs text-gray-700 uppercase text-left bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tbody>
                        <tr
                            class="bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-600">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">Nome</th>
                            <td>{{ $teacher->name }}</td>
                        </tr>

                        <tr
                            class="bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-600">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">Email</th>
                            <td>{{ $teacher->email }}</td>
                        </tr>

                        <tr
                            class="bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-600">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">Enedereço
                            </th>
                            <td>{{ $teacher->address }}</td>
                        </tr>

                        <tr
                            class="bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-600">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                Nacionalidade</th>
                            <td>{{ $teacher->nationality }}</td>
                        </tr>

                        <tr
                            class="bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-600">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">Número de
                                telefone</th>
                            <td>{{ $teacher->number_phone }}</td>
                        </tr>

                        <tr
                            class="bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-600">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">Género
                            </th>
                            <td>{{ $teacher->gender }}</td>
                        </tr>

                        <tr
                            class="bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-600">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">Disciplina
                            </th>
                            <td>
                                @foreach ($teacher->lessons as $lesson)
                                    {{ $lesson->name }} |
                                @endforeach
                                @if (!Auth::user()->is_teacher)
                                    <a href="/teachers/{{ $teacher->id }}/lesson"
                                        class="bg-primary text-white text-xs px-2 py-1 rounded">Adicionar</a>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
