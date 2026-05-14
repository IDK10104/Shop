@extends('layouts.admin')
@section('title', 'Orders')

@section('content')
<div class="grid grid-cols-2 sm:grid-cols-4 gap-3 mb-6">
    @foreach([
        ['label' => 'Total orders', 'value' => $stats['total'], 'color' => 'text-white'],
        ['label' => 'Revenue', 'value' => '$'.number_format($stats['revenue']/100, 2), 'color' => 'text-emerald-400'],
        ['label' => 'Paid', 'value' => $stats['paid'], 'color' => 'text-violet-400'],
        ['label' => 'Pending', 'value' => $stats['pending'], 'color' => 'text-yellow-400'],
    ] as $s)
    <div class="glass rounded-xl p-4">
        <p class="text-xs text-zinc-600 mb-1">{{ $s['label'] }}</p>
        <p class="text-2xl font-bold {{ $s['color'] }}">{{ $s['value'] }}</p>
    </div>
    @endforeach
</div>

<div class="glass rounded-2xl overflow-hidden">
    <table class="w-full">
        <thead>
            <tr class="border-b border-white/[0.06]">
                <th class="text-left px-4 py-3 text-xs font-semibold text-zinc-500 uppercase tracking-wider">Order</th>
                <th class="text-left px-4 py-3 text-xs font-semibold text-zinc-500 uppercase tracking-wider hidden sm:table-cell">Customer</th>
                <th class="text-left px-4 py-3 text-xs font-semibold text-zinc-500 uppercase tracking-wider">Total</th>
                <th class="text-left px-4 py-3 text-xs font-semibold text-zinc-500 uppercase tracking-wider">Status</th>
                <th class="text-right px-4 py-3 text-xs font-semibold text-zinc-500 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-white/[0.04]">
            @forelse($orders as $order)
            <tr class="hover:bg-white/[0.02] transition-colors">
                <td class="px-4 py-3">
                    <p class="text-sm text-white font-mono">#{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</p>
                    <p class="text-xs text-zinc-600">{{ $order->created_at->format('M d, Y') }}</p>
                </td>
                <td class="px-4 py-3 hidden sm:table-cell">
                    <p class="text-sm text-white">{{ $order->customer_name }}</p>
                    <p class="text-xs text-zinc-600">{{ $order->customer_email }}</p>
                </td>
                <td class="px-4 py-3">
                    <span class="text-sm font-bold text-white">{{ $order->total_formatted }}</span>
                </td>
                <td class="px-4 py-3">
                    <span class="text-xs px-2 py-1 rounded-full font-medium
                        @if($order->status === 'paid') bg-emerald-500/15 text-emerald-400 border border-emerald-500/25
                        @elseif($order->status === 'shipped') bg-blue-500/15 text-blue-400 border border-blue-500/25
                        @elseif($order->status === 'pending') bg-yellow-500/15 text-yellow-400 border border-yellow-500/25
                        @elseif($order->status === 'cancelled') bg-red-500/15 text-red-400 border border-red-500/25
                        @else bg-zinc-800 text-zinc-400 border border-zinc-700 @endif">
                        {{ ucfirst($order->status) }}
                    </span>
                </td>
                <td class="px-4 py-3 text-right">
                    <a href="{{ route('admin.orders.show', $order) }}"
                       class="text-xs px-2.5 py-1.5 rounded-lg bg-white/5 border border-white/10 text-zinc-400 hover:text-white transition-all">
                        View
                    </a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center py-12 text-zinc-600 text-sm">No orders yet.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $orders->links() }}</div>
@endsection
