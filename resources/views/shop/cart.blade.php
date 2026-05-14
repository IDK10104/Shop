@extends('layouts.app')
@section('title', 'Cart')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 py-10">
    <h1 class="text-2xl font-bold text-white mb-8">Shopping Cart</h1>

    @if($items->isEmpty())
        <div class="text-center py-20 glass rounded-2xl">
            <p class="text-5xl mb-4">🛒</p>
            <p class="text-zinc-400 text-lg font-medium mb-2">Your cart is empty</p>
            <p class="text-zinc-600 text-sm mb-6">Looks like you haven't added anything yet.</p>
            <a href="{{ route('shop') }}" class="inline-flex px-5 py-2.5 rounded-xl bg-gradient-to-r from-violet-600 to-indigo-600 text-white font-medium text-sm hover:opacity-90 transition-opacity">
                Browse products →
            </a>
        </div>
    @else
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            {{-- Cart items --}}
            <div class="lg:col-span-2 space-y-3">
                @foreach($items as $item)
                <div class="glass rounded-2xl p-4 flex items-center gap-4">
                    @if($item->product->image)
                        <img src="{{ $item->product->image }}" alt="{{ $item->product->name }}" class="w-20 h-20 rounded-xl object-cover flex-shrink-0">
                    @else
                        <div class="w-20 h-20 rounded-xl bg-white/5 flex items-center justify-center text-2xl flex-shrink-0">📦</div>
                    @endif
                    <div class="flex-1 min-w-0">
                        <a href="{{ route('product', $item->product->slug) }}" class="font-semibold text-white text-sm hover:text-violet-400 transition-colors line-clamp-1">
                            {{ $item->product->name }}
                        </a>
                        <p class="text-xs text-zinc-600 mt-0.5">{{ $item->product->price_formatted }} each</p>
                        <div class="flex items-center gap-3 mt-3">
                            <form action="{{ route('cart.update', $item) }}" method="POST" class="flex items-center gap-2">
                                @csrf @method('PATCH')
                                <input type="number" name="quantity" value="{{ $item->quantity }}" min="0" max="{{ $item->product->stock }}"
                                    class="w-16 px-2 py-1 rounded-lg bg-white/5 border border-white/10 text-white text-center text-sm focus:outline-none focus:border-violet-500/50"
                                    onchange="this.form.submit()">
                            </form>
                            <form action="{{ route('cart.remove', $item) }}" method="POST">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-xs text-zinc-600 hover:text-red-400 transition-colors">Remove</button>
                            </form>
                        </div>
                    </div>
                    <div class="text-right flex-shrink-0">
                        <p class="font-bold text-white text-sm">${{ number_format($item->line_total / 100, 2) }}</p>
                    </div>
                </div>
                @endforeach
            </div>

            {{-- Summary --}}
            <div class="lg:col-span-1">
                <div class="glass rounded-2xl p-5 sticky top-20">
                    <h2 class="font-semibold text-white mb-4">Order Summary</h2>
                    <div class="space-y-2 mb-4">
                        <div class="flex justify-between text-sm">
                            <span class="text-zinc-500">Subtotal</span>
                            <span class="text-white">${{ number_format($total / 100, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-zinc-500">Shipping</span>
                            <span class="text-emerald-400">Free</span>
                        </div>
                    </div>
                    <div class="border-t border-white/[0.06] pt-4 mb-5">
                        <div class="flex justify-between font-bold">
                            <span class="text-white">Total</span>
                            <span class="text-white text-lg">${{ number_format($total / 100, 2) }}</span>
                        </div>
                    </div>
                    <a href="{{ route('checkout') }}"
                       class="block w-full text-center py-3 rounded-xl bg-gradient-to-r from-violet-600 to-indigo-600 text-white font-semibold text-sm hover:opacity-90 transition-opacity shadow-lg shadow-violet-500/20">
                        Proceed to checkout →
                    </a>
                    <a href="{{ route('shop') }}" class="block text-center text-xs text-zinc-600 hover:text-zinc-400 transition-colors mt-3">
                        Continue shopping
                    </a>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
