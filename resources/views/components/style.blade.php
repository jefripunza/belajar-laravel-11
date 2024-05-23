@php
    $selected = '';
    foreach (scandir('./build/assets/') as $file) {
        $filePath = './build/assets/' . $file;
        if (is_file($filePath) && pathinfo($filePath, PATHINFO_EXTENSION) === 'css') {
            $selected = $file;
        }
    }
@endphp

@if (app()->environment('local'))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
@else
    <link rel="stylesheet" href="/build/assets/{{ $selected }}">
@endif

<link rel="stylesheet" href="https://rsms.me/inter/inter.css">
