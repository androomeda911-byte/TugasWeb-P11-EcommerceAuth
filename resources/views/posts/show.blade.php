@extends('layouts.master')
@section('title', $post->title)

@section('content')
    <x-card>
        <h1 class="text-2xl font-bold">{{ $post->title }}</h1>
        <p class="text-sm text-gray-500 mb-4">{{ $post->created_at->format('d M Y H:i') }}</p>
        <p class="whitespace-pre-line">{{ $post->body }}</p>
        <a href="{{ route('posts.index') }}" class="inline-block mt-4 text-indigo-600">← Kembali</a>
    </x-card>
@endsection