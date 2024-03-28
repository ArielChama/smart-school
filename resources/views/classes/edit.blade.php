<x-app-layout>
    <div class="bg-white mt-6 p-6">
        <h3 class="text-lg uppercase font-medium mb-4">Editar a turma "{{ $classe->letter }}"</h3>
        <p class="text-gray-700">
            As informações não alteradas serão as mesmas com exceção das seleções.
        </p>

        @if (session('success'))
            <div class="bg-green-200 w-full p-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="/classes/{{ $classe->id }}/update" cme>
            @csrf
            @method('PUT')
            <input type="text" name="letter" value="{{ $classe->letter }}" placeholder="Letra da turma:" class="rounded border-gray-200 w-full my-4">
            <select name="course_name" class="rounded border-gray-200 w-full mt-1 mb-4">
                <option disabled>Escolha um curso:</option>
                @foreach ($courses as $course)
                    <option value="{{ $course->id }}">{{ $course->name }}</option>
                @endforeach
            </select>
            <button type="submit" class="text-blue-800 border-blue-600 border-2 px-4 py-1 rounded">
                Criar
            </button>
        </form>
    </div>
</x-app-layout>
