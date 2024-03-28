<x-app-layout>
    <h2 class="text-xl">
        Todos professores
    </h2>

    <div class="bg-white mt-6 p-6 w-full">
        @if (session('success'))
            <div class="bg-green-200 w-full p-4 mb-3">
                {{ session('success') }}
            </div>
        @endif
        <div class="flex flex-column sm:flex-row flex-wrap space-y-4 sm:space-y-0 items-center justify-between pb-4">
            <label for="table-search" class="sr-only">Procurar</label>
            <div class="relative">
                <div
                    class="absolute inset-y-0 left-0 rtl:inset-r-0 rtl:right-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor"
                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>
                <input type="search" id="table_search" oninput="search_teachers()"
                    class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Procurar professor">
            </div>
        </div>
        <table id="teachers" class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Nome
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Disciplina
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Género
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Acção
                    </th>
                </tr>
            </thead>
            <tbody id="tbody">
            </tbody>
        </table>
    </div>

    <script>
        const search = document.getElementById("table_search")

        const search_teachers = async () => {
            const teachers = await (await fetch('http://localhost:8000/teachers/search')).json()

            document.getElementById('tbody').innerHTML = ""
            
            teachers[1].forEach(teacher => {
                if (teacher.name.toUpperCase().includes(search.value.trim().toUpperCase())) {
                    
                    const html = `
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                ${teacher.name}
                            </th>
                            <td class="px-6 py-4">
                                ${teacher.lessons.map(lesson => `${lesson.name}`).join(', ')}
                            </td>
                            <td class="px-6 py-4">
                                ${teacher.gender}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex">
                                    <a href="/teachers/${teacher.id}/profile"
                                        class="font-medium text-blue-600 dark:text-blue-500 border border-blue-600 p-1 mr-1">Perfil</a>
                                    @if ((!Auth::user()->is_teacher) && (session('yearCurrent')))
                                        <a href="/teachers/${teacher.id}/edit"
                                            class="font-medium text-blue-600 dark:text-blue-500 border border-blue-600 p-1 mr-1">Editar</a>

                                        <form action="/teachers/${teacher.id}/delete" method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="font-medium text-red-500 dark:text-blue-500 border border-red-700 p-1">Apagar</button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                `

                    let tr = document.createElement("tr")
                    let classes = 'bg-white dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600'.split(' ')
                    tr.innerHTML = html
                    classes.forEach(classe => {
                        tr.classList.add(classe)
                    });

                    document.getElementById('tbody').appendChild(tr)
                    
                }

            });
        }


        search_teachers()
    </script>
</x-app-layout>
