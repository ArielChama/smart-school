<x-app-layout>
    <div class="bg-white mt-6 p-6">
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

        <div class="flex justify-between">
            <div>
                <h3 class="mb-2">{{ $classe->letter }} - {{ $classe->course }} </h3>
            </div>
        </div>

        <form action="{{ route('classes.addTeachers', $classe->id) }}" method="post">
            @csrf
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 mt-4">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Selecione
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Professor(a)
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Disciplinas
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($teachers as $teacher)
                        <tr
                            class="bg-white dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">

                            <td class="px-6 py-4">
                                <input type="checkbox" name="teachers[]" value="{{ $teacher->id }}">
                            </td>
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white flex items-center">
                                <img src="/images/user_profile/{{ $teacher->image }}" alt="" class="w-10 mr-2">
                                {{ $teacher->name }}
                            </th>
                            <td class="px-6 py-4">
                                @foreach ($teacher->lessons as $lesson)
                                    <input type="checkbox" name="lessons{{ $teacher->id }}[]" value="{{ $lesson->name }}">
                                    {{ $lesson->name }}
                                @endforeach
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <button type="submit" class="bg-primary text-white px-4 py-2 rounded mt-10"
                style="background-color: #0062FF">
                Adicionar professor à está turma
            </button>
        </form>
    </div>
</x-app-layout>
