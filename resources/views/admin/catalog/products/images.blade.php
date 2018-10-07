<div id="images-list">
    @if($product->images()->count())
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th width="10%">Image</th>
                    <th>Label</th>
                    <th width="10%">Sequence</th>
                    <th width="10%">&nbsp</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($product->images as $key => $image)
                    {!! Form::hidden('image['.$key.'][image]', $image->id) !!}
                    <tr>
                        <td>
                            <img src="{{ $image->getUrl() }}"/>
                        </td>
                        <td>
                            <div class="form-group">
                                <div class="form-line">
                                    {!! Form::text('image['.$key.'][label]', old('images.' . $key . '.label', $image->label), ['class' => 'form-control']) !!}
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <div class="form-line">
                                    {!! Form::text('image['.$key.'][sequence]', old('images.' . $key . '.sequence', $image->sequence), ['class' => 'form-control']) !!}
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="demo-checkbox">
                                {!! Form::checkbox('image['.$key.'][remove]', true, null, ['class' => 'filled-in chk-col-blue', 'id' => 'remove_media_' . $key]) !!}
                                <label for="{{ 'remove_media_' . $key }}">Remove</label>
                            </div>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>