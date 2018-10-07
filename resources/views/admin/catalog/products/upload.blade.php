@include('admin.catalog.products.images')

<div id="frmFileUpload" class="dropzone">
    <div class="dz-message">
        <div class="drag-icon-cph">
            <i class="material-icons">touch_app</i>
        </div>
        <h3>Drop files here or click to upload.</h3>
    </div>
    <div class="fallback">
        <input name="file" type="file" multiple/>
    </div>
</div>
<div id="uploaded-files"></div>

@push('scripts')
    <script type="text/javascript" src="{{ url('admin/js/pages/basic-form-elements.js') }}"></script>
    <script type="text/javascript">
        Dropzone.options.frmFileUpload = {
            paramName: "file",
            maxFilesize: 5,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '{{ route('admin.catalog.product.image_upload') }}',
            init: function () {
                this.on("success", function (request) {
                    var image = JSON.parse(request.xhr.response);
                    $('div#uploaded-files').append('<input type="hidden" value="' + image.id + '" name="images[]" />');
                });
            }
        };
    </script>
@endpush