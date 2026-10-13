@extends('layouts.master')
@section('title', 'Admin')

@section('content')
    <x-card>
        <h1 class="text-2xl font-bold mb-2">Panel Admin</h1>
        <p class="mb-4">Total produk: <strong>{{ $products }}</strong></p>
        <table class="w-full text-left">
            <tr class="border-b"><th class="py-2">Nama</th><th>Email</th><th>Role</th></tr>
            @foreach ($users as $u)
                <tr class="border-b">
                    <td class="py-2">{{ $u->name }}</td>
                    <td>{{ $u->email }}</td>
                    <td>{{ $u->role }}</td>
                </tr>
            @endforeach
        </table>
    </x-card>
@endsection