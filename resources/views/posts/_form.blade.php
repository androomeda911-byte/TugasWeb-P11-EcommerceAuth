<div class="mb-4">
    <label for="title" class="block font-semibold mb-1">Judul</label>
    <input id="title" name="title" value="{{ old('title', $post->title ?? '') }}"
           class="w-full border rounded px-3 py-2 @error('title') border-red-500 @enderror">
    @error('title')
        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>

<div class="mb-4">
    <label for="body" class="block font-semibold mb-1">Isi</label>
    <textarea id="body" name="body" rows="6"
              class="w-full border rounded px-3 py-2 @error('body') border-red-500 @enderror">{{ old('body', $post->body ?? '') }}</textarea>
    @error('body')
        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>

<button class="bg-indigo-600 text-white px-4 py-2 rounded">Simpan</button>
<a href="{{ route('posts.index') }}" class="ml-3 text-gray-600">Batal</a>