{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @forelse ($projects as $project)
        <x-project.project
            title="{{ $project->title }}" 
            description="{{ $project->description }}" 
            owner="{{ $project->owner->name }}">
        </x-project.project>
        @empty
        <h1>Nothing</h1>
    @endforelse
</body>
</html> --}}

<x-layouts.main>
    @forelse ($projects as $project)
    <x-project.project
        title="{{ $project->title }}" 
        description="{{ $project->description }}" 
        owner="{{ $project->owner->name }}">
    </x-project.project>
    @empty
    <h1>Nothing</h1>
    @endforelse
</x-layouts.main>