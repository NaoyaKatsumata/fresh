<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">
    <h1 class="pl-8 py-2 font-serif italic text-xl text-yellow-300 bg-white">mogitate</h1>

    <div class="my-[5%] mx-[5%]">
        @yield('content')
    </div>
</body>
</html>