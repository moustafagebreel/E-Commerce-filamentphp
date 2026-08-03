<div class="w-full max-w-[85rem] py-12 px-4 sm:px-6 lg:px-8 mx-auto">
    <h1 class="text-3xl font-extrabold text-slate-800 dark:text-slate-100 mb-8">Store Policies</h1>

    <!-- Tab Navigation -->
    <div class="flex space-x-2 mb-8 border-b border-slate-200 dark:border-slate-800">
        @foreach(['terms' => 'Terms of Service', 'refund' => 'Refund Policy', 'privacy' => 'Privacy Policy', 'shipping' => 'Shipping Policy'] as $key => $label)
            <button
                wire:click="setTab('{{ $key }}')"
                class="px-5 py-3 text-sm font-bold border-b-2 transition-colors
                    {{ $activeTab === $key ? 'border-blue-600 text-blue-600' : 'border-transparent text-slate-500 hover:text-slate-700 dark:hover:text-slate-300' }}"
            >
                {{ $label }}
            </button>
        @endforeach
    </div>

    <!-- Content Area -->
    <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl p-8 shadow-sm prose prose-slate dark:prose-invert max-w-none">
        @if($activeTab === 'terms')
            <h2>Terms of Service</h2>
            <p>By accessing and placing an order with Apex E-Commerce Store, you confirm that you are in agreement with and bound by the terms of service contained in the Terms & Conditions outlined below.</p>
            <h3>1. Eligibility</h3>
            <p>You must be at least 18 years old to use our services and make purchases from our store.</p>
            <h3>2. Product Information</h3>
            <p>We strive to display product details as accurately as possible. Colors and measurements may vary from the actual product due to screen calibration differences.</p>
            <h3>3. Pricing</h3>
            <p>All prices are listed in USD. We reserve the right to modify prices at any time without prior notice.</p>
            <h3>4. Order Acceptance</h3>
            <p>We reserve the right to refuse or cancel any order for any reason, including limitations on quantities and inaccuracies in product or pricing information.</p>
        @elseif($activeTab === 'refund')
            <h2>Refund & Return Policy</h2>
            <p>We offer a 30-day return policy for all eligible items. Items must be in original condition, unused, and in original packaging.</p>
            <h3>How to Initiate a Return</h3>
            <p>Log in to your account and navigate to "My Orders". Select the order you wish to return and click "Request Refund". Our team will review your request within 2-3 business days.</p>
            <h3>Non-Returnable Items</h3>
            <p>Digital downloads, personal care items, and custom-made products are not eligible for return or refund.</p>
            <h3>Refund Processing</h3>
            <p>Once your return is approved, refunds are processed within 5-7 business days to your original payment method.</p>
        @elseif($activeTab === 'privacy')
            <h2>Privacy Policy</h2>
            <p>Your privacy is important to us. This Privacy Policy explains how we collect, use, disclose, and safeguard your information.</p>
            <h3>Information We Collect</h3>
            <p>We collect information you provide directly to us including name, email address, shipping address, and payment information when you make a purchase.</p>
            <h3>How We Use Your Information</h3>
            <p>We use your information to process orders, send transactional emails, improve our service, and to send promotional communications (with your consent).</p>
            <h3>Data Security</h3>
            <p>We implement industry-standard security measures to protect your personal information from unauthorized access, disclosure, or destruction.</p>
        @elseif($activeTab === 'shipping')
            <h2>Shipping Policy</h2>
            <p>We offer a range of domestic and international shipping options at checkout. Shipping times and costs vary based on your selected delivery zone.</p>
            <h3>Processing Time</h3>
            <p>Orders are typically processed within 1-2 business days. You will receive an email notification once your order has shipped.</p>
            <h3>Delivery Estimates</h3>
            <ul>
                <li>Local Delivery: 1-2 business days</li>
                <li>National Standard: 3-5 business days</li>
                <li>GCC &amp; Middle East: 5-7 business days</li>
                <li>International Priority: 7-14 business days</li>
            </ul>
            <h3>Free Shipping</h3>
            <p>We offer free shipping on qualifying orders. Thresholds vary by delivery region. Check our shipping calculator at checkout for details.</p>
        @endif
    </div>
</div>
