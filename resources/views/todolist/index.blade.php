<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>{{ $tittle }}</title>
</head>

<body class="bg-gray-50">
    <div class="max-w-screen-xl mx-auto px-4 py-5">
        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <ul class="list-disc pl-5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
             </div>
        @endif
        
        <div class="flex justify-between mb-4 lg:mb-8">
            <form method="post" action="/logout">
                @csrf
                <button class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-500" type="submit">
                    Sign Out
                </button>
            </form>
        </div>

        <div class="grid lg:grid-cols-2 gap-8 items-center py-5">
            <div class="text-center lg:text-center">
                <h1 class="text-4xl lg:text-6xl font-bold leading-none mb-3">Todolist</h1>
            </div>

            <div class="max-w-md mx-auto lg:w-[70%] lg:py-8">
                <form class="p-6 bg-white border rounded-lg shadow-sm" method="post" action="/todolist">
                    @csrf
                    <div class="mb-4">
                        <label for="todo" class="block text-sm font-medium text-gray-700 mb-2">Todo</label>
                        <input type="text" id="todo" name="todo" class="block w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" placeholder="todo">
                    </div>
                    <button class="w-full bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-500" type="submit">
                        Add Todo
                    </button>
                </form>
            </div>
        </div>

        <div class="py-5 lg:py-16">
            <div class="overflow-x-auto">
                <table class="min-w-full table-auto bg-white shadow-sm rounded-lg overflow-hidden">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">ID</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Todo</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-500"></th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($todolist as $todo)
                        <tr>
                            <td class="px-6 py-4 text-sm lg:text-lg text-gray-900">{{$todo["id"]}}</td>
                            <td class="px-6 py-4 text-sm lg:text-lg text-gray-900">{{$todo["todo"]}}</td>
                            <td class="px-6 py-4 text-right">
                                <form action="/todolist/remove/{{$todo["id"]}}" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <button class="bg-red-600 text-white py-2 px-4 rounded-lg hover:bg-red-500" type="submit">
                                        Remove
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
