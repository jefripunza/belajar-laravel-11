@if (app()->environment('local'))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
@else
    <link rel="stylesheet" href="/build/assets/app-BTEsg2y2.css">
@endif

<link rel="stylesheet" href="https://rsms.me/inter/inter.css">
