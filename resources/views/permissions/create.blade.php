<form id="frm">
    <div class="row clearfix">
        <input type="hidden" name="id" value="{{ ($permission) ? $permission->id : null }}">
        <div class="col-sm-12">
            <div class="form-group form-floating-label">
                <input type="text" class="form-control from-control-sm input-border-bottom" id="name" name="name" value="{{ ($permission) ? $permission->name : '' }}" required>
                <label for="name" class="placeholder">Permission Name</label>
            </div>
        </div>
        <div class="col-sm-12 float-right">
            <div class="btn-group">
                <button type="submit" class="btn btn-sm btn-primary waves-effect btn-save">
                    <i class="fas fa-save mr-2"></i>
                    <span>Save</span>
                </button>
                <button type="button" class="btn btn-sm btn-default waves-effect btn-back">
                    <i class="fas fa-undo mr-2"></i>
                    <span>Back</span>
                </button>
            </div>
        </div>
    </div>
</form>

<script>
    $('.btn-back').on('click', function(){
        getPermissions(1);
    });

    $('#frm').on('submit', function(e){
        e.preventDefault();

        $.ajax({
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: 'permissionStore',
            method: 'POST',
            data: $('#frm').serialize(),
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
                        getPermissions(1);
                    }
                });
            },
            error: function(obj, err, ex){
                swal("Server Error", err + ": " + obj.toString() + " " + ex, "error");
            }
        })
    });
</script>