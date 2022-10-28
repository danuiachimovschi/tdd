<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>create Project</title>
</head>
<body>
    <div class="w-full max-w-xs">
        <form action="{{ route("projects.store") }}" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf
            @method("POST")
          <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="Title">
              Title
            </label>
            <input name="title" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="title" type="text" placeholder="Title">
          </div>
          <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
              Description
            </label>
            <input name="description" class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="password" type="text" placeholder="description">
          </div>
          <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
              Create Project
            </button>
          </div>
        </form>
        <p class="text-center text-gray-500 text-xs">
          &copy;2020 Acme Corp. All rights reserved.
        </p>
      </div>
</body>
</html>