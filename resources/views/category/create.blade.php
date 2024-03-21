<form id="frm">
    <div class="row">
        <input type="hidden" name="id" value="{{ ($category) ? $category->id : null }}">
        <div class="col-sm-12">
            <div class="form-group form-floating-label">
                <input type="text" class="form-control from-control-sm input-border-bottom" id="category" name="category" value="{{ ($category) ? $category->category : '' }}" required>
                <label for="category" class="placeholder">Category Name</label>
            </div>

        </div>
        <div class="col-sm-3">
            <div class="form-group form-floating-label">
                <b>Is With Series Number</b>
                <div class="custom-control custom-switch">
                  <input type="radio" class="custom-control-input" name="is_with_series_no" id="yes" value="1" {{ ($category) ? (($category->is_with_series_no) ? "checked" : '') : null }}>
                  <label class="custom-control-label" for="yes">Yes</label>
                </div>
                 <div class="custom-control custom-switch">
                  <input type="radio" class="custom-control-input" name="is_with_series_no" id="no" value="0"  {{ ($category) ? ((!$category->is_with_series_no) ? "checked" : '') : null }}>
                  <label class="custom-control-label" for="no">No</label>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group form-floating-label">
                <b>Is With Sender</b>
                <div class="custom-control custom-switch">
                  <input type="radio" class="custom-control-input" name="is_with_sender" id="syes" value="1" {{ ($category) ? (($category->is_with_sender) ? "checked" : '') : null }}>
                  <label class="custom-control-label" for="syes">Yes</label>
                </div>
                 <div class="custom-control custom-switch">
                  <input type="radio" class="custom-control-input" name="is_with_sender" id="sno" value="0" {{ ($category) ? ((!$category->is_with_sender) ? "checked" : '') : null }}>
                  <label class="custom-control-label" for="sno">No</label>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group form-floating-label">
                <b>Is With Receiver</b>
                <div class="custom-control custom-switch">
                  <input type="radio" class="custom-control-input" name="is_with_receiver" id="ryes" value="1" {{ ($category) ? (($category->is_with_receiver) ? "checked" : '') : null }}>
                  <label class="custom-control-label" for="ryes">Yes</label>
                </div>
                 <div class="custom-control custom-switch">
                  <input type="radio" class="custom-control-input" name="is_with_receiver" id="rno" value="0" {{ ($category) ? ((!$category->is_with_receiver) ? "checked" : '') : null }}>
                  <label class="custom-control-label" for="rno">No</label>
                </div>
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
        getCategories(1);
    });

    $('#frm').on('submit', function(e){
        e.preventDefault();

        $.ajax({
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: 'categoryStore',
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
                        getCategories(1);
                    }
                });
            },
            error: function(obj, err, ex){
                swal("Server Error", err + ": " + obj.toString() + " " + ex, "error");
            }
        })
    });
</script>