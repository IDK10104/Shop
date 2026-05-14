@extends('layouts.admin')
@section('title', isset($product) ? 'Edit Product' : 'Add Product')

@section('content')
<div class="max-w-2xl">
    <form action="{{ isset($product) ? route('admin.products.update', $product) : route('admin.products.store') }}" method="POST">
        @csrf
        @if(isset($product)) @method('PUT') @endif

        <div class="glass rounded-2xl p-6 space-y-5">
            <div class="grid grid-cols-2 gap-4">
                <div class="col-span-2">
                    <label class="block text-xs font-medium text-zinc-500 mb-1.5">Product name *</label>
                    <input name="name" type="text" required value="{{ old('name', $product->name ?? '') }}"
                        placeholder="AirPods Pro"
                        class="w-full px-3.5 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white text-sm placeholder:text-zinc-700 focus:outline-none focus:border-violet-500/50 transition-all">
                </div>

                <div>
                    <label class="block text-xs font-medium text-zinc-500 mb-1.5">Price (USD) *</label>
                    <input name="price" type="number" step="0.01" min="0" required
                        value="{{ old('price', isset($product) ? $product->price / 100 : '') }}"
                        placeholder="99.00"
                        class="w-full px-3.5 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white text-sm placeholder:text-zinc-700 focus:outline-none focus:border-violet-500/50 transition-all">
                </div>

                <div>
                    <label class="block text-xs font-medium text-zinc-500 mb-1.5">Compare price (original)</label>
                    <input name="compare_price" type="number" step="0.01" min="0"
                        value="{{ old('compare_price', isset($product) && $product->compare_price ? $product->compare_price / 100 : '') }}"
                        placeholder="129.00"
                        class="w-full px-3.5 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white text-sm placeholder:text-zinc-700 focus:outline-none focus:border-violet-500/50 transition-all">
                </div>

                <div>
                    <label class="block text-xs font-medium text-zinc-500 mb-1.5">Category</label>
                    <select name="category_id" class="w-full px-3.5 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white text-sm focus:outline-none focus:border-violet-500/50 transition-all">
                        <option value="">None</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" @selected(old('category_id', $product->category_id ?? null) == $cat->id)>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-medium text-zinc-500 mb-1.5">Stock *</label>
                    <input name="stock" type="number" min="0" required
                        value="{{ old('stock', $product->stock ?? 0) }}"
                        class="w-full px-3.5 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white text-sm focus:outline-none focus:border-violet-500/50 transition-all">
                </div>

                <div>
                    <label class="block text-xs font-medium text-zinc-500 mb-1.5">Badge</label>
                    <select name="badge" class="w-full px-3.5 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white text-sm focus:outline-none focus:border-violet-500/50 transition-all">
                        <option value="">None</option>
                        @foreach(['New','Sale','Hot'] as $b)
                            <option value="{{ $b }}" @selected(old('badge', $product->badge ?? null) === $b)>{{ $b }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-medium text-zinc-500 mb-1.5">SKU</label>
                    <input name="sku" type="text" value="{{ old('sku', $product->sku ?? '') }}"
                        placeholder="SKU-001"
                        class="w-full px-3.5 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white text-sm placeholder:text-zinc-700 focus:outline-none focus:border-violet-500/50 transition-all">
                </div>

                <div class="col-span-2">
                    <label class="block text-xs font-medium text-zinc-500 mb-1.5">Image URL</label>
                    <input name="image" type="url" value="{{ old('image', $product->image ?? '') }}"
                        placeholder="https://images.unsplash.com/..."
                        class="w-full px-3.5 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white text-sm placeholder:text-zinc-700 focus:outline-none focus:border-violet-500/50 transition-all">
                </div>

                <div class="col-span-2">
                    <label class="block text-xs font-medium text-zinc-500 mb-1.5">Short description</label>
                    <input name="short_description" type="text" value="{{ old('short_description', $product->short_description ?? '') }}"
                        placeholder="One-line product summary"
                        class="w-full px-3.5 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white text-sm placeholder:text-zinc-700 focus:outline-none focus:border-violet-500/50 transition-all">
                </div>

                <div class="col-span-2">
                    <label class="block text-xs font-medium text-zinc-500 mb-1.5">Description</label>
                    <textarea name="description" rows="4" placeholder="Full product description..."
                        class="w-full px-3.5 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white text-sm placeholder:text-zinc-700 focus:outline-none focus:border-violet-500/50 transition-all resize-none">{{ old('description', $product->description ?? '') }}</textarea>
                </div>

                <div class="flex items-center gap-6">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="hidden" name="featured" value="0">
                        <input type="checkbox" name="featured" value="1" @checked(old('featured', $product->featured ?? false))
                            class="w-4 h-4 rounded accent-violet-500">
                        <span class="text-sm text-zinc-400">Featured</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="hidden" name="active" value="0">
                        <input type="checkbox" name="active" value="1" @checked(old('active', $product->active ?? true))
                            class="w-4 h-4 rounded accent-violet-500">
                        <span class="text-sm text-zinc-400">Active</span>
                    </label>
                </div>
            </div>

            <div class="flex gap-3 pt-2 border-t border-white/[0.06]">
                <a href="{{ route('admin.products.index') }}"
                   class="px-4 py-2.5 rounded-xl border border-white/10 text-zinc-400 text-sm hover:bg-white/5 transition-colors">
                    Cancel
                </a>
                <button type="submit"
                    class="px-6 py-2.5 rounded-xl bg-gradient-to-r from-violet-600 to-indigo-600 text-white text-sm font-medium hover:opacity-90 transition-opacity">
                    {{ isset($product) ? 'Save changes' : 'Create product' }}
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
