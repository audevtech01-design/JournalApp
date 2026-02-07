@extends('layouts.app')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <h2 class="text-2xl font-bold mb-4">New Journal Entry</h2>
    
    <form action="{{ route('journal.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Title</label>
            <input type="text" 
                   name="title" 
                   class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                   required>
            @error('title')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">How was your day?</label>
            <textarea name="content" 
                      rows="8"
                      class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                      required></textarea>
            @error('content')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Add a photo (optional)</label>
            <input type="file" 
                   name="photo" 
                   accept="image/*"
                   class="w-full">
            
            <button type="button" 
                    onclick="takePhoto()"
                    class="mt-2 bg-gray-500 text-white px-4 py-2 rounded-lg">
                📷 Take Photo
            </button>
        </div>
        
        <div class="flex gap-2">
            <button type="submit" 
                    class="bg-blue-500 text-white px-6 py-2 rounded-lg">
                Save Entry
            </button>
            <a href="{{ route('journal.index') }}" 
               class="bg-gray-300 text-gray-700 px-6 py-2 rounded-lg inline-block">
                Cancel
            </a>
        </div>
    </form>
</div>

<script>
function takePhoto() {
    // This would trigger the native camera
    fetch('{{ route('journal.photo') }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    });
}
</script>
@endsection