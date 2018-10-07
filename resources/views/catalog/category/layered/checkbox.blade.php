<div class="filter filter-checkbox filter-{{ $attribute->code }}">
    <div class="filter-title">
        <h4>{{ $attribute->label }}</h4>
    </div>
    <ul>
        @foreach ( $options as $key => $option_label )
            <li>
                <div class="checkbox">
                    <label>
                        {!! Form::checkbox("filter[$attribute->code][]", $option_label, request()->filled('filter.' .   $attribute->code . '.' . $loop->index)) !!}
                        {{ $option_label }}
                    </label>
                </div>
            </li>
        @endforeach
    </ul>
</div>