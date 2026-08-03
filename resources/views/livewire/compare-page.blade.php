<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-800 dark:text-slate-100">Product Comparison</h1>
            <p class="text-slate-500 text-sm mt-1">Compare specifications, prices, and ratings side-by-side</p>
        </div>
        @if(count($comparedIds) > 0)
            <button wire:click="clearComparison" class="text-xs bg-red-100 text-red-700 dark:bg-red-900/50 dark:text-red-300 font-bold px-4 py-2 rounded-lg">
                Clear All Comparison Items
            </button>
        @endif
    </div>

    @if($products->isEmpty())
        <div class="text-center py-20 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl shadow-sm">
            <span class="text-5xl block mb-4">⚖️</span>
            <h3 class="text-xl font-bold text-slate-800 dark:text-slate-200 mb-2">No products added for comparison</h3>
            <p class="text-sm text-slate-500 mb-6">Click the compare icon on any product card to add items here.</p>
            <a href="/products" class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-6 py-3 rounded-xl text-sm transition-colors">
                Browse Catalog →
            </a>
        </div>
    @else
        <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl shadow-sm overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-800/50">
                        <th class="p-4 w-48 text-xs font-bold text-slate-400 uppercase">Specs / Product</th>
                        @foreach($products as $prod)
                            <th class="p-4 min-w-[220px]">
                                <div class="relative">
                                    <button wire:click="removeProduct({{ $prod->id }})" class="absolute -top-2 -right-2 text-slate-400 hover:text-red-500 font-bold">✕</button>
                                    <img src="{{ is_array($prod->images) && count($prod->images) > 0 ? url('storage/' . $prod->images[0]) : 'https://via.placeholder.com/150' }}" class="w-24 h-24 object-cover rounded-lg mb-2 mx-auto">
                                    <h4 class="font-bold text-sm text-slate-800 dark:text-slate-200 text-center line-clamp-1">{{ $prod->name }}</h4>
                                </div>
                            </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800 text-sm">
                    <tr>
                        <td class="p-4 font-bold text-slate-500">Price</td>
                        @foreach($products as $prod)
                            <td class="p-4 font-black text-blue-600">${{ number_format($prod->price, 2) }}</td>
                        @endforeach
                    </tr>
                    <tr>
                        <td class="p-4 font-bold text-slate-500">Category</td>
                        @foreach($products as $prod)
                            <td class="p-4 text-slate-700 dark:text-slate-300 font-semibold">{{ $prod->category->name ?? 'General' }}</td>
                        @endforeach
                    </tr>
                    <tr>
                        <td class="p-4 font-bold text-slate-500">Brand</td>
                        @foreach($products as $prod)
                            <td class="p-4 text-slate-700 dark:text-slate-300 font-semibold">{{ $prod->brand->name ?? '-' }}</td>
                        @endforeach
                    </tr>
                    <tr>
                        <td class="p-4 font-bold text-slate-500">Rating</td>
                        @foreach($products as $prod)
                            <td class="p-4"><x-rating-stars :rating="$prod->average_rating" /></td>
                        @endforeach
                    </tr>
                    <tr>
                        <td class="p-4 font-bold text-slate-500">Stock Status</td>
                        @foreach($products as $prod)
                            <td class="p-4 font-semibold {{ $prod->in_stock ? 'text-green-600' : 'text-red-500' }}">
                                {{ $prod->in_stock ? 'In Stock' : 'Out of Stock' }}
                            </td>
                        @endforeach
                    </tr>
                    <tr>
                        <td class="p-4 font-bold text-slate-500">Action</td>
                        @foreach($products as $prod)
                            <td class="p-4">
                                <a href="/products/{{ $prod->id }}" class="block text-center bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 rounded-lg text-xs">
                                    View Details
                                </a>
                            </td>
                        @endforeach
                    </tr>
                </tbody>
            </table>
        </div>
    @endif
</div>
