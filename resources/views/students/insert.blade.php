<x-app-layout>
    <h2 class="text-xl">
        Matricular aluno {{ $student->name }}
    </h2>
    <div class="bg-white mt-6 p-6">
        @if (session('success'))
            <div class="bg-green-200 w-full p-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="/classes/{{ $student->id }}/matriculate" method="POST">
            @csrf
            @if ($message)
                <h3>
                    O aluno {{ $student->name }} já está matriculado na turma {{ $student->classes[0]->letter }}
                </h3>
            @endif

            <select name="classe" id="" class="rounded border-gray-200 w-full mb-5 mt-5">
                @foreach ($classes as $classe)
                    @if ($message)
                        <option value="{{ $classe->id }}" disabled>Turma {{ $classe->grade }}ª {{ $classe->letter }} -
                            {{ $classe->course }}</option>
                    @else
                        <option value="{{ $classe->id }}">Turma {{ $classe->grade }}ª {{ $classe->letter }} -
                            {{ $classe->course }}</option>
                    @endif
                @endforeach
            </select>

            <button type="submit" class="bg-blue-600 text-white px-4 py-1 rounded">
                Matricular
            </button>
        </form>
    </div>
</x-app-layout>
