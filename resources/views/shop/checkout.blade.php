@extends('layouts.app')
@section('title', 'Checkout')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 py-10">
    <h1 class="text-2xl font-bold text-white mb-8">Checkout</h1>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        {{-- Form --}}
        <div>
            <div class="glass rounded-2xl p-6">
                <h2 class="font-semibold text-white mb-5">Your details</h2>
                <form action="{{ route('checkout.create') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-xs font-medium text-zinc-500 mb-1.5">Full name</label>
                        <input name="name" type="text" required value="{{ old('name') }}"
                            placeholder="John Doe"
                            class="w-full px-3.5 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white text-sm placeholder:text-zinc-700 focus:outline-none focus:border-violet-500/50 focus:ring-1 focus:ring-violet-500/20 transition-all">
                        @error('name') <p class="text-xs text-red-400 mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-zinc-500 mb-1.5">Email</label>
                        <input name="email" type="email" required value="{{ old('email') }}"
                            placeholder="you@example.com"
                            class="w-full px-3.5 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white text-sm placeholder:text-zinc-700 focus:outline-none focus:border-violet-500/50 focus:ring-1 focus:ring-violet-500/20 transition-all">
                        @error('email') <p class="text-xs text-red-400 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="border-t border-white/[0.06] pt-4 mt-4">
                        <div class="flex items-center gap-3 p-3 rounded-xl bg-violet-500/10 border border-violet-500/20 mb-4">
                            <span class="text-lg">🔒</span>
                            <p class="text-xs text-zinc-400">You'll be securely redirected to Stripe to complete payment.</p>
                        </div>
                        <button type="submit" class="w-full py-3 rounded-xl bg-gradient-to-r from-violet-600 to-indigo-600 text-white font-semibold text-sm hover:opacity-90 transition-opacity shadow-lg shadow-violet-500/20">
                            Pay ${{ number_format($total / 100, 2) }} with Stripe →
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Order summary --}}
        <div>
            <div class="glass rounded-2xl p-5">
                <h2 class="font-semibold text-white mb-4">Order Summary</h2>
                <div class="space-y-3 mb-4">
                    @foreach($items as $item)
                    <div class="flex items-center gap-3">
                        @if($item->product->image)
                            <img src="{{ $item->product->image }}" alt="{{ $item->product->name }}" class="w-12 h-12 rounded-lg object-cover flex-shrink-0">
                        @endif
                        <div class="flex-1 min-w-0">
                            <p class="text-sm text-white font-medium line-clamp-1">{{ $item->product->name }}</p>
                            <p class="text-xs text-zinc-600">Qty: {{ $item->quantity }}</p>
                        </div>
                        <p class="text-sm text-white font-medium">${{ number_format($item->line_total / 100, 2) }}</p>
                    </div>
                    @endforeach
                </div>
                <div class="border-t border-white/[0.06] pt-4">
                    <div class="flex justify-between items-center">
                        <span class="font-bold text-white">Total</span>
                        <span class="font-bold text-white text-lg">${{ number_format($total / 100, 2) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
