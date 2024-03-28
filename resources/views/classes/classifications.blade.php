<x-app-layout>
    <div class="bg-white mt-6 p-6">
        @if (session('success'))
            <div class="bg-green-200 w-full p-4">
                {{ session('success') }}
            </div>
        @endif


        <div class="flex justify-between">
            <div>
                <h3 class="mb-2">{{ $classe->letter }} - {{ $classe->course }} </h3>
            </div>

            <div class="flex">
                <form action="{{ route('classes.classifications', $classe->id) }}">
                    @csrf
                    <select name="trimester" class="rounded border-gray-200 w-full mr-2">
                        <option value="1">Primeiro trimestre</option>
                        <option value="2">Segundo trimestre</option>
                        <option value="3">Terceiro trimestre</option>
                    </select>

                    <button type="submit" class="border-blue-600 border-2 text-blue-500 px-4 py-2 rounded">
                        Ver
                    </button>
                </form>
            </div>
        </div>

        <form action="/classes/{{ $classe->id }}/classifications/store" method="post">
            @csrf
            <input type="hidden" name="trimester" value="{{ $semester }}">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 mt-4">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Imagem
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nome
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nota
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($classe->students as $student)
                        <tr
                            class="bg-white dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <img src="/images/students/{{ $student->image }}" alt="" class="w-10">
                            </th>
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $student->name }}
                            </th>
                            <td class="px-6 py-4">
                                @if (isset($student->classifications[0]) && !empty($student->classifications[0]))
                                    @foreach ($student->classifications as $classification)
                                        @if ($classification->school_year_id == session('IDschoolYear') && $classification->trimester == $semester)
                                            <input type="number" id="input{{ $student->id }}"
                                                name="value{{ $student->id }}" value="{{ $classification->values }}"
                                                class="rounded border-gray-200" placeholder="Digite a nota:">
                                        @endif
                                    @endforeach
                                @else
                                    <input type="number" id="input{{ $student->id }}"
                                        name="value{{ $student->id }}" class="rounded border-gray-200"
                                        placeholder="Digite a nota:">
                                @endif
                                <input type="hidden" name="student{{ $student->id }}" value="{{ $student->id }}">
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <button type="submit" class="bg-primary text-white px-4 py-2 rounded mt-10"
                style="background-color: #0062FF">
                Adicionar notas a pauta
            </button>
        </form>
    </div>
</x-app-layout>
