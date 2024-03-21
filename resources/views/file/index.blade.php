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
                    <a href="#">File Manager</a>
                </li>
            </ul>
        </div>
    </div>
        
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                
                <div class="body p-3" id="content">
                    <div class="btn-group">
                        <a type="button" class="btn btn-sm btn-primary waves-effect btn-new" href="{{ route('upload-file') }}">
                            <i class="fas fa-upload"></i>
                            <span>Upload</span>
                        </a>
                        <a type="button" class="btn btn-sm btn-info waves-effect btn-active" href="{{ url('/file?status=1') }}">
                            <i class="fas fa-check-square"></i>
                            <span>Active</span>
                        </a>
                        <a type="button" class="btn btn-sm btn-secondary waves-effect btn-trash" href="{{ url('/file?status=0') }}">
                            <i class="fas fa-trash-alt"></i>
                            <span>Trash</span>
                        </a>
                    </div><br><br>

                    <div class="row">
                        <div class="col-sm-9"></div>
                        <div class="col-sm-3">
                            <div class="input-group input-group-md">
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                <i class="fas fa-search"></i>
                                            </span>
                                        </div>
                                        <form action="{{ route('file') }}" method="GET">
                                            <input type="text" class="form-control" placeholder="Search File/s" name="search" aria-label="Search" aria-describedby="basic-addon1">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                
                    @if (!$files->isEmpty())
                        <section class="gallery-block cards-gallery">
                            <div class="container">
                                <div class="row gallery">
                                    @php ($index = 0)
                                    @foreach ($files as $file)
                                        @php ($path='files/'.$file->filename)
                                    <div class="col-md-2">
                                        <div class="card border-0 transform-on-hover">
                                            <a class="lightbox" href="#">
                                                @if (in_array($file->type,  ['jpg', 'jpeg', 'png', 'bmp', 'gif']))
                                                    <img src="{{ asset($path) }}" class="card-img-top" style="height: 150px" data-file="image" data-index="{{ $index++ }}">
                                                @elseif ($file->type == 'pdf')
                                                    <div class="text-center">
                                                        <i class="far fa-file-pdf pt-4" style="height: 150px; font-size: 80pt"></i>
                                                    </div>
                                                @elseif ($file->type == 'docx')
                                                    <div class="text-center">
                                                        <i class="far fa-file-word pt-4" style="height: 150px; font-size: 80pt"></i>
                                                    </div>
                                                @endif
                                            </a>
                                            <div class="card-body">
                                                <h6>Filename: <a href="#">{{ $file->filename }}</a></h6>
                                                <p class="text-muted card-text">@if ($file->status)
                                                    <button class="btn btn-sm btn-danger waves-effect" title="Delete File" role="button" onclick="deleteFile({{ $file->id }})"><i class="fas fa-trash-alt mr-2"></i>Delete</button>
                                                    @else
                                                    <button class="btn btn-sm btn-success waves-effect" title="Restore File" role="button" onclick="restoreFile({{ $file->id }})"><i class="fas fa-undo-alt mr-2"></i>Restore</button>
                                                    @endif</p>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <div class="row pt-3">
                                    <div class="col-sm-9"></div>
                                    <div class="col-sm-3">
                                        <div class="pull-right">
                                            {{ $files->onEachSide(2)->links() }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    @else
                        <div class="row">
                            <div class="col-sm-4"></div>
                            <div class="col-sm-4">
                                <div class="card-body cart zero-results">
                                    <div class="col-sm-12 empty-cart-cls text-center">
                                        <img src="{{ asset('images/empty.gif') }}" width="250" height="250" class="img-fluid mb-4 mr-3">
                                        <h3><strong>0 Results</strong></h3>
                                        <h5>We searched far and wide and couldn't find any files matching your search</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4"></div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('css')
<link href="{{ asset('adminbsb/plugins/photoviewer-master/dist/photoviewer.min.css') }}" rel="stylesheet" />
@endpush
@push('scripts')
<script src="{{ asset('adminbsb/plugins/photoviewer-master/dist/photoviewer.min.js') }}"></script>
<script>
    function deleteFile(id){
        swal({
            title: "Confirm",
            text: "Are you sure you want to delete this file?",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Proceed",
            cancelButtonText: "Cancel",
        },
        function(isConfirm){
            if (isConfirm) {
                toggleStatus(id, 0);
            }
        });
    }

    function restoreFile(id){
        swal({
            title: "Confirm",
            text: "Are you sure you want to restore this file?",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Proceed",
            cancelButtonText: "Cancel",
        },
        function(isConfirm){
            if (isConfirm) {
                toggleStatus(id, 1);
            }
        });
    }

    function toggleStatus(id, status){
        $.ajax({
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: 'fileToggleStatus',
            method: 'POST',
            data: {'id': id, 'status': status},
            dataType: 'JSON',
            success: function(result) {
                swal({
                    title: result['title'],
                    type: result['icon'],
                    text: result['message'],
                    confirmButtonText: "Okay",
                },
                function(isConfirm){
                    if (isConfirm) {
                        if (result['icon'] == 'error'){
                        }
                        else{
                            window.location.reload();
                        }
                    }
                });
            },
            error: function(obj, err, ex){
                swal("Server Error", err + ": " + obj.toString() + " " + ex, "error");
            }
        })
    }

    $('[data-file=image]').click(function (e) {
        e.preventDefault();

        var items = [],
            options = {
            index: $(this).attr('data-index'),
            initMaximized: true
        };

        $(".gallery img").each(function() {  
            imgsrc = this.src;
            items.push({
                src: imgsrc
            });
        });  

        new PhotoViewer(items, options);
    });
   
</script>
@endpush