<div class="form-group">
    {!! Form::materialSelect($attribute->getName(), $attribute->getCode(), $attribute->options()->pluck('option_value', 'option_value')->prepend('-- Please Select --', ''), old($attribute->getCode(), $product->getData($attribute->getCode())), $errors->first($attribute->getCode()) ) !!}
</div>