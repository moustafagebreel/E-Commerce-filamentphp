<footer class="bg-slate-900 text-slate-300 mt-auto py-14 px-4">
    <div class="max-w-[85rem] mx-auto">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-10 mb-12">

            <!-- Brand -->
            <div>
                <h3 class="text-xl font-black text-white mb-4">⚡ Apex Store</h3>
                <p class="text-sm leading-relaxed text-slate-400">
                    Your premium destination for quality products at unbeatable prices. Shop with confidence.
                </p>
            </div>

            <!-- Shop -->
            <div>
                <h4 class="font-bold text-white mb-4 text-sm uppercase tracking-widest">Shop</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="/products" class="hover:text-white transition-colors">All Products</a></li>
                    <li><a href="/new-arrivals" class="hover:text-white transition-colors">New Arrivals</a></li>
                    <li><a href="/trending" class="hover:text-white transition-colors">Trending</a></li>
                    <li><a href="/sale" class="hover:text-white transition-colors">Sale Items</a></li>
                    <li><a href="/compare" class="hover:text-white transition-colors">Compare Products</a></li>
                </ul>
            </div>

            <!-- Customer -->
            <div>
                <h4 class="font-bold text-white mb-4 text-sm uppercase tracking-widest">Customer</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="/dashboard" class="hover:text-white transition-colors">My Dashboard</a></li>
                    <li><a href="/my-orders" class="hover:text-white transition-colors">My Orders</a></li>
                    <li><a href="/wishlist" class="hover:text-white transition-colors">Wishlist</a></li>
                    <li><a href="/wallet" class="hover:text-white transition-colors">Wallet & Rewards</a></li>
                    <li><a href="/track-order" class="hover:text-white transition-colors">Track Order</a></li>
                </ul>
            </div>

            <!-- Help -->
            <div>
                <h4 class="font-bold text-white mb-4 text-sm uppercase tracking-widest">Help</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="/faq" class="hover:text-white transition-colors">FAQ</a></li>
                    <li><a href="/contact" class="hover:text-white transition-colors">Contact Us</a></li>
                    <li><a href="/policies" class="hover:text-white transition-colors">Store Policies</a></li>
                    <li><a href="/policies#refund" class="hover:text-white transition-colors">Refund Policy</a></li>
                    <li><a href="/policies#privacy" class="hover:text-white transition-colors">Privacy Policy</a></li>
                </ul>
            </div>
        </div>

        <div class="border-t border-slate-800 pt-8 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-slate-500">
            <p>© {{ date('Y') }} Apex E-Commerce Store. All rights reserved.</p>
            <div class="flex items-center gap-4">
                <span>🔒 Secure Checkout</span>
                <span>📦 Free Shipping</span>
                <span>🔄 Easy Returns</span>
            </div>
        </div>
    </div>
</footer>
