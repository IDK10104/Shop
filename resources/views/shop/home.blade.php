@extends('layouts.app')
@section('title', 'Home')

@section('content')
{{-- Hero --}}
<section class="max-w-7xl mx-auto px-4 sm:px-6 pt-16 pb-8">
    <div class="relative rounded-3xl overflow-hidden bg-gradient-to-br from-violet-950/60 via-[#0d0d14] to-indigo-950/40 border border-white/10 px-8 sm:px-16 py-20 text-center">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,rgba(139,92,246,0.15),transparent_70%)]"></div>
        <div class="relative z-10">
            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-violet-500/10 border border-violet-500/20 text-violet-400 text-xs font-medium mb-6">
                <span class="w-1.5 h-1.5 rounded-full bg-violet-400 animate-pulse"></span>
                New arrivals just dropped
            </div>
            <h1 class="text-4xl sm:text-6xl font-bold text-white leading-tight mb-4">
                Shop the future,<br>
                <span class="gradient-text">delivered today</span>
            </h1>
            <p class="text-zinc-400 text-lg max-w-lg mx-auto mb-8">
                Curated products with fast shipping, easy returns, and Stripe-secured checkout.
            </p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-3">
                <a href="{{ route('shop') }}" class="px-6 py-3 rounded-xl bg-gradient-to-r from-violet-600 to-indigo-600 text-white font-semibold text-sm hover:opacity-90 transition-opacity shadow-lg shadow-violet-500/25">
                    Shop all products →
                </a>
                <a href="{{ route('shop') }}?category=electronics" class="px-6 py-3 rounded-xl bg-white/5 border border-white/10 text-zinc-300 text-sm hover:bg-white/10 hover:text-white transition-all">
                    Browse electronics
                </a>
            </div>
        </div>
    </div>
</section>

{{-- Categories --}}
<section class="max-w-7xl mx-auto px-4 sm:px-6 py-8">
    <h2 class="text-lg font-semibold text-white mb-4">Browse categories</h2>
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
        @foreach($categories as $category)
        <a href="{{ route('shop', ['category' => $category->slug]) }}"
           class="glass card-hover rounded-2xl px-5 py-4 group">
            <p class="font-semibold text-white text-sm group-hover:gradient-text transition-all">{{ $category->name }}</p>
            <p class="text-xs text-zinc-600 mt-0.5">{{ $category->products_count }} products</p>
        </a>
        @endforeach
    </div>
</section>

{{-- Featured products --}}
<section class="max-w-7xl mx-auto px-4 sm:px-6 py-8">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-lg font-semibold text-white">Featured products</h2>
        <a href="{{ route('shop') }}" class="text-sm text-violet-400 hover:text-violet-300 transition-colors">View all →</a>
    </div>
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
        @foreach($featured as $product)
            @include('shop.partials.product-card', ['product' => $product])
        @endforeach
    </div>
</section>

{{-- New arrivals --}}
@if($newArrivals->count())
<section class="max-w-7xl mx-auto px-4 sm:px-6 py-8">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-lg font-semibold text-white">New arrivals</h2>
    </div>
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
        @foreach($newArrivals as $product)
            @include('shop.partials.product-card', ['product' => $product])
        @endforeach
    </div>
</section>
@endif

{{-- Trust badges --}}
<section class="max-w-7xl mx-auto px-4 sm:px-6 py-12">
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
        @foreach([
            ['icon' => '🚚', 'title' => 'Free shipping', 'sub' => 'On orders over $50'],
            ['icon' => '🔒', 'title' => 'Secure checkout', 'sub' => 'Powered by Stripe'],
            ['icon' => '↩️', 'title' => '30-day returns', 'sub' => 'No questions asked'],
            ['icon' => '⭐', 'title' => '5-star support', 'sub' => '24/7 customer care'],
        ] as $badge)
        <div class="glass rounded-2xl p-4 text-center">
            <div class="text-2xl mb-2">{{ $badge['icon'] }}</div>
            <p class="text-sm font-medium text-white">{{ $badge['title'] }}</p>
            <p class="text-xs text-zinc-600 mt-0.5">{{ $badge['sub'] }}</p>
        </div>
        @endforeach
    </div>
</section>
@endsection
