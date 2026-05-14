@extends('layouts.app')
@section('title', 'Shop')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 py-10">
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl font-bold text-white">All Products</h1>
            <p class="text-zinc-500 text-sm mt-1">{{ $products->total() }} products found</p>
        </div>
        {{-- Filters --}}
        <form method="GET" action="{{ route('shop') }}" class="flex flex-wrap gap-2">
            @if(request('search'))
                <input type="hidden" name="search" value="{{ request('search') }}">
            @endif
            <select name="category" onchange="this.form.submit()"
                class="px-3 py-2 rounded-lg bg-white/5 border border-white/10 text-sm text-zinc-300 focus:outline-none focus:border-violet-500/50">
                <option value="">All categories</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->slug }}" @selected(request('category') === $cat->slug)>{{ $cat->name }}</option>
                @endforeach
            </select>
            <select name="sort" onchange="this.form.submit()"
                class="px-3 py-2 rounded-lg bg-white/5 border border-white/10 text-sm text-zinc-300 focus:outline-none focus:border-violet-500/50">
                <option value="">Newest</option>
                <option value="price_asc" @selected(request('sort') === 'price_asc')>Price: Low to High</option>
                <option value="price_desc" @selected(request('sort') === 'price_desc')>Price: High to Low</option>
            </select>
        </form>
    </div>

    @if($products->isEmpty())
        <div class="text-center py-20">
            <p class="text-zinc-600 text-4xl mb-4">🔍</p>
            <p class="text-zinc-400 text-sm">No products found. <a href="{{ route('shop') }}" class="text-violet-400 hover:underline">Clear filters</a></p>
        </div>
    @else
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach($products as $product)
                @include('shop.partials.product-card', ['product' => $product])
            @endforeach
        </div>
        <div class="mt-8">{{ $products->appends(request()->query())->links() }}</div>
    @endif
</div>
@endsection
