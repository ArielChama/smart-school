<x-app-layout>
    <h2 class="text-xl">
        Turmas
    </h2>
    <div class="flex">
        <div class="bg-white mt-6 p-6 w-full">
            @if (session('success'))
                <div class="bg-green-200 w-full p-4">
                    {{ session('success') }}
                </div>
            @endif
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Turma
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Curso
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Turno
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Acção
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($classes as $classe)
                        <tr
                            class="bg-white dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $classe->grade }}ª {{ $classe->letter }}
                            </th>

                            <td class="px-6 py-4">
                                {{ $classe->course }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $classe->shift }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex">
                                    <a href="{{ route('classes.info', $classe->id) }}"
                                        class="font-medium text-blue-600 dark:text-blue-500 border border-blue-600 p-1 mr-1">Informações</a>

                                    @if ((!Auth::user()->is_teacher) && (session('yearCurrent')))
                                        <a href="{{ route('classes.edit', $classe->id) }}"
                                            class="font-medium text-blue-600 dark:text-blue-500 border border-blue-600 p-1 mr-1">Editar</a>

                                        <form action="{{ route('classes.delete', $classe->id) }}" method="POST">
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
