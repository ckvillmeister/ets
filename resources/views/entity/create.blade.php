@extends('index')
@section('content')

<ol class="breadcrumb breadcrumb-col-teal align-right" style="margin-top: -20px">
    <li><a href="{{ route('entity') }}"><i class="material-icons">group</i> Entity</a></li>
    <li class="active"><i class="material-icons">create</i> {{ ($entity) ? 'Update' : 'Create' }} </li>
</ol>
<div class="row clearfix">
    <div class="col-sm-12">
        <div class="card">
            <div class="header">
                <h2>Entity</h2>
            </div>
            <div class="body" id="content">
                <form id="frm" method="POST" action="{{ route('store-entity') }}">
                    <input type="hidden" name="id" value="{{ ($entity) ? $entity->id : null }}">
                    <div class="row clearfix">
                        <div class="col-sm-2">
                            <span>Entity Type:</span>
                        </div>
                        <div class="col-sm-1">
                            <div class="form-group form-float">
                               <div class="demo-radio-button">
                                    <input name="entity-type" type="radio" id="individual" class="entity-type" value="individual" {{ ($entity) ? (($entity->entityname) ? '' : 'checked') : 'checked' }}>
                                    <label for="individual">Individual</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-1">
                            <div class="demo-radio-button">
                                <input name="entity-type" type="radio" class="entity-type" value="group" id="group" {{ ($entity) ? (($entity->entityname) ? 'checked' : '') : ((old('entity-type')=="group") ? 'checked' : '') }}>
                                <label for="group">Group</label>
                            </div>
                        </div>
                    </div>
                    <div class="name-field">
                        <div class="row clearfix">
                            <div class="col-sm-2">
                                <span>Complete Name:</span>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group form-float">
                                    <div class="form-line {{ (($errors->first('firstname')) ? 'error' : '') }}">
                                        <input type="text" class="form-control" id="firstname" name="firstname" value="{{ ($entity) ? $entity->firstname : '' }}">
                                        <label class="form-label">First Name</label>
                                    </div>
                                    <label class="error" for="firstname">{{ $errors->first('firstname') }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-sm-2">
                                <span></span>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="middlename" value="{{ ($entity) ? $entity->middlename : '' }}">
                                        <label class="form-label">Middle Name</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-sm-2">
                                <span></span>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group form-float">
                                    <div class="form-line {{ (($errors->first('lastname')) ? 'error' : '') }}">
                                        <input type="text" class="form-control" name="lastname" value="{{ ($entity) ? $entity->lastname : '' }}">
                                        <label class="form-label">Last Name</label>
                                    </div>
                                    <label class="error" for="lastname">{{ $errors->first('lastname') }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-sm-2">
                                <span></span>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <select class="form-control show-tick" name="extension">
                                            <option value="">Name Extension</option>
                                            <option value="JR." {{ ($entity) ? (($entity->extension == 'JR.') ? 'selected' : '') : '' }}>JR.</option>
                                            <option value="SR." {{ ($entity) ? (($entity->extension == 'SR.') ? 'selected' : '') : '' }}>SR.</option>
                                            <option value="II" {{ ($entity) ? (($entity->extension == 'II') ? 'selected' : '') : '' }}>II</option>
                                            <option value="III" {{ ($entity) ? (($entity->extension == 'III') ? 'selected' : '') : '' }}>III</option>
                                            <option value="IV" {{ ($entity) ? (($entity->extension == 'IV') ? 'selected' : '') : '' }}>IV</option>
                                            <option value="V" {{ ($entity) ? (($entity->extension == 'V') ? 'selected' : '') : '' }}>V</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="group-field">
                        <div class="row clearfix">
                            <div class="col-sm-2">
                                <span>Entity Name:</span>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group form-float">
                                    <div class="form-line {{ (($errors->first('entityname')) ? 'error' : '') }}">
                                        <input type="text" class="form-control" name="entityname" value="{{ ($entity) ? $entity->entityname : '' }}">
                                        <label class="form-label">Entity Name</label>
                                    </div>
                                    <label class="error" for="entityname">{{ $errors->first('entityname') }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-sm-2">
                            <span>Sex:</span>
                        </div>
                        <div class="col-sm-1">
                             <div class="form-group form-float">
                               <div class="demo-radio-button">
                                    <input name="sex" type="radio" id="male" value="M" {{ ($entity) ? (($entity->sex=='M') ? 'checked' : '') : '' }}>
                                    <label for="male">Male</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-1">
                            <div class="demo-radio-button">
                                <input name="sex" type="radio" id="female" value="F" {{ ($entity) ? (($entity->sex=='F') ? 'checked' : '') : '' }}>
                                <label for="female">Female</label>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-sm-2">
                            <span>Contact:</span>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="contact_number" value="{{ ($entity) ? $entity->contact_number : '' }}">
                                    <label class="form-label">Mobile Number</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="email" class="form-control" name="email" value="{{ ($entity) ? $entity->email : '' }}">
                                    <label class="form-label">E-mail</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-sm-2">
                            <span>Address:</span>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <select class="form-control show-tick" name="province" id="province">
                                        <option value="">Select Province</option>
                                        @foreach ($provinces as $province)
                                        <option value="{{ $province->code }}" {{ ($entity) ? (($province->code == $entity->province) ? 'selected' : '') : (($province->code == '0712') ? 'selected' : '') }}>{{ $province->description }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-sm-2">
                            <span></span>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <select class="form-control show-tick" name="municipality" id="municipality">
                                        <option value="">Select Municipality</option>
                                        @foreach ($towns as $town)
                                        <option value="{{ $town->code }}" {{ ($entity) ? (($town->code == $entity->municipality) ? 'selected' : '') : (($town->code == '071244') ? 'selected' : '') }}>{{ $town->description }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>  
                    </div>
                    <div class="row clearfix">
                        <div class="col-sm-2">
                            <span></span>
                        </div>
                        <div class="col-sm-6">
                            
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <select class="form-control show-tick" name="barangay" id="barangay">
                                        <option value="">Select Barangay</option>
                                        @foreach ($brgys as $brgy)
                                        <option value="{{ $brgy->code }}" {{ ($entity) ? (($brgy->code == $entity->barangay) ? 'selected' : '') : '' }}>{{ strtoupper($brgy->description) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-sm-2">
                            <span></span>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group form-float">
                                <div class="form-line">
                                <input list="puroks" class="form-control show-tick" name="purok" id="purok" placeholder="Search Purok / Type Sitio" value="{{ ($entity) ? $entity->purok : '' }}">
                                    <datalist id="puroks">
                                        <option value="PUROK 1">
                                        <option value="PUROK 2">
                                        <option value="PUROK 3">
                                        <option value="PUROK 4">
                                        <option value="PUROK 5">
                                        <option value="PUROK 6">
                                        <option value="PUROK 7">
                                    </datalist>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-sm-12 float-right">
                            <div class="btn-group">
                                <button type="submit" class="btn btn-primary waves-effect btn-save">
                                    <i class="material-icons">save</i>
                                    <span>Save</span>
                                </button>
                                <a href="{{ route('entity') }}" class="btn btn-default waves-effect btn-back">
                                    <i class="material-icons">undo</i>
                                    <span>Back</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="footer">
                
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // $('#province').select2()
    // $('#municipality').select2()
    // $('#barangay').select2();

    var type = "{{ old('entity-type') }}";
    $('.group-field').hide();

    $('.entity-type').on('change', function(){
        var type = $(this).val();    
        changeEntityType(type);
    })

    changeEntityType(type);

    function changeEntityType(type){
        if (type == 'group'){
            $('.name-field').hide();
            $('.group-field').show();
        }
        else{
            $('.name-field').show();
            $('.group-field').hide();
        }
    }

    $('select[name="province"]').on('change', function() {
        var code = $(this).val();

        $.ajax({
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/address/towns/'+code,
            method: 'POST',
            dataType: 'JSON',
            success: function(result) {
                $('#municipality').html('');
                $('#municipality').append('<option value="">Select Municipality</option>');
                $.each(result, function (key, value) {
                    $('#municipality').append('<option value="'+value['code']+'">'+value['description']+'</option>');
                });
            }
        })
    });

    $('select[name="municipality"]').on('change', function() {
        var code = $(this).val();

        $.ajax({
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/address/barangays/'+code,
            method: 'POST',
            dataType: 'JSON',
            success: function(result) {
                $('#barangay').html('');
                $('#barangay').append('<option value="">Select Barangay</option>');
                $.each(result, function (key, value) {
                    $('#barangay').append('<option>'+value['description'].toUpperCase()+'</option>');
                });
            }
        })
    });

    // $('#frm').on('submit', function(e){
    //     e.preventDefault();

    //     $.ajax({
    //         headers: {
    //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         },
    //         url: '{{ route("store-entity") }}',
    //         method: 'POST',
    //         data: $('#frm').serialize(),
    //         dataType: 'JSON',
    //         success: function(result) {
    //             // swal({
    //             //     title: result['title'],
    //             //     type: result['icon'],
    //             //     text: result['message'],
    //             //     confirmButtonText: "Okay",
    //             // },
    //             // function(isConfirm){
    //             //     if (isConfirm) {
    //             //         getPermissions(1);
    //             //     }
    //             // });
    //         },
    //         error: function(obj, err, ex){
    //             swal("Server Error", err + ": " + obj.toString() + " " + ex, "error");
    //         }
    //     })
    // });
</script>
@endpush