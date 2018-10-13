<div class="filter filter-checkbox filter-{{ $attribute->code }}">
    <div class="filter-title">
        <h4>{{ $attribute->label }}</h4>
    </div>
    <div class="range-slider">
        <input type="text" class="js-range-slider" value=""/>
    </div>
    <div class="extra-controls" style="display: none;">
        <input type="text" id="price-filter" name="price_min" class="js-input-from" value="0" />
        <input type="text" id="price-filter" name="price_max" class="js-input-to" value="0" />
        <input type="checkbox" id="price_checkobx" >
    </div>
</div>

