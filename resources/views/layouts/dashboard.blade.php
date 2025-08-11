<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/Loopple/loopple-public-assets@main/riva-dashboard-tailwind/riva-dashboard.css">
    <title>@yield('title', 'Dashboard')</title>
</head>
<body class="h-screen overflow-hidden flex items-center justify-center bg-[#edf2f7]">

<div class="container flex flex-col mx-auto bg-white">
    {{-- Sidebar --}}
    <aside class="group/sidebar flex flex-col shrink-0 lg:w-[300px] w-[250px] transition-all duration-300 ease-in-out m-0 fixed z-40 inset-y-0 left-0 bg-white border-r border-r-dashed border-r-neutral-200" id="sidenav-main">
        <div class="flex shrink-0 px-8 items-center justify-between h-[96px]">
            <a href="https://www.loopple.com">
                <img alt="Logo" src="https://raw.githubusercontent.com/Loopple/loopple-public-assets/main/riva-dashboard-tailwind/img/logos/loopple.svg">
            </a>
        </div>
        <div class="border-b border-dashed lg:block dark:border-neutral-700/70 border-neutral-200"></div>
        <div class="flex items-center justify-between px-8 py-5">
            <div class="flex items-center mr-5">
                <div class="mr-5">
                    <img class="w-[40px] h-[40px] rounded-[.95rem]" src="https://raw.githubusercontent.com/Loopple/loopple-public-assets/main/riva-dashboard-tailwind/img/avatars/avatar1.jpg" alt="avatar">
                </div>
                <div class="mr-2">
                    <a href="javascript:void(0)" class="text-[1.075rem] font-medium text-secondary-inverse">Kdm Ah Thai</a>
                    <span class="text-secondary-dark font-medium block text-[0.85rem]">SEO Manager</span>
                </div>
            </div>
        </div>
        <div class="border-b border-dashed lg:block dark:border-neutral-700/70 border-neutral-200"></div>
        <div class="relative pl-3 my-5 overflow-y-scroll">
            <div class="flex flex-col w-full font-medium">
                <a href="#" class="flex items-center px-4 py-[.775rem] my-[.4rem] rounded-[.95rem] hover:text-dark">Sales</a>
                <a href="#" class="flex items-center px-4 py-[.775rem] my-[.4rem] rounded-[.95rem] hover:text-dark">Profile</a>
                <a href="#" class="flex items-center px-4 py-[.775rem] my-[.4rem] rounded-[.95rem] hover:text-dark">Settings</a>
                <div class="px-4 py-[.65rem] pt-5">
                    <span class="font-semibold text-[0.95rem] uppercase text-secondary-dark">Applications</span>
                </div>
                <a href="#" class="flex items-center px-4 py-[.775rem] my-[.4rem] rounded-[.95rem] hover:text-dark">Users</a>
                <a href="#" class="flex items-center px-4 py-[.775rem] my-[.4rem] rounded-[.95rem] hover:text-dark">Orders</a>
                <a href="#" class="flex items-center px-4 py-[.775rem] my-[.4rem] rounded-[.95rem] hover:text-dark">Track Order</a>
                <a href="#" class="flex items-center px-4 py-[.775rem] my-[.4rem] rounded-[.95rem] hover:text-dark">Products</a>
            </div>
        </div>
    </aside>

    {{-- Main Content --}}
    <main class="ml-[300px] p-6 w-full">
        @yield('content')
    </main>
</div>

</body>
</html>
