@foreach($categories as $key => $category)

    <option {{ in_array($category->id, $selected) ? 'selected' : '' }} {{ count(old('category')) && in_array($category->id, old('category')) ? 'selected' : '' }} value="{{ $category->id }}">{{ $dash }}{{ $category->name }}</option>

    @if($category->hasChild()->count())
        @include('admin.catalog.category.multi-category', ['categories' => $category->hasChild, 'dash' => $dash . '- ', 'selected' => $selected])
    @endif

@endforeach