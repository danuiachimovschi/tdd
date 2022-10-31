<x-layouts.main>
  @section('title')
  Create Project
  @endsection
  <div class="flex flex-col">
    <h1 class="text-3xl font-extrabold dark:text-white mb-6">Create Project</h1>
    <form action="{{ route('projects.store') }}" method="POST" class="h-[300px] w-[400px]">
        @csrf
        @method("POST")
        <div class="mb-2">
            <label for="success" class="block mb-2 text-sm font-medium">Project Title</label>
            <input 
            name="title" 
            type="text" 
            class="bg-gray-50 border  text-green-900  text-sm rounded-lg  block w-full p-2.5 dark:bg-gray-700 " 
            placeholder="Title"
            value="{{ old('title', '') }}"
            >
        </div>
         @error('title') 
          <p class="text-sm font-bold text-red-600 dark:text-red-500"><span class="font-medium">{{ $message }}</span></p>
         @enderror 
        <div>
          <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Project Description</label>
          <textarea id="message" rows="4" name="description" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Project Description"></textarea>
        </div>
        @error('description') 
          <p class="text-sm font-bold text-red-600 dark:text-red-500"><span class="font-medium">{{ $message }}</span></p>
        @enderror 
        <button type="submit" class="mt-5 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Create Project</button>
    </form>
  </div>
</x-layouts.main>