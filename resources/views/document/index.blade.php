@extends('index')
@section('content')

<style>
    .title {
        white-space: nowrap; 
        width: 100%; 
        overflow: hidden;
        text-overflow: ellipsis; 
    }

    .type {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

</style>
<div class="page-inner">
    <div class="panel-header">
        <div class="page-header">
            <h4 class="page-title">Document Manager</h4>
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
                    <a href="#">Document Manager</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card p-3">
                <div class="body" id="content">
                    <div class="btn-group">
                        <a type="button" class="btn btn-sm btn-primary waves-effect btn-new" href="{{ route('create-document') }}">
                            <i class="fas fa-file-signature"></i>
                            <span>Create</span>
                        </a>
                        <a type="button" class="btn btn-sm btn-info waves-effect btn-active" href="{{ url('/document?status=1') }}">
                            <i class="fas fa-check-square"></i>
                            <span>Active</span>
                        </a>
                        <a type="button" class="btn btn-sm btn-secondary waves-effect btn-trash" href="{{ url('/document?status=0') }}">
                            <i class="fas fa-trash-alt"></i>
                            <span>Trash</span>
                        </a>
                    </div>

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
                                        <form action="{{ route('document') }}" method="GET">
                                            <input type="text" class="form-control" name="search" placeholder="Search File/s" aria-label="Search" aria-describedby="basic-addon1">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                
                    @if (!$documents->isEmpty())
                        <section class="gallery-block cards-gallery">
                            <div class="container">
                                <div class="row gallery">
                                    @php ($index = 0)
                                    @foreach ($documents as $document)
                                    <div class="col-md-4">
                                        <div class="card border-0 transform-on-hover">
                                            <a class="lightbox" href="#">
                                                
                                            </a>
                                            <div class="card-body">
                                                <h6>Doc No. Series: <a href="#">{{ ($document->series) ? $document->series : 'N/A' }}</a></h6>
                                                <h6 class="title"><a href="#">({{ $document->title }})</a></h6>
                                                <em class="type"><a href="#">{{ $document->category()->first()->category }}</a></em>
                                                <br><br>
                                                <p class="text-muted card-text">
                                                    <a href="{{ url('/document/view?id=').$document->id }}" class="btn btn-sm btn-primary waves-effect">
                                                        <i class="fas fa-eye mr-2"></i>View
                                                    </a>
                                                    <a href="{{ url('/document/update?id=').$document->id }}" class="btn btn-sm btn-info waves-effect">
                                                        <i class="fas fa-edit mr-2"></i>Edit
                                                    </a>
                                                    @if ($document->status)
                                                    <button class="btn btn-sm btn-danger waves-effect" title="Delete Document" role="button" onclick="deleteFile({{ $document->id }})"><i class="fas fa-trash-alt mr-2"></i>Delete</button>
                                                    @else
                                                    <button class="btn btn-sm btn-success waves-effect" title="Restore Document" role="button" onclick="restoreFile({{ $document->id }})"><i class="fas fa-undo-alt mr-2"></i>Restore</button>
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
                                            {{ $documents->onEachSide(2)->links() }}
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
            text: "Are you sure you want to delete this document?",
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
            text: "Are you sure you want to restore this document?",
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
            url: 'documentToggleStatus',
            method: 'POST',
            data: {'id': id, 'status': status},
            dataType: 'JSON',
            success: function(result) {
                window.location.reload();
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
            index: $(this).index()
        };

        $(".gallery img").each(function() {  
            imgsrc = this.src;
            items.push({
                src: imgsrc
            });
        });  
        
        new PhotoViewer(items, options);
    });
    // $(function () {
    //     $('.zero-results').animateCss('tada');
    //     setInterval(function() {
    //         $('.zero-results').animateCss('tada');
    //     }, 3500);
        
    // });

    // $.fn.extend({
    //     animateCss: function (animationName) {
    //         var animationEnd = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
    //         $(this).addClass('animated ' + animationName).one(animationEnd, function() {
    //             $(this).removeClass('animated ' + animationName);
    //         });
    //     }
    // });
</script>
@endpush