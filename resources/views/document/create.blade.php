@extends('index')
@section('content')
<style>
    input[type="file"] {
        display: none;
    }
    .custom-file-upload {
        border: 1px solid #ccc;
        display: inline-block;
        padding: 6px 12px;
        cursor: pointer;
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
                    <a href="{{ route('document') }}">Document Manager</a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="#">{{ ($document) ? 'Edit Document' : 'Create Document' }}</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-sm-12">
            <div class="card p-3">
                <div class="body" id="content">
                    <form id="frm" method="POST"> <!-- action="{{ route('store-document') }}" enctype="multipart/form-data"> -->
                        <input type="hidden" name="id" id="id" value="{{ ($document) ? $document->id : null }}">
                        <div class="row clearfix">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <b>Document Category</b>
                                    <div class="input-icon">
                                        <span class="input-icon-addon">
                                            <i class="fas fa-layer-group"></i>
                                        </span>
                                        <select class="form-control show-tick" name="category" id="category" required>
                                            <option value="">Select Category</option>
                                            @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" 
                                                {{ ($document) ? (($category->id == $document->category) ? 'selected' : '') : '' }} data-no="{{ $category->is_with_series_no }}" 
                                                data-sender="{{ $category->is_with_sender }}" 
                                                data-receiver="{{ $category->is_with_receiver }}">
                                                {{ $category->category }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <label class="error" for="category">{{ $errors->first('category') }}</label>
                                </div>
                            </div>
                            <div class="col-sm-6" id="number-series">
                                <div class="form-group">
                                    <b id="number-series-text"></b>
                                    <div class="input-icon">
                                        <span class="input-icon-addon">
                                            <i class="fas fa-sort-numeric-down"></i>
                                        </span>
                                        <input type="text" class="form-control" id="series" name="series" value="{{ ($document) ? $document->series : '' }}" placeholder="">
                                    </div>
                                    <label class="error" for="series">{{ $errors->first('series') }}</label>
                                </div>
                            </div>
                            <script>document.getElementById('number-series').style.display = "none";</script>
                        </div>
                        <div class="row clearfix">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <b>Document Title</b>
                                    <div class="input-icon">
                                        <span class="input-icon-addon">
                                            <i class="fas fa-text-height"></i>
                                        </span>
                                        <input type="text" class="form-control" id="title" name="title" value="{{ ($document) ? $document->title : '' }}" placeholder="Document title" required>
                                    </div>
                                    <label class="error" for="title">{{ $errors->first('title') }}</label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <b>Date</b>
                                    <div class="input-icon">
                                        <span class="input-icon-addon">
                                            <i class="far fa-calendar-alt"></i>
                                        </span>
                                        <input type="date" class="form-control" id="doc_date" name="doc_date" value="{{ ($document) ? $document->doc_date : date('Y-m-d') }}" required>
                                    </div>
                                    <label class="error" for="doc_date">{{ $errors->first('doc_date') }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <b>Description</b>
                                    <div class="input-icon">
                                        <span class="input-icon-addon">
                                            <i class="fas fa-info-circle"></i>
                                        </span>
                                        <input type="text" class="form-control" id="description" name="description" value="{{ ($document) ? $document->description : '' }}" placeholder="Description">
                                    </div>
                                    <label class="error" for="title">{{ $errors->first('description') }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix" id="sender-field">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <b>From / For:</b>
                                    <div class="input-icon">
                                        <span class="input-icon-addon">
                                            <i class="fas fa-user-tie"></i>
                                        </span>
                                        <input type="text" class="form-control" id="sender" name="sender" value="{{ ($document) ? $document->sender : '' }}" placeholder="From / For">
                                    </div>
                                    <label class="error" for="sender">{{ $errors->first('sender') }}</label>
                                </div>
                            </div>
                        </div>
                        <script>document.getElementById('sender-field').style.display = "none";</script>
                        <div class="row clearfix" id="recipient-field">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <b>Received by:</b>
                                    <div class="input-icon">
                                        <span class="input-icon-addon">
                                            <i class="fas fa-user-tie"></i>
                                        </span>
                                        <input type="text" class="form-control" id="recipient" name="recipient" value="{{ ($document) ? $document->recipient : '' }}" placeholder="Received by">
                                    </div>
                                    <label class="error" for="recipient">{{ $errors->first('recipient') }}</label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <b>Date and Time Received:</b>
                                    <div class="input-icon">
                                        <span class="input-icon-addon">
                                            <i class="far fa-calendar-alt"></i>
                                        </span>
                                        <input type="datetime-local" class="form-control" id="datetimereceived" name="datetimereceived" value="{{ ($document) ? $document->datetimereceived : date('Y-m-d h:i:s') }}" placeholder="To">
                                    </div label class="error" for="datetimereceived">{{ $errors->first('datetimereceived') }}</label>
                                </div>
                            </div>
                        </div>
                        <script>document.getElementById('recipient-field').style.display = "none";</script>

                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <b>Attach Files</b>
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <div class="nav flex-column nav-pills nav-secondary nav-pills-no-bd nav-pills-icons" id="v-pills-tab-with-icon" role="tablist" aria-orientation="vertical">
                                                <a class="nav-link active show" id="v-pills-profile-tab-icons" data-toggle="pill" href="#v-pills-profile-icons" role="tab" aria-controls="v-pills-profile-icons" aria-selected="false">
                                                    <i class="flaticon-tool"></i>
                                                    Attach Uploaded Files
                                                </a>
                                                <a class="nav-link" id="v-pills-home-tab-icons" data-toggle="pill" href="#v-pills-home-icons" role="tab" aria-controls="v-pills-home-icons" aria-selected="true">
                                                    <i class="flaticon-folder"></i>
                                                    Upload Files
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-sm-10">
                                            <div class="tab-content" id="v-pills-with-icon-tabContent">
                                                <div class="tab-pane fade active show" id="v-pills-profile-icons" role="tabpanel" aria-labelledby="v-pills-profile-tab-icons">
                                                    <b>Search Uploaded Files</b><br><br>
                                                    <button type="button" class="btn btn-sm bg-teal waves-effect view-files">
                                                        <i class="fas fa-list-ol mr-2"></i>
                                                        <span>View List</span>
                                                    </button>
                                                    <div class="table-responsive mt-2">
                                                        <table class="display table table-striped table-hover dataTable" id="table-list">
                                                            <thead>
                                                                <tr>
                                                                    <th class="text-center">No</th>
                                                                    <th class="text-center">Filename</th>
                                                                    <th class="text-center">Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="attached-file-list">
                                                            @php ($ctr = 1)     
                                                            @if ($document)                                                   
                                                                @foreach ($document->attachments as $attachment)
                                                                    <tr>
                                                                        <td class="text-center">{{ $ctr++ }}</td>
                                                                        <td>{{ $attachment->info()->first()->filename }}</td>
                                                                        <td class="text-center">
                                                                            '<button type="button" class="btn btn-sm btn-danger" id="remove-file" value="{{ $attachment->info()->first()->id }}" data-permanent="1"><i class="fas fa-trash-alt"></i></button>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            @endif
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="v-pills-home-icons" role="tabpanel" aria-labelledby="v-pills-home-tab-icons">
                                                    <div class="form-group">
                                                        <b>Upload Attachment(s)</b><br><br>
                                                        <label for="fileuploader" class="custom-file-upload btn btn-sm bg-teal waves-effect">
                                                            <i class="fas fa-upload mr-2"></i>Choose Files
                                                        </label>
                                                        <input type="file" class="btn btn-sm bg-teal waves-effect" 
                                                            id="fileuploader" name="fileuploader[]" onchange="image_preview(this);" 
                                                            accept=".bmp,.pdf,.gif,.jpg,.jpeg,.png,.doc,.docx" multiple>
                                                        <label class="btn btn-sm btn-danger waves-effect btn-save" id="fileuploader-clear">
                                                            <i class="fas fa-eraser mr-2"></i>
                                                            <span>Clear</span>
                                                        </label>
                                                        <br>
                                                        <div id="preview" style="margin-top: 20px; border: 2px #008080; border-style: dashed;"><br></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row clearfix mt-5">
                            <div class="col-sm-12 float-right">
                                <div class="btn-group">
                                    <button type="submit" class="btn btn-sm btn-primary waves-effect btn-save">
                                        <i class="fas fa-save mr-2"></i>
                                        <span>Save</span>
                                    </button>
                                    <a href="{{ route('document') }}" class="btn btn-sm btn-default waves-effect btn-back">
                                        <i class="fas fa-undo mr-2"></i>
                                        <span>Back</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="filelist" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="largeModalLabel"><i class="fas fa-list-ol mr-2"></i>File List</h4>
            </div>
            <div class="modal-body" id="tbl-filelist">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-primary waves-effect view-files-all"><i class="fas fa-spinner mr-2"></i>Retrieve All</button>
                <button type="button" class="btn btn-sm btn-default waves-effect" data-dismiss="modal"><i class="fas fa-window-close mr-2"></i>Close</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    var ctr = 1;

    toggleFields($('#category'));

    $('.view-files').on('click', function(){
        $("#filelist").modal({
            backdrop: 'static',
            keyboard: false
        });

        viewFiles(50);        
    });

    $('.view-files-all').on('click', function(){
        viewFiles(0);        
    });

    $('#table-list').on('click', '#remove-file', function(){
        var tr = $(this).closest('tr');
        var permanent = $(this).closest('tr').find('button').attr('data-permanent');

        swal({
            title: "Confirm",
            type: "warning",
            text: "Are you sure you want to remove this attached file?",
            confirmButtonText: "Confirm",
            showCancelButton: true,
        },
        function(isConfirm){
            if (isConfirm) {

                tr.remove();
                ctr--;

                var no = 1;
                $('#table-list tbody').find('tr').each(function(){
                    var $this = $(this);
                    $('td:eq(0)', $this).text(no);
                    no++;
                });
            }
        });
    });

    $('#frm').on('submit', function(e){
        e.preventDefault();

        var id = $('#id').val();
        var formData = new FormData();
        var uploader = $("#fileuploader")[0];

        for(var i=0; i<uploader.files.length; i++){
            formData.append("file" + i, $("#fileuploader").get(0).files[i]);
        }

        var attachments = [];
        var ctr = 0;

        $('#table-list tbody').find('tr').each(function(){
            attachments[ctr] = $(this).closest('tr').find('button').val();
            ctr++;
        });

        // if (uploader.files.length == 0 && (attachments === undefined || attachments.length === 0)){
        //     swal("Error", "Please attach files before saving!", "error");
        //     return;
        // }
        
        $.ajax({
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/document/store?' + $('#frm').serialize() + '&attachments=' + attachments,
            method: 'POST',
            data: formData,
            async: false,
            cache: false,
            processData: false,
            contentType: false,
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
                        window.location.href = "/document/view?id=" + result['id'];
                    }
                });
            },
            error: function(obj, err, ex){
                swal("Server Error", err + ": " + obj.toString() + " " + ex, "error");
            }
        })
    });

    $("#category").on('change', function(){
        toggleFields(this);
    });

    function viewFiles(limit){
        $.ajax({
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '{{ route("filelist") }}',
            method: 'POST',
            data: {'limit': limit},
            dataType: 'HTML',
            beforeSend: function() {
                $('#tbl-filelist').html('<div class="progress" style="height: 13px;">' +
                                    '<div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 100%">' +
                                    '<span class="sr-only">40% Complete (success)</span>' +
                                    '</div>' +
                                    '</div>');
            },
            success: function(result) {
                $('#tbl-filelist').html(result);
            },
            error: function(obj, err, ex){
                swal("Server Error", err + ": " + obj.toString() + " " + ex, "error");
            }
        })
    }

    function toggleFields(select){
    //$('#category').on('change', function(){
        var category = $("option:selected", select).text().trim(),
            series = parseInt($("option:selected", select).attr('data-no')),
            sender = parseInt($("option:selected", select).attr('data-sender')),
            recipient = parseInt($("option:selected", select).attr('data-receiver'));
       
        if (series){
            $('#number-series').show();
            $('#number-series-text').html(category + " No.");
        }
        else{
            $('#number-series').hide();
            $('#number-series-text').html('');
        }

        if (sender){
            $('#sender-field').show();
        }
        else{
            $('#sender-field').hide();
        }

        if (recipient){
            var name = '{{ Auth::user()->firstname.' '.Auth::user()->lastname }}';
            $('#recipient').val(name);
            $('#recipient-field').show();
        }
        else{
            $('#recipient-field').hide();
        }
    //});
    }

    $('#fileuploader-clear').on('click', function() { 
        $("#fileuploader").val(''); 
        $("#preview").html('<br>');
    });

    function image_preview(input) {
        $("#preview").html('');

        for(var i=0; i<input.files.length; i++){
            let acceptable_extensions = ['jpg', 'jpeg', 'png', 'bmp', 'gif', 'pdf', 'doc', 'docx'];
            let extension = input.files[i].name.split('.').pop().toLowerCase();
            let filereader = new FileReader();
            let $img=jQuery.parseHTML("<img src='' style='width:75px; " +
                                        "height: 75px; border: 1px solid #008080; " +
                                        "margin: 5px'>");

            if (!(acceptable_extensions.includes(extension))){
                //$('#fileuploader-clear').click();
                return;
            }

            filereader.onload = function(){
                if (extension == 'pdf'){
                    $img[0].src="{{ asset('images/pdf.png') }}";
                    return;
                }

                if (extension == 'docx' || extension == 'doc'){
                    $img[0].src="{{ asset('images/word.png') }}";
                    return;
                }

                $img[0].src=this.result;
            };

            filereader.readAsDataURL(input.files[i]);
            $("#preview").append($img);
        }
    }
</script>
@endpush