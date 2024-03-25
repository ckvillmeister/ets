@extends('index')
@section('content')

<div class="page-inner">
    <div class="panel-header">
        <div class="page-header">
            <h4 class="page-title">Settings</h4>
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
                    <a href="#">User Profile</a>
                </li>
                 <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Settings</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card p-3">
                <div class="body">

                    <form id="frm">
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group form-floating-label">
                                    <div class="form-line">
                                        <input type="password" class="form-control from-control-sm input-border-bottom" id="opassword" name="opassword" required> 
                                        <label for="opassword" class="placeholder">Old Password</label>
                                    </div>
                                </div>
                                <div class="form-group form-floating-label">
                                    <div class="form-line">
                                        <input type="password" class="form-control from-control-sm input-border-bottom" id="password" name="password" required> 
                                        <label for="password" class="placeholder">New Password</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group form-floating-label">
                                    <div class="form-line">
                                        <input type="password" class="form-control from-control-sm input-border-bottom" id="password_confirmation" name="password_confirmation" required> 
                                        <label for="password_confirmation" class="placeholder">Confirm Password</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 float-right mt-3">
                                <div class="btn-group">
                                    <button type="submit" class="btn btn-sm btn-primary waves-effect btn-save">
                                        <i class="fas fa-save mr-2"></i>
                                        <span>Save</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    $('.btn-back').on('click', function(){
        getUsers(1);
    });

    $('#frm').on('submit', function(e){
        e.preventDefault();

        $.ajax({
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/user/change/password',
            method: 'POST',
            data: $('#frm').serialize(),
            dataType: 'JSON',
            success: function(result) {
                if (result['icon'] == 'error'){
                    swal({
                        title: result['title'],
                        type: result['icon'],
                        text: result['message'],
                    });
                }
                else{
                    swal({
                        title: result['title'],
                        type: result['icon'],
                        text: result['message'],
                        confirmButtonText: "Okay",
                    },
                    function(isConfirm){
                        if (isConfirm) {
                            window.location.href = "/dashboard";
                        }
                    });
                }
            },
            error: function(obj, err, ex){
                swal("Server Error", err + ": " + obj.toString() + " " + ex, "error");
            }
        })
    });
</script>
@endpush