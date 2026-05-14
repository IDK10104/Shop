@extends('layouts.admin')
@section('title', 'Order #'.str_pad($order->id, 6, '0', STR_PAD_LEFT))

@section('content')
<div class="max-w-2xl space-y-4">
    <div class="glass rounded-2xl p-5">
        <div class="flex items-center justify-between mb-4">
            <h2 class="font-semibold text-white">Order details</h2>
            <form action="{{ route('admin.orders.status', $order) }}" method="POST" class="flex items-center gap-2">
                @csrf @method('PATCH')
                <select name="status" class="px-3 py-1.5 rounded-lg bg-white/5 border border-white/10 text-sm text-white focus:outline-none focus:border-violet-500/50">
                    @foreach(['pending','paid','shipped','delivered','cancelled'] as $s)
                        <option value="{{ $s }}" @selected($order->status === $s)>{{ ucfirst($s) }}</option>
                    @endforeach
                </select>
                <button type="submit" class="px-3 py-1.5 rounded-lg bg-violet-600 hover:bg-violet-500 text-white text-sm transition-colors">Update</button>
            </form>
        </div>
        <div class="grid grid-cols-2 gap-3 text-sm">
            <div><p class="text-zinc-600 text-xs mb-0.5">Customer</p><p class="text-white">{{ $order->customer_name }}</p></div>
            <div><p class="text-zinc-600 text-xs mb-0.5">Email</p><p class="text-white">{{ $order->customer_email }}</p></div>
            <div><p class="text-zinc-600 text-xs mb-0.5">Date</p><p class="text-white">{{ $order->created_at->format('M d, Y H:i') }}</p></div>
            <div><p class="text-zinc-600 text-xs mb-0.5">Total</p><p class="text-white font-bold">{{ $order->total_formatted }}</p></div>
        </div>
    </div>

    <div class="glass rounded-2xl p-5">
        <h2 class="font-semibold text-white mb-4">Items</h2>
        <div class="space-y-3">
            @foreach($order->items as $item)
            <div class="flex items-center gap-3 py-2 border-b border-white/[0.04] last:border-0">
                @if($item->product?->image)
                    <img src="{{ $item->product->image }}" alt="" class="w-12 h-12 rounded-lg object-cover flex-shrink-0">
                @else
                    <div class="w-12 h-12 rounded-lg bg-white/5 flex items-center justify-center text-lg flex-shrink-0">📦</div>
                @endif
                <div class="flex-1">
                    <p class="text-sm text-white font-medium">{{ $item->product_name }}</p>
                    <p class="text-xs text-zinc-600">Qty: {{ $item->quantity }} × ${{ number_format($item->price / 100, 2) }}</p>
                </div>
                <p class="text-sm text-white font-bold">${{ number_format($item->line_total / 100, 2) }}</p>
            </div>
            @endforeach
        </div>
    </div>

    <a href="{{ route('admin.orders.index') }}" class="inline-block text-sm text-zinc-500 hover:text-zinc-300 transition-colors">← Back to orders</a>
</div>
@endsection
