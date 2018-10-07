@foreach($categories as $key => $category)

    <option {{ in_array($category->id, $selected) ? 'selected' : '' }} value="{{ $category->id }}">{{ $dash }}{{ $category->name }}</option>

    @if($category->hasChild()->count())
        @include('admin.catalog.category.multi-category', ['categories' => $category->hasChild, 'dash' => $dash . '- ', 'selected' => $selected])
    @endif

@endforeach