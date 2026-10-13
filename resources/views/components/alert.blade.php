@props(['type' => 'success'])
@php
    $warna = ['success' => 'bg-green-100 text-green-800', 'error' => 'bg-red-100 text-red-800'];
@endphp
<div {{ $attributes->merge(['class' => 'p-3 rounded mb-4 ' . ($warna[$type] ?? $warna['success'])]) }}>
    {{ $slot }}
</div>