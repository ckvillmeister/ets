<div class="row">
    <div class="col-sm-12">
        <div class="btn-group">
            <button type="button" class="btn btn-sm btn-primary waves-effect btn-new">
                <i class="fas fa-sort-amount-up"></i>
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
                <th class="text-center">Category Name</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            @php ($ctr = 1)
            @foreach ($categories as $category)
            <tr>
                <td class="text-center">{{ $ctr++ }}</td>
                <td class="text-center">{{ $category->category }}</td>
                <td class="text-center">
                    <button type="button" class="btn btn-sm btn-warning waves-effect btn-edit" value="{{ $category->id }}" title="Edit Category">
                        <i class="fas fa-edit"></i>
                    </button>
                    @if ($category->status)
                    <button type="button" class="btn btn-sm btn-danger waves-effect btn-delete" value="{{ $category->id }}" title="Deactivate Category">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                    @endif
                    @if (!$category->status)
                    <button type="button" class="btn btn-sm btn-success waves-effect btn-activate" value="{{ $category->id }}" title="Re-activate Category">
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
    $(document).ready(function() {
        $('#table-list').DataTable();
    });
</script>