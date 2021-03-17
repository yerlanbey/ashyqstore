<form method="GET" action="{{ route('shop.index', $shop->slug) }}">

<!-- aside Widget -->
<div class="aside">
    <h3 class="aside-title">Брэнды</h3>
    <div class="checkbox-filter">
        <label for="hit">
            <input type="checkbox" name="hit" id="hit"
                   @if(request()->has('hit')) checked="checked" @endif> Хит
        </label>
    </div>
    <div class="checkbox-filter">
        <label for="new">
            <input type="checkbox" name="new" id="new"
                   @if(request()->has('new')) checked="checked" @endif>
            Новинка
        </label>
    </div>
    <div class="checkbox-filter">
        <label for="recommend">
            <input type="checkbox" name="recommend" id="recommend"
                   @if(request()->has('recommend')) checked="checked" @endif>
            Рекомендуем
        </label>
    </div>
</div>
<!-- /aside Widget -->

<!-- aside Widget -->
<div class="aside">
    <h3 class="aside-title">Цена</h3>
    <div class="price-filter">
        <div id="price-slider"></div>
        <div class="input-number price_from">

                <input type="number" name="price_from" id="price_from"   value="{{request()->price_from}}">

            <span class="qty-up">+</span>
            <span class="qty-down">-</span>
        </div>
        <span>-</span>
        <div class="input-number price_to">

                <input type="number" name="price_to" id="price_to"  value="{{ request()->price_to }}">

            <span class="qty-up">+</span>
            <span class="qty-down">-</span>
        </div>
    </div>
</div>
    <div class="btn-filter-reset">
        <button type="submit" class="btn-filter">Фильтр</button>
        <a href="{{ route('shop.index', $shop->slug) }}" class="btn-reset">Сброс</a><!-- /aside Widget -->
    </div>
</form>
