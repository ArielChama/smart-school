<x-app-layout>
    <h2 class="text-xl">
        Adicionar uma disciplina ao professor
    </h2>
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

        <div>
            <form action="/teachers/{{ $id }}/lesson/create" method="POST">
				@csrf
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Escolha
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nome
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Curso
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lessons as $lesson)
                            <tr
                                class="bg-white dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">

                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">

                                    <input type="checkbox" name="lessons[]" value="{{ $lesson->id }}" class="">
                                </th>
                                <td class="px-6 py-4">
                                    {{ $lesson->name }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $lesson->course }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

				<button type="submit" class="bg-primary text-white px-6 py-2 rounded" style="background-color: #0062FF">
					Adicionar
				</button>
            </form>
        </div>
    </div>
</x-app-layout>
