<div class="form-group">
    {!! Form::materialSelect(
        $attribute->getName(),
        $attribute->getCode() . '[]',
        $attribute->options()->pluck('option_value', 'option_value'), old($attribute->getCode(), $product->getData($attribute->getCode())),
        $errors->first($attribute->getCode()),
        [
        'multiple',
        'data-live-search' => 'true'
        ]
    ) !!}
</div>