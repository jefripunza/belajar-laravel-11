<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">

<head>
    <x-meta></x-meta>
    <title>{{ $title }}</title>
    <x-style></x-style>
</head>

<body class="h-full">
    <div class="min-h-full">
        <x-navbar hide-navmenu="true"></x-navbar>

        <main>
            <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
                <!-- Your content -->
                {{ $slot }}
            </div>
        </main>

    </div>
    <x-script></x-script>
</body>

</html>
