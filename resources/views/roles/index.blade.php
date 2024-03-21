@extends('index')
@section('content')

<div class="page-inner">
    <div class="panel-header">
        <div class="page-header">
            <h4 class="page-title">Roles</h4>
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
                    <a href="#">Roles</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card p-3">
                <div class="body" id="content">

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')
<script>
    getRoles(1);

    $('body').on('click', '.btn-new', function(){
        roleCreate(0);
    });

    $('body').on('click', '.btn-edit', function(){
        var id = $(this).val();
        roleCreate(id);
    });

    $('body').on('click', '.btn-delete', function(){
        var id = $(this).val();

        swal({
            title: "Confirm",
            text: "Are you sure you want to delete this role?",
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
    });

    $('body').on('click', '.btn-activate', function(){
        var id = $(this).val();
        toggleStatus(id, 1);
    });

    $('body').on('click', '.btn-active', function(){
        getRoles(1);
    });

    $('body').on('click', '.btn-trash', function(){
        getRoles(0);
    });

    function roleCreate(id){
        $.ajax({
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: 'roleCreate',
            method: 'POST',
            data: {'id': id},
            dataType: 'html',
            beforeSend: function() {
                $('#content').html('<div class="progress" style="height: 13px;">' +
                                    '<div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 100%">' +
                                    '<span class="sr-only">40% Complete (success)</span>' +
                                    '</div>' +
                                    '</div>');
            },
            complete: function(){
                
            },
            success: function(result) {
                $('#content').html(result);
            },
            error: function(obj, err, ex){
                swal("Server Error", err + ": " + obj.toString() + " " + ex, "error");
            }
        })
    }

    function getRoles(status){
        $.ajax({
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: 'roleRetrieve',
            method: 'POST',
            data: {'status': status},
            dataType: 'html',
            beforeSend: function() {
                $('#content').html('<div class="progress" style="height: 13px;">' +
                                    '<div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 100%">' +
                                    '<span class="sr-only">40% Complete (success)</span>' +
                                    '</div>' +
                                    '</div>');
            },
            complete: function(){
                
            },
            success: function(result) {
                $('#content').html(result);
            },
            error: function(obj, err, ex){
                swal("Server Error", err + ": " + obj.toString() + " " + ex, "error");
            }
        })
    }

    function toggleStatus(id, status){
        $.ajax({
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: 'roleToggleStatus',
            method: 'POST',
            data: {'id': id, 'status': status},
            dataType: 'JSON',
            success: function(result) {
                swal(result['title'], result['message'], result['icon']);

                if (result['icon'] != 'error'){
                    if (status){
                        getRoles(0);
                    }
                    else{
                        getRoles(1);
                    }
                }
            },
            error: function(obj, err, ex){
                swal("Server Error", err + ": " + obj.toString() + " " + ex, "error");
            }
        })
    }
</script>
@endpush



