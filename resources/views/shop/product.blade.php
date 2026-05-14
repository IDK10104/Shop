@extends('layouts.app')
@section('title', $product->name)

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 py-10">
    {{-- Breadcrumb --}}
    <nav class="flex items-center gap-2 text-xs text-zinc-600 mb-8">
        <a href="{{ route('home') }}" class="hover:text-zinc-400">Home</a>
        <span>/</span>
        <a href="{{ route('shop') }}" class="hover:text-zinc-400">Shop</a>
        @if($product->category)
            <span>/</span>
            <a href="{{ route('shop', ['category' => $product->category->slug]) }}" class="hover:text-zinc-400">{{ $product->category->name }}</a>
        @endif
        <span>/</span>
        <span class="text-zinc-400">{{ $product->name }}</span>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
        {{-- Image --}}
        <div class="relative">
            @if($product->image)
                <div class="aspect-square rounded-2xl overflow-hidden border border-white/10 bg-white/3">
                    <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                </div>
            @else
                <div class="aspect-square rounded-2xl bg-white/5 border border-white/10 flex items-center justify-center text-6xl">📦</div>
            @endif
            @if($product->badge)
                <span class="absolute top-4 left-4 text-sm font-semibold px-3 py-1.5 rounded-full
                    @if($product->badge === 'Sale') bg-red-500/20 text-red-400 border border-red-500/30
                    @elseif($product->badge === 'New') bg-emerald-500/20 text-emerald-400 border border-emerald-500/30
                    @else bg-orange-500/20 text-orange-400 border border-orange-500/30 @endif">
                    {{ $product->badge }}
                </span>
            @endif
        </div>

        {{-- Details --}}
        <div class="flex flex-col">
            @if($product->category)
                <p class="text-sm text-violet-400 mb-2">{{ $product->category->name }}</p>
            @endif
            <h1 class="text-3xl font-bold text-white mb-3 leading-tight">{{ $product->name }}</h1>

            @if($product->short_description)
                <p class="text-zinc-400 text-base mb-6">{{ $product->short_description }}</p>
            @endif

            {{-- Price --}}
            <div class="flex items-center gap-3 mb-6">
                <span class="text-4xl font-bold text-white">{{ $product->price_formatted }}</span>
                @if($product->compare_price_formatted)
                    <span class="text-xl text-zinc-600 line-through">{{ $product->compare_price_formatted }}</span>
                    <span class="px-2 py-1 rounded-lg bg-red-500/15 text-red-400 text-sm font-semibold border border-red-500/25">
                        Save {{ $product->discount_percent }}%
                    </span>
                @endif
            </div>

            {{-- Stock --}}
            <div class="flex items-center gap-2 mb-6">
                @if($product->stock > 10)
                    <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                    <span class="text-sm text-emerald-400">In stock</span>
                @elseif($product->stock > 0)
                    <span class="w-2 h-2 rounded-full bg-yellow-400"></span>
                    <span class="text-sm text-yellow-400">Only {{ $product->stock }} left</span>
                @else
                    <span class="w-2 h-2 rounded-full bg-red-400"></span>
                    <span class="text-sm text-red-400">Out of stock</span>
                @endif
            </div>

            {{-- Add to cart --}}
            <form action="{{ route('cart.add', $product) }}" method="POST" class="flex gap-3 mb-8">
                @csrf
                <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}"
                    class="w-20 px-3 py-3 rounded-xl bg-white/5 border border-white/10 text-white text-center text-sm focus:outline-none focus:border-violet-500/50">
                <button type="submit" @if($product->stock === 0) disabled @endif
                    class="flex-1 py-3 rounded-xl bg-gradient-to-r from-violet-600 to-indigo-600 text-white font-semibold text-sm hover:opacity-90 disabled:opacity-40 disabled:cursor-not-allowed transition-opacity shadow-lg shadow-violet-500/20">
                    Add to cart
                </button>
            </form>

            {{-- Description --}}
            @if($product->description)
                <div class="border-t border-white/[0.06] pt-6">
                    <h3 class="text-sm font-semibold text-zinc-400 uppercase tracking-wider mb-3">Description</h3>
                    <p class="text-zinc-400 text-sm leading-relaxed">{{ $product->description }}</p>
                </div>
            @endif

            {{-- Meta --}}
            @if($product->sku)
                <p class="text-xs text-zinc-700 mt-4">SKU: {{ $product->sku }}</p>
            @endif
        </div>
    </div>

    {{-- Related --}}
    @if($related->count())
    <div class="mt-16">
        <h2 class="text-lg font-semibold text-white mb-6">You might also like</h2>
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
            @foreach($related as $p)
                @include('shop.partials.product-card', ['product' => $p])
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection
