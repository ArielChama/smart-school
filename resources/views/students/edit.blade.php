<x-app-layout>
  <h2 class="text-xl">
      Atualizar as informações do(a) aluno(a) "{{ $student->name }}".
  </h2>
  <div class="bg-white mt-6 p-6">
      @if (session('success'))
          <div class="bg-green-200 w-full p-4">
              {{ session('success') }}
          </div>
      @endif
      <form action="/students/{{ $student->id }}/update" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
          <div class="flex" style="margin-bottom: 2rem">
              <div class="w-full mr-2">
                  <div class="py-4">
                      <input type="text" name="name" value="{{ $student->name }}" placeholder="Nome completo:" class="rounded border-gray-200 w-full">
                  </div>

                  <div class="py-4">
                      <input type="date" name="birthday" value="{{ $student->birthday }}" class="rounded border-gray-200 w-full">
                  </div>


                  <div class="py-4">
                      <input type="text" name="address" value="{{ $student->address }}" placeholder="Localização:" class="rounded border-gray-200 w-full">
                  </div>

                  <div class="py-4">
                      <select name="gender" id="" class="rounded border-gray-200 w-full">
                          <option value="Masculino">Masculino</option>
                          <option value="Feminino">Feminino</option>
                      </select>
                  </div>

                  <div class="py-4">
                      <input type="file" name="image" accept="image/*" class="rounded border-gray-200 w-full">
                  </div>
              </div>

              <div class="w-full">
                  <div class="py-4">
                      <input type="email" name="email" value="{{ $student->email }}" placeholder="Email:" class="rounded border-gray-200 w-full">
                  </div>

                  <div class="py-4">
                      <input type="text" name="number_bi" value="{{ $student->number_bi }}" placeholder="Número do BI:" class="rounded border-gray-200 w-full">
                  </div>

                  <div class="py-4">
                      <input type="number" name="number_phone" value="{{ $student->number_phone }}" placeholder="Número de telefone" class="rounded border-gray-200 w-full">
                  </div>

                  <div class="py-4">
                      <input type="text" name="nationality" value="{{ $student->nationality }}" placeholder="Nacionalidade:" class="rounded border-gray-200 w-full">
                  </div>
              </div>
          </div>

          <button type="submit" class="bg-primary text-white px-6 py-2 rounded" style="background-color: #0062FF">
              Atualizar
          </button>
      </form>
  </div>
  </div>
</x-app-layout>
