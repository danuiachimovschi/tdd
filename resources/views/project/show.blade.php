
<x-layouts.main>
    @section('title')
        TDD
    @endsection
    <div class="w-full">
        <div class="">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                  <li>
                    <div class="flex items-center">
                      <a href="{{ route("projects.index") }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-gray-900 md:ml-2 dark:text-gray-400 dark:hover:text-white">Projects</a>
                    </div>
                  </li>
                  <li>
                    <div class="flex items-center">
                      <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                      <a href="{{ route("projects.show", ["project" => $project->id]) }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-gray-900 md:ml-2 dark:text-gray-400 dark:hover:text-white">{{ $project->title }}</a>
                    </div>
                  </li>
                </ol>
              </nav>
        </div>
        <div class="flex mt-10 justify-between items-center">
            <h1 class="text-3xl font-extrabold dark:text-white">Tasks</h1>
            <a href="{{ route("projects.create") }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Create Project</a>
        </div>
        <div class="flex justify-between w-full items-start">
            <div class="flex flex-col items-start w-full flex-wrap">
                <div class="">
                    @forelse ($project->tasks as $task)
                        <figure class="mx-auto max-w-screen-md text-center">
                            <svg aria-hidden="true" class="mx-auto mb-3 w-12 h-12 text-gray-400 dark:text-gray-600" viewBox="0 0 24 27" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M14.017 18L14.017 10.609C14.017 4.905 17.748 1.039 23 0L23.995 2.151C21.563 3.068 20 5.789 20 8H24V18H14.017ZM0 18V10.609C0 4.905 3.748 1.038 9 0L9.996 2.151C7.563 3.068 6 5.789 6 8H9.983L9.983 18L0 18Z" fill="currentColor"/></svg>
                            <blockquote>
                                <p class="text-2xl italic font-medium text-gray-900 dark:text-white">{{ $task->body }}</p>
                            </blockquote>
                        </figure>
                    @empty
                        <h1 class="text-3xl mt-10 font-extrabold dark:text-white">Nothing</h1>
                    @endforelse
                </div>
                <div class="">
                    <form action="{{ route('tasks.create', ['project' => $project->id]) }}" method="POST">
                        @csrf
                        @method("POST")
                        <textarea rows="4" name="body" class="mt-5 block p-2.5  text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 w-[500px]" placeholder="Taks Body"></textarea>
                        @error('body')
                            <p class="text-sm font-bold text-red-600 dark:text-red-500"><span class="font-medium">{{ $message }}</span></p> 
                        @enderror
                        <button type="submit" class="mt-5 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Create Task</button>
                    </form>
                </div>
            </div>
            <x-project.project  
                title="{{ $project->title }}" 
                description="{{ $project->description }}" 
                owner="{{ $project->owner->name }}"
                id="{{ $project->id }}"
                read="{{ false }}"
                >
            </x-project.project>
        </div>
    </div>
    </x-layouts.main>