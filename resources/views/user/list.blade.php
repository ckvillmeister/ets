<div class="row">
    <div class="col-sm-12">
        <div class="btn-group">
            <button type="button" class="btn btn-sm btn-primary waves-effect btn-new">
                <i class="fas fa-users"></i>
                <span>New</span>
            </button>
            <button type="button" class="btn btn-sm btn-info waves-effect btn-active">
                <i class="fas fa-check-square"></i>
                <span>Active</span>
            </button>
            <button type="button" class="btn btn-sm btn-secondary waves-effect btn-trash">
                <i class="fas fa-trash-alt"></i>
                <span>Trash</span>
            </button>
        </div>
    </div>
</div>
<div class="table-responsive mt-5">
    <table class="display table table-striped table-hover dataTable" id="table-list">
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th class="text-center">Name</th>
                <th class="text-center">Username</th>
                <th class="text-center">Role</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            @php ($ctr = 1)
            @foreach ($users as $user)
            <tr>
                <td class="text-center">{{ $ctr++ }}</td>
                <td>{{ $user->firstname.' '.$user->lastname }}</td>
                <td class="text-center">{{ $user->username }}</td>
                <td class="text-center"><span class="label label-success">{{ $user->role()->first()->name }}</span></td>
                <td class="text-center">
                    <button type="button" class="btn btn-sm btn-warning waves-effect btn-edit" title="Edit User" value="{{ $user->id }}">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button type="button" class="btn btn-sm btn-primary waves-effect btn-resetpass" title="Reset Password" value="{{ $user->id }}">
                        <i class="fas fa-key"></i>
                    </button>
                    @if($user->status)
                    <button type="button" class="btn btn-sm btn-danger waves-effect btn-delete" title="Deactivate User" value="{{ $user->id }}">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                    @endif
                    @if(!$user->status)
                    <button type="button" class="btn btn-sm btn-success waves-effect btn-activate"  title="Re-activate User" value="{{ $user->id }}">
                        <i class="fas fa-undo-alt"></i>
                    </button>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    $('#table-list').DataTable();
    //let table = new DataTable('#table-list');
</script>