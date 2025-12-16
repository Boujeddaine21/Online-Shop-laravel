<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @viteReactRefresh
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>OnlineShop</title>
</head>

<body class="relative min-h-screen">

    <div class="fixed inset-0 -z-10">
        <img src="/images/bg.jpg" alt="Hintergrund" class="w-full h-full object-cover">
    </div>

    <div class="relative z-10">

        <div class="grid grid-cols-4 place-items-center items-center justify-center p-4 text-white">
            <div class="text-center">
                <a href="/">
                    <img class="w-24 h-10" src="/images/logo.png" alt="Logo">
                </a>
            </div>

            <div class="col-span-2">
                <div class="flex gap-5 justify-center">
                    @role('admin')
                        <a href="/admin/dashboard" class="hover:underline">Dashboard</a>
                        <a href="/admin/products" class="hover:underline">Products</a>
                        <a href="/admin/orders" class="hover:underline">Orders</a>
                    @endrole
                    @role('user')
                        <a href="/shop" class="hover:underline">Shop</a>
                    @endrole
                    <a href="" class="hover:underline">About</a>
                    <a href="" class="hover:underline">Contact</a>
                </div>
            </div>

            <div class="flex justify-end items-center gap-4">
                <div><a href="" class="hover:underline">Cart</a></div>
                <div class="flex gap-4">
                    @guest
                        <a href="/login" class="hover:underline">Login</a>
                        <a href="/register" class="hover:underline">Register</a>
                    @endguest
                    @auth
                        <form action="/logout" method="POST">
                            @csrf
                            <button class="hover:underline hover:cursor-pointer">Logout</button>
                        </form>
                    @endauth
                </div>
            </div>
        </div>

        <div class="mt-20 max-w-7xl place-items-center mx-auto px-4 text-gray-800">
            <div class="mb-10">@yield('login')</div>
            <div class="mb-10">@yield('register')</div>
            <div class="mb-10">@yield('create-product')</div>
            <div class="mb-10">@yield('dashboard')</div>
            <div class="mb-10">@yield('categories')</div>

            <main class="mb-10">
                @yield('admin-all-products')
            </main>
        </div>
    </div>
</body>

</html>
