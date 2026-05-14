@extends('layouts.app')
@section('title', 'Order #'.str_pad($order->id, 6, '0', STR_PAD_LEFT))

@section('content')
<div class="max-w-2xl mx-auto px-4 sm:px-6 py-10">
    <a href="{{ route('account.orders') }}" class="text-sm text-zinc-500 hover:text-zinc-300 transition-colors inline-block mb-6">← My Orders</a>

    <div class="glass rounded-2xl p-6 mb-4">
        <div class="flex items-start justify-between mb-5">
            <div>
                <p class="text-xs text-zinc-600 mb-1">Order</p>
                <p class="text-xl font-bold text-white font-mono">#{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</p>
            </div>
            <span class="text-sm px-3 py-1.5 rounded-full font-medium
                @if($order->status === 'paid') bg-emerald-500/15 text-emerald-400 border border-emerald-500/25
                @elseif($order->status === 'shipped') bg-blue-500/15 text-blue-400 border border-blue-500/25
                @elseif($order->status === 'delivered') bg-violet-500/15 text-violet-400 border border-violet-500/25
                @else bg-yellow-500/15 text-yellow-400 border border-yellow-500/25 @endif">
                {{ ucfirst($order->status) }}
            </span>
        </div>

        <div class="grid grid-cols-2 gap-3 text-sm mb-5">
            <div><p class="text-zinc-600 text-xs mb-0.5">Date</p><p class="text-white">{{ $order->created_at->format('M d, Y H:i') }}</p></div>
            <div><p class="text-zinc-600 text-xs mb-0.5">Total</p><p class="text-white font-bold text-lg">{{ $order->total_formatted }}</p></div>
        </div>

        <div class="border-t border-white/[0.06] pt-5 space-y-3">
            @foreach($order->items as $item)
            <div class="flex items-center gap-3">
                @if($item->product?->image)
                    <img src="{{ $item->product->image }}" alt="" class="w-14 h-14 rounded-xl object-cover flex-shrink-0">
                @else
                    <div class="w-14 h-14 rounded-xl bg-white/5 flex items-center justify-center text-xl flex-shrink-0">📦</div>
                @endif
                <div class="flex-1">
                    <p class="text-sm text-white font-medium">{{ $item->product_name }}</p>
                    <p class="text-xs text-zinc-600">Qty: {{ $item->quantity }} × ${{ number_format($item->price / 100, 2) }}</p>
                </div>
                <p class="font-bold text-white text-sm">${{ number_format($item->line_total / 100, 2) }}</p>
            </div>
            @endforeach
        </div>
    </div>

    <a href="{{ route('shop') }}" class="block text-center py-3 rounded-xl bg-white/5 border border-white/10 text-zinc-400 text-sm hover:text-white hover:bg-white/10 transition-all">
        Continue shopping →
    </a>
</div>
@endsection
