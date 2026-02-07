@extends('layouts.app')

@section('content')
<div class="mb-4">
    <a href="{{ route('journal.create') }}" 
       class="bg-blue-500 text-white px-4 py-2 rounded-lg inline-block">
        New Entry
    </a>
</div>

<div class="space-y-4">
    @forelse($entries as $entry)
        <div class="bg-white rounded-lg shadow p-4">
            <a href="{{ route('journal.show', $entry) }}">
                <h2 class="text-xl font-semibold mb-2">{{ $entry->title }}</h2>
                <p class="text-gray-600 text-sm mb-2">
                    {{ $entry->entry_date->format('M d, Y - h:i A') }}
                </p>
                <p class="text-gray-700">
                    {{ Str::limit($entry->content, 150) }}
                </p>
                @if($entry->photo_path)
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $entry->photo_path) }}" 
                             alt="Entry photo" 
                             class="w-full h-48 object-cover rounded">
                    </div>
                @endif
            </a>
        </div>
    @empty
        <div class="text-center py-12 text-gray-500">
            <p class="text-lg">No entries yet. Start journaling!</p>
        </div>
    @endforelse
</div>
@endsection