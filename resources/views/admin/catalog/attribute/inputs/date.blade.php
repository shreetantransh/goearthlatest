@php $value = $product->getData($attribute->getCode()) ? \Carbon\Carbon::parse($product->getData($attribute->getCode()))->format('d/m/Y') : ''; @endphp

<div class="form-group">
    {!! Form::materialText($attribute->getName(), $attribute->getCode(),
    old($attribute->getCode(), $value),
    $errors->first($attribute->getCode()), ['class' => 'form-control datepicker'])
    !!}
</div>