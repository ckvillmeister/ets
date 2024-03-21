@extends('index')
@section('content')
<div class="page-inner">
    <div class="panel-header">
        <div class="page-header">
            <h4 class="page-title">File Manager</h4>
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="{{ route('dashboard') }}">
                        <i class="fas fa-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="{{ route('file') }}">File Manager</a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="#">File Upload</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card p-3">
                <div class="body" id="content">

                    <input type="file" id="fileuploader" name="fileuploader" multiple>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $('#fileuploader').ssi_uploader({
        allowed: ['jpg', 'jpeg', 'png', 'bmp', 'gif', 'pdf', 'docx'],
        url:'{{ route("store-file") }}',
        maxFileSize:8,
        onUpload:function () {
            location.reload();
        },
    });
</script>
@endpush
