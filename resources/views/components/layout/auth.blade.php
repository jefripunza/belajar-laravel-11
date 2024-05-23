<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">

<head>
    <x-meta></x-meta>
    <title>{{ $title }}</title>
    <x-style></x-style>
</head>

<body class="bg-gray-100 min-h-screen flex flex-col justify-center py-12 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <img class="mx-auto h-10 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600"
            alt="Your Company">
        <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">{{ $title_form }}</h2>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        {{ $slot }}
    </div>
    <x-script></x-script>
</body>

</html>
