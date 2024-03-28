<x-app-layout>
    <div>
        <h1 class="text-xl">
            Pautas
        </h1>
    </div>

    <div>
        @foreach ($classes as $classe)
            <div class="bg-white mt-6 p-6">
                <div class="flex justify-between">
                    <div>
                        <h2 class="pb-4 uppercase">
                            {{ $classe->letter }} - {{ $classe->course }}
                        </h2>
                    </div>

                    <div>
                        <p>Turno: {{ $classe->shift }}</p>
                        <p></p>
                    </div>
                </div>
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Nº de ordem
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nome
                            </th>
                            <th scope="col" class="px-6 py-3">
                                1ª trimestre
                            </th>
                            <th scope="col" class="px-6 py-3">
                                2ª trimestre
                            </th>
                            <th scope="col" class="px-6 py-3">
                                3ª trimestre
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($classe->students as $student)
                            <tr
                                class="bg-white dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $student->id }}
                                </th>

                                <td class="px-6 py-4">
                                    {{ $student->name }}
                                </td>

                                @foreach ($student->classifications as $classification)
                                    @if ($classification->school_year_id == session('IDschoolYear'))
                                        @if ($classification->trimester == '1')
                                            <td class="px-6 py-4">
                                                {{ $classification->values }}
                                            </td>
                                        @endif

                                        @if ($classification->trimester == '2')
                                            <td class="px-6 py-4">
                                                {{ $classification->values }}
                                            </td>
                                        @endif

                                        @if ($classification->trimester == '3')
                                            <td class="px-6 py-4">
                                                {{ $classification->values }}
                                            </td>
                                        @endif
                                    @endif
                                @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endforeach
    </div>
</x-app-layout>
