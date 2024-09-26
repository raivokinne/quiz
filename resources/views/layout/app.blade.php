<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite('resources/css/app.css')
</head>

<body>
    <x-navbar />
    <div class="bg-black text-white flex min-h-screen flex-col items-center sm:justify-center sm:pt-0">
        {{ $slot }}
    </div>
</body>

</html>
