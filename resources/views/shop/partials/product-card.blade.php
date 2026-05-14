<div class="group glass card-hover rounded-2xl overflow-hidden border border-white/[0.07]">
    <a href="{{ route('product', $product->slug) }}" class="block relative">
        @if($product->image)
            <img src="{{ $product->image }}" alt="{{ $product->name }}"
                 class="w-full aspect-square object-cover group-hover:scale-105 transition-transform duration-500">
        @else
            <div class="w-full aspect-square bg-white/5 flex items-center justify-center text-zinc-700 text-4xl">📦</div>
        @endif
        @if($product->badge)
            <span class="absolute top-3 left-3 text-xs font-semibold px-2 py-1 rounded-full
                @if($product->badge === 'Sale') bg-red-500/20 text-red-400 border border-red-500/30
                @elseif($product->badge === 'New') bg-emerald-500/20 text-emerald-400 border border-emerald-500/30
                @else bg-orange-500/20 text-orange-400 border border-orange-500/30 @endif">
                {{ $product->badge }}
            </span>
        @endif
        @if($product->discount_percent)
            <span class="absolute top-3 right-3 text-xs font-bold px-2 py-1 rounded-full bg-violet-500/20 text-violet-400 border border-violet-500/30">
                -{{ $product->discount_percent }}%
            </span>
        @endif
    </a>
    <div class="p-4">
        @if($product->category)
            <p class="text-xs text-zinc-600 mb-1">{{ $product->category->name }}</p>
        @endif
        <a href="{{ route('product', $product->slug) }}" class="block font-semibold text-white text-sm leading-snug hover:text-violet-400 transition-colors mb-1 line-clamp-2">
            {{ $product->name }}
        </a>
        @if($product->short_description)
            <p class="text-xs text-zinc-500 line-clamp-2 mb-3">{{ $product->short_description }}</p>
        @endif
        <div class="flex items-center justify-between mt-auto">
            <div>
                <span class="font-bold text-white text-sm">{{ $product->price_formatted }}</span>
                @if($product->compare_price_formatted)
                    <span class="text-xs text-zinc-600 line-through ml-1">{{ $product->compare_price_formatted }}</span>
                @endif
            </div>
            <form action="{{ route('cart.add', $product) }}" method="POST">
                @csrf
                <button type="submit" class="text-xs px-3 py-1.5 rounded-lg bg-violet-600 hover:bg-violet-500 text-white font-medium transition-colors">
                    Add
                </button>
            </form>
        </div>
    </div>
</div>
