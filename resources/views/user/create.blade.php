<form id="frm">
    <div class="row clearfix">
        <input type="hidden" name="id" value="{{ ($user) ? $user->id : null }}">
        <div class="col-sm-4">
            <div class="form-group form-floating-label">
                <div class="form-line">
                    <input type="text" class="form-control from-control-sm input-border-bottom" id="firstname" name="firstname" value="{{ ($user) ? $user->firstname : '' }}" required>
                    <label for="name" class="placeholder">First Name</label>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group form-floating-label">
                <div class="form-line">
                    <input type="text" class="form-control from-control-sm input-border-bottom" id="middlename" name="middlename" value="{{ ($user) ? $user->middlename : '' }}">
                    <label class="placeholder" for="middlename">Middle Name</label>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group form-floating-label">
                <div class="form-line">
                    <input type="text" class="form-control from-control-sm input-border-bottom" id="lastname" name="lastname" value="{{ ($user) ? $user->lastname : '' }}" required>
                    <label class="placeholder" for="lastname">Last Name</label>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group form-floating-label">
                <div class="form-line">
                    <input type="text" class="form-control from-control-sm input-border-bottom" id="username" name="username" value="{{ ($user) ? $user->username : '' }}" required {{ ($user) ? 'disabled' : '' }}> 
                    <label class="placeholder" for="username">Username</label>
                </div>
            </div>
        </div>
        @if (!$user)
        <div class="col-sm-4">
            <div class="form-group form-floating-label">
                <div class="form-line">
                    <input type="password" class="form-control from-control-sm input-border-bottom" id="password" name="password" required> 
                    <label class="placeholder" for="password">Password</label>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group form-floating-label">
                <div class="form-line">
                    <input type="password" class="form-control from-control-sm input-border-bottom" id="cpassword" name="cpassword" required> 
                    <label class="placeholder" for="cpassword">Confirm Password</label>
                </div>
            </div>
        </div>
        @endif
        <div class="col-sm-4">
            <div class="form-group form-floating-label">
                <select class="form-control show-tick" name="role" required>
                    <option value="">-- Please select a role --</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}" {{ ($user) ? (($role->id == $user->role) ? 'selected' : '') : '' }}>{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-sm-12 float-right mt-3">
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
        getUsers(1);
    });

    $('#frm').on('submit', function(e){
        e.preventDefault();

        $.ajax({
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: 'userStore',
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
                        if (result['icon'] == 'success'){
                            getUsers(1);
                        }
                    }
                });
            },
            error: function(obj, err, ex){
                swal("Server Error", err + ": " + obj.toString() + " " + ex, "error");
            }
        })
    });
</script>