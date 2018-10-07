<div class="form-group">
    {!! Form::materialTextArea($attribute->getName(), $attribute->getCode(), old($attribute->getCode(), $product->getData($attribute->getCode())), $errors->first($attribute->getCode()) ) !!}
</div>