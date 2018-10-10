<div class="form-group">
    {!! Form::materialSelect('Manage Stock', 'manage_stock',  [1 => 'Yes', 0 => 'No'], old('manage_stock', ((isset($product->stock->manage_stock) && $product->stock->manage_stock) ? TRUE : FALSE)), $errors->first('manage_stock')) !!}
</div>

<div class="form-group">
    {!! Form::materialText('Quantity', 'quantity', old('quantity', ((isset($product->stock->quantity) && $product->stock->quantity) ? $product->stock->quantity : '') ), $errors->first('quantity')) !!}
</div>

<div class="form-group">
    {!! Form::materialText('Stock Alert', 'stock_alert', old('stock_alert', ((isset($product->stock->stock_alert) && $product->stock->stock_alert) ? $product->stock->stock_alert : 20 )), $errors->first('stock_alert')) !!}
</div>

<div class="form-group">
    {!! Form::materialSelect('Stock Availability', 'stock_availability',  [1 => 'In Stock', 0 => 'Out of Stock'], old('stock_availability', ((isset($product->stock->stock_availability) && $product->stock->stock_availability) ? TRUE : FALSE)), $errors->first('stock_availability')) !!}
</div>

