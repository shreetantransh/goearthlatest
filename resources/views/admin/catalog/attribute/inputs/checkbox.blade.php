<div class="form-group">
    {!!   \Form::label($attribute->getCode(), $attribute->getName()) !!}
    {!! Form::materialCheckbox($attribute->getName(), $attribute->getCode(), $attribute->options()->pluck('option_value', 'option_value'), old($attribute->getCode(), $product->getData($attribute->getCode())), $errors->first($attribute->getCode()) ) !!}
</div>