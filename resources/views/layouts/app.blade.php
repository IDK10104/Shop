<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ShopFlow') — ShopFlow</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-full bg-[#09090b] text-white antialiased">

{{-- Ambient background --}}
<div class="fixed inset-0 bg-[radial-gradient(ellipse_80%_50%_at_50%_-20%,rgba(120,80,255,0.12),transparent)] pointer-events-none z-0"></div>

{{-- Navbar --}}
<header class="sticky top-0 z-50 border-b border-white/[0.06] bg-[#09090b]/85 backdrop-blur-xl">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 h-16 flex items-center justify-between gap-4">
        {{-- Logo --}}
        <a href="{{ route('home') }}" class="flex items-center gap-2 flex-shrink-0">
            <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-violet-500 to-indigo-600 flex items-center justify-center font-bold text-sm">S</div>
            <span class="font-bold text-white text-lg tracking-tight">ShopFlow</span>
        </a>

        {{-- Search --}}
        <form action="{{ route('shop') }}" method="GET" class="hidden sm:flex flex-1 max-w-md">
            <div class="relative w-full">
                <input name="search" value="{{ request('search') }}" type="search" placeholder="Search products..."
                    class="w-full pl-4 pr-10 py-2 rounded-xl bg-white/5 border border-white/10 text-sm text-white placeholder:text-zinc-600 focus:outline-none focus:border-violet-500/50 focus:ring-1 focus:ring-violet-500/20 transition-all">
                <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2 text-zinc-500 hover:text-zinc-300 transition-colors">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </button>
            </div>
        </form>

        {{-- Nav links + cart --}}
        <nav class="flex items-center gap-2">
            <a href="{{ route('shop') }}" class="hidden sm:block text-sm text-zinc-400 hover:text-white px-3 py-1.5 rounded-lg hover:bg-white/5 transition-all">Shop</a>
            <a href="{{ route('cart') }}" class="relative flex items-center gap-2 text-sm px-3 py-2 rounded-xl bg-white/5 border border-white/10 text-zinc-300 hover:text-white hover:bg-white/10 transition-all">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                <span class="hidden sm:inline">Cart</span>
                @php $count = \App\Models\CartItem::where('session_id', session()->getId())->sum('quantity') @endphp
                @if($count > 0)
                    <span class="absolute -top-1.5 -right-1.5 w-5 h-5 rounded-full bg-violet-500 text-white text-xs flex items-center justify-center font-bold">{{ $count }}</span>
                @endif
            </a>
            @auth
                <a href="{{ route('account.orders') }}" class="hidden sm:block text-sm px-3 py-1.5 rounded-lg bg-white/5 border border-white/10 text-zinc-300 hover:text-white hover:bg-white/10 transition-all">
                    My Orders
                </a>
                <form action="{{ route('logout') }}" method="POST" class="hidden sm:block">
                    @csrf
                    <button type="submit" class="text-xs px-2.5 py-1.5 rounded-lg text-zinc-600 hover:text-zinc-400 transition-all">Sign out</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="hidden sm:block text-sm px-3 py-1.5 rounded-lg text-zinc-400 hover:text-white hover:bg-white/5 transition-all">Sign in</a>
                <a href="{{ route('register') }}" class="hidden sm:block text-sm px-3 py-1.5 rounded-lg bg-violet-600 hover:bg-violet-500 text-white font-medium transition-colors">Register</a>
            @endauth
            @if(auth()->check() && auth()->user()->email === config('shop.admin_email'))
                <a href="{{ route('admin.products.index') }}" class="hidden sm:block text-xs px-2.5 py-1.5 rounded-lg bg-violet-500/15 border border-violet-500/25 text-violet-400 hover:text-violet-300 transition-all">Admin</a>
            @endif
        </nav>
    </div>
</header>

{{-- Flash messages --}}
@if(session('success'))
    <div class="fixed top-20 right-4 z-50 bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-sm px-4 py-3 rounded-xl shadow-lg" x-data x-init="setTimeout(() => $el.remove(), 3000)">
        {{ session('success') }}
    </div>
@endif
@if(session('error'))
    <div class="fixed top-20 right-4 z-50 bg-red-500/10 border border-red-500/30 text-red-400 text-sm px-4 py-3 rounded-xl shadow-lg">
        {{ session('error') }}
    </div>
@endif

<main class="relative z-10">
    @yield('content')
</main>

{{-- Footer --}}
<footer class="relative z-10 border-t border-white/[0.06] mt-24">
    <div class="max-w-7xl mx-auto px-6 py-12 flex flex-col sm:flex-row items-center justify-between gap-4">
        <div class="flex items-center gap-2">
            <div class="w-6 h-6 rounded-md bg-gradient-to-br from-violet-500 to-indigo-600 flex items-center justify-center text-white font-bold text-xs">S</div>
            <span class="font-semibold text-white text-sm">ShopFlow</span>
        </div>
        <p class="text-xs text-zinc-600">© {{ date('Y') }} ShopFlow. Built with Laravel & Stripe.</p>
        <div class="flex items-center gap-4 text-xs text-zinc-600">
            <a href="{{ route('shop') }}" class="hover:text-zinc-400 transition-colors">Shop</a>
            <a href="{{ route('cart') }}" class="hover:text-zinc-400 transition-colors">Cart</a>
            <a href="{{ route('admin.products.index') }}" class="hover:text-zinc-400 transition-colors">Admin</a>
        </div>
    </div>
</footer>

</body>
</html>
