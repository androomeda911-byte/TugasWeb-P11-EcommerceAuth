@extends('layouts.master')
@section('title', 'Edit Post')

@section('content')
    <x-card>
        <h1 class="text-xl font-bold mb-4">Edit Post</h1>
        <form action="{{ route('posts.update', $post) }}" method="POST">
            @csrf
            @method('PUT')
            @include('posts._form')
        </form>
    </x-card>
@endsection