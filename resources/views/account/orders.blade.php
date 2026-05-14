@extends('layouts.app')
@section('title', 'My Orders')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 py-10">
    <h1 class="text-2xl font-bold text-white mb-2">My Orders</h1>
    <p class="text-zinc-500 text-sm mb-8">Signed in as {{ auth()->user()->email }}</p>

    @if($orders->isEmpty())
        <div class="glass rounded-2xl p-12 text-center">
            <p class="text-4xl mb-4">📦</p>
            <p class="text-zinc-400 font-medium mb-1">No orders yet</p>
            <p class="text-zinc-600 text-sm mb-6">Your order history will appear here after you make a purchase.</p>
            <a href="{{ route('shop') }}" class="inline-flex px-5 py-2.5 rounded-xl bg-gradient-to-r from-violet-600 to-indigo-600 text-white font-medium text-sm hover:opacity-90 transition-opacity">
                Start shopping →
            </a>
        </div>
    @else
        <div class="space-y-3">
            @foreach($orders as $order)
            <a href="{{ route('account.orders.show', $order) }}"
               class="block glass card-hover rounded-2xl p-5 border border-white/[0.07]">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <p class="text-sm font-mono font-semibold text-white">
                            #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}
                        </p>
                        <p class="text-xs text-zinc-600 mt-0.5">{{ $order->created_at->format('M d, Y') }}</p>
                        <p class="text-xs text-zinc-500 mt-2">
                            {{ $order->items->count() }} item{{ $order->items->count() !== 1 ? 's' : '' }}:
                            {{ $order->items->pluck('product_name')->join(', ') }}
                        </p>
                    </div>
                    <div class="text-right flex-shrink-0">
                        <p class="font-bold text-white text-lg">{{ $order->total_formatted }}</p>
                        <span class="inline-block mt-1 text-xs px-2.5 py-1 rounded-full font-medium
                            @if($order->status === 'paid') bg-emerald-500/15 text-emerald-400 border border-emerald-500/25
                            @elseif($order->status === 'shipped') bg-blue-500/15 text-blue-400 border border-blue-500/25
                            @elseif($order->status === 'delivered') bg-violet-500/15 text-violet-400 border border-violet-500/25
                            @elseif($order->status === 'pending') bg-yellow-500/15 text-yellow-400 border border-yellow-500/25
                            @else bg-zinc-800 text-zinc-500 border border-zinc-700 @endif">
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    @endif
</div>
@endsection
