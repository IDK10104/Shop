<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin — @yield('title', 'ShopFlow')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-full bg-[#09090b] text-white antialiased">

<div class="flex min-h-screen">
    {{-- Sidebar --}}
    <aside class="w-56 flex-shrink-0 border-r border-white/[0.06] bg-[#0d0d0f] p-4 flex flex-col">
        <a href="{{ route('home') }}" class="flex items-center gap-2 mb-8 px-2">
            <div class="w-7 h-7 rounded-lg bg-gradient-to-br from-violet-500 to-indigo-600 flex items-center justify-center text-white font-bold text-xs">S</div>
            <span class="font-bold text-white text-sm">ShopFlow</span>
        </a>
        <p class="text-xs text-zinc-700 font-semibold uppercase tracking-wider px-2 mb-2">Admin</p>
        <nav class="space-y-1 flex-1">
            <a href="{{ route('admin.products.index') }}"
               class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-sm transition-all {{ request()->routeIs('admin.products.*') ? 'bg-violet-500/15 text-violet-400 border border-violet-500/20' : 'text-zinc-500 hover:text-white hover:bg-white/5' }}">
                <span>📦</span> Products
            </a>
            <a href="{{ route('admin.orders.index') }}"
               class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-sm transition-all {{ request()->routeIs('admin.orders.*') ? 'bg-violet-500/15 text-violet-400 border border-violet-500/20' : 'text-zinc-500 hover:text-white hover:bg-white/5' }}">
                <span>🧾</span> Orders
            </a>
        </nav>
        <a href="{{ route('home') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg text-xs text-zinc-600 hover:text-zinc-400 transition-colors mt-4">
            ← Back to store
        </a>
    </aside>

    {{-- Main --}}
    <div class="flex-1 overflow-auto">
        <header class="border-b border-white/[0.06] px-6 h-14 flex items-center">
            <h1 class="font-semibold text-white">@yield('title')</h1>
        </header>

        @if(session('success'))
            <div class="mx-6 mt-4 px-4 py-3 rounded-xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-sm">
                {{ session('success') }}
            </div>
        @endif

        <main class="p-6">
            @yield('content')
        </main>
    </div>
</div>

</body>
</html>
