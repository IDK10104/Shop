@extends('layouts.admin')
@section('title', 'Products')

@section('content')
<div class="flex items-center justify-between mb-6">
    <p class="text-sm text-zinc-500">{{ $products->total() }} products</p>
    <a href="{{ route('admin.products.create') }}"
       class="px-4 py-2 rounded-lg bg-gradient-to-r from-violet-600 to-indigo-600 text-white text-sm font-medium hover:opacity-90 transition-opacity">
        + Add product
    </a>
</div>

<div class="glass rounded-2xl overflow-hidden">
    <table class="w-full">
        <thead>
            <tr class="border-b border-white/[0.06]">
                <th class="text-left px-4 py-3 text-xs font-semibold text-zinc-500 uppercase tracking-wider">Product</th>
                <th class="text-left px-4 py-3 text-xs font-semibold text-zinc-500 uppercase tracking-wider hidden sm:table-cell">Category</th>
                <th class="text-left px-4 py-3 text-xs font-semibold text-zinc-500 uppercase tracking-wider">Price</th>
                <th class="text-left px-4 py-3 text-xs font-semibold text-zinc-500 uppercase tracking-wider hidden sm:table-cell">Stock</th>
                <th class="text-left px-4 py-3 text-xs font-semibold text-zinc-500 uppercase tracking-wider">Status</th>
                <th class="text-right px-4 py-3 text-xs font-semibold text-zinc-500 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-white/[0.04]">
            @foreach($products as $product)
            <tr class="hover:bg-white/[0.02] transition-colors">
                <td class="px-4 py-3">
                    <div class="flex items-center gap-3">
                        @if($product->image)
                            <img src="{{ $product->image }}" alt="" class="w-10 h-10 rounded-lg object-cover flex-shrink-0">
                        @else
                            <div class="w-10 h-10 rounded-lg bg-white/5 flex items-center justify-center text-lg flex-shrink-0">📦</div>
                        @endif
                        <div>
                            <p class="text-sm text-white font-medium line-clamp-1">{{ $product->name }}</p>
                            @if($product->badge)
                                <span class="text-xs text-violet-400">{{ $product->badge }}</span>
                            @endif
                        </div>
                    </div>
                </td>
                <td class="px-4 py-3 hidden sm:table-cell">
                    <span class="text-xs text-zinc-500">{{ $product->category?->name ?? '—' }}</span>
                </td>
                <td class="px-4 py-3">
                    <span class="text-sm text-white font-medium">{{ $product->price_formatted }}</span>
                    @if($product->compare_price_formatted)
                        <span class="text-xs text-zinc-600 line-through ml-1">{{ $product->compare_price_formatted }}</span>
                    @endif
                </td>
                <td class="px-4 py-3 hidden sm:table-cell">
                    <span class="text-sm {{ $product->stock > 10 ? 'text-emerald-400' : ($product->stock > 0 ? 'text-yellow-400' : 'text-red-400') }}">
                        {{ $product->stock }}
                    </span>
                </td>
                <td class="px-4 py-3">
                    <span class="text-xs px-2 py-1 rounded-full {{ $product->active ? 'bg-emerald-500/15 text-emerald-400 border border-emerald-500/25' : 'bg-zinc-800 text-zinc-500 border border-zinc-700' }}">
                        {{ $product->active ? 'Active' : 'Hidden' }}
                    </span>
                </td>
                <td class="px-4 py-3 text-right">
                    <div class="flex items-center justify-end gap-2">
                        <a href="{{ route('admin.products.edit', $product) }}"
                           class="text-xs px-2.5 py-1.5 rounded-lg bg-white/5 border border-white/10 text-zinc-400 hover:text-white transition-all">Edit</a>
                        <form action="{{ route('admin.products.destroy', $product) }}" method="POST"
                              onsubmit="return confirm('Delete {{ $product->name }}?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-xs px-2.5 py-1.5 rounded-lg bg-red-500/10 border border-red-500/20 text-red-400 hover:bg-red-500/20 transition-all">
                                Delete
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $products->links() }}</div>
@endsection
