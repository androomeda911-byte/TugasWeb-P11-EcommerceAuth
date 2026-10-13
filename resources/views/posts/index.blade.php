@extends('layouts.master')
@section('title', 'Daftar Post')

@section('content')
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Daftar Post</h1>
        <a href="{{ route('posts.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded">+ Tambah</a>
    </div>

    @forelse ($posts as $post)
        <x-card class="mb-3">
            <h2 class="text-lg font-semibold">
                <a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a>
            </h2>
            <p class="text-sm text-gray-500">
                oleh {{ $post->user->name ?? '-' }} · {{ $post->created_at->diffForHumans() }}
            </p>
            <p class="mt-2">{{ Str::limit($post->body, 120) }}</p>

            <div class="mt-3 flex gap-4">
                @can('update', $post)
                    <a href="{{ route('posts.edit', $post) }}" class="text-indigo-600">Edit</a>
                @endcan
                @can('delete', $post)
                    <form action="{{ route('posts.destroy', $post) }}" method="POST"
                          onsubmit="return confirm('Hapus post ini?')">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-600">Hapus</button>
                    </form>
                @endcan
            </div>
        </x-card>
    @empty
        <p>Belum ada post.</p>
    @endforelse

    <div class="mt-4">{{ $posts->links() }}</div>
@endsection