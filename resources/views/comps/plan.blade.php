<div class="pricingTable {{ (function($index) {
        switch($index) {
            case 0: return "darkblue";
            case 2: return "golden";
            default: return ""; 
        }
    })($index) }}">
    <div class="pricingTable-header">
        <h3 class="title">{{ $plan["name"] }}</h3>
        <div class="price-value">
            <span class="price-currency">MAD</span>
            <span class="amount">{{ $plan["amount"] }}</span>
            <span class="duraton">per {{ $plan["period"] }}</span>
        </div>
    </div>
    <ul class="pricing-content">
        @foreach ($plan["features"] as $feature)
            <li>{{ $feature }}</li>
        @endforeach
        @foreach ($plan["non_featues"] as $feature)
            <li class="disable">{{ $feature }}</li>
        @endforeach
    </ul>
    @if(!isset($no_subscribe))
    <div class="pricingTable-signup">
        <a href="/subscription/paiment?plan={{ $index }}">Subscribe</a>
    </div>
    @endif
</div>