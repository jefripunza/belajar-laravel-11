@php
    $selected = '';
    foreach (scandir('./build/assets/') as $file) {
        $filePath = './build/assets/' . $file;
        if (is_file($filePath) && pathinfo($filePath, PATHINFO_EXTENSION) === 'js') {
            $selected = $file;
        }
    }
@endphp

@if (!app()->environment('local'))
    <script defer src="/build/assets/{{ $selected }}"></script>
@endif

<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
