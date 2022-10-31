
<x-layouts.main>
@section('title')
    TDD
@endsection
<div class="w-full">
    <div class="flex justify-between items-center">
        <h1 class="text-3xl font-extrabold dark:text-white">Projects</h1>
        <a href="{{ route("projects.create") }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Create Project</a>
    </div>
    <div class="flex justify-between items-center w-full flex-wrap">
        @forelse ($projects as $project)
        <x-project.project
            title="{{ $project->title }}" 
            description="{{ $project->description }}" 
            owner="{{ $project->owner->name }}"
            id="{{ $project->id }}"
            >
        </x-project.project>
        @empty
        <h1 class="mt-10 text-4xl font-extrabold dark:text-white">Nothing ...</h1>
        @endforelse
    </div>
</div>
</x-layouts.main>