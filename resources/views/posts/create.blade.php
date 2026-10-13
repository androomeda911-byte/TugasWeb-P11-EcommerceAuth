@extends('layouts.master')
@section('title', 'Tambah Post')

@section('content')
    <x-card>
        <h1 class="text-xl font-bold mb-4">Tambah Post</h1>
        <form action="{{ route('posts.store') }}" method="POST">
            @csrf
            @include('posts._form')
        </form>
    </x-card>
@endsection