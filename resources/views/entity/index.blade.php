@extends('index')
@section('content')

<ol class="breadcrumb breadcrumb-col-teal align-right" style="margin-top: -20px">
    <li class="active"><i class="material-icons">account_circle</i> Entity</li>
</ol>
<div class="row clearfix">
    <div class="col-sm-12">
        <div class="card">
            <div class="header">
                <h2>Entity</h2>
            </div>
            <div class="body" id="content">
                <div class="btn-group">
                    <a type="button" class="btn btn-primary waves-effect btn-new" href="{{ route('new-entity') }}">
                        <i class="material-icons">person_add</i>
                        <span>New</span>
                    </a>
                    <a type="button" class="btn btn-info waves-effect btn-active" href="{{ url('/entity?status=1') }}">
                        <i class="material-icons">event_available</i>
                        <span>Active</span>
                    </a>
                    <a type="button" class="btn btn-secondary waves-effect btn-trash" href="{{ url('/entity?status=0') }}">
                        <i class="material-icons">delete</i>
                        <span>Trash</span>
                    </a>
                </div><br><br>

                <div class="row">
                    <div class="col-sm-9"></div>
                    <div class="col-sm-3">
                        <div class="input-group input-group-md">
                            <span class="input-group-addon">
                                <i class="material-icons">person</i>
                            </span>
                            <div class="form-line">
                                <form action="{{ route('entity') }}" method="GET">
                                    <input type="text" name="search" class="form-control" placeholder="Search">
                                </form>
                            </div>
                            <span class="input-group-addon">
                                <i class="material-icons">search</i>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="row">

                @if (!$entities->isEmpty())
                    @foreach ($entities as $entity)
                        <div class="col-lg-3" style="margin-bottom: -10px">
                            <div class="thumbnail">
                                @if ($entity->sex == "M")
                                    <img src="{{ asset('images/profile-male.jpg') }}">
                                @else
                                    <img src="{{ asset('images/profile-female.jpg') }}">
                                @endif
                                    <div class="caption text-center">
                                        <h6>{{ ($entity->entityname) ? strtoupper($entity->entityname) : strtoupper($entity->firstname.' '.$entity->lastname) }}</h6>
                                        <p>
                                            <div class="icon-button-demo">
                                                @if ($entity->status)
                                                <a href="{{ route('entity-profile') }}?id={{ $entity->id }}" class="btn btn-default waves-effect" title="View Entity" >
                                                    <i class="material-icons">search</i>
                                                </a>
                                                <a href="{{ route('new-entity') }}?id={{ $entity->id }}" class="btn btn-default waves-effect" title="Edit Entity" >
                                                    <i class="material-icons">edit</i>
                                                </a>
                                                <a href="#" class="btn btn-default waves-effect" title="Delete Entity" onclick="deleteEntity({{ $entity->id }})">
                                                    <i class="material-icons">delete</i>
                                                </a>
                                                @else
                                                <a href="#" class="btn btn-default waves-effect" title="Restore Entity" onclick="restoreEntity({{ $entity->id }})">
                                                    <i class="material-icons">undo</i>
                                                </a>
                                                @endif
                                            </div>
                                        </p>
                                    </div>
                            </div>
                        </div>
                    @endforeach
                    </div>
                    <div class="row">
                        <div class="col-sm-9"></div>
                        <div class="col-sm-3">
                            <div class="pull-right">
                                {{ $entities->onEachSide(2)->links() }}
                            </div>
                        </div>
                    </div>
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
            <div class="footer">
                
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function deleteEntity(id){
        swal({
            title: "Confirm",
            text: "Are you sure you want to delete this entity?",
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

    function restoreEntity(id){
        swal({
            title: "Confirm",
            text: "Are you sure you want to restore this entity?",
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
            url: 'entityToggleStatus',
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