@extends('index')
@section('content')

<div class="page-inner">
    <div class="panel-header">
        <div class="page-header">
            <h4 class="page-title">Reports</h4>
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
                    <a href="#">Reports</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card p-3">
                <div class="body">

                    <div class="row">
                        <div class="col-sm-3">
                            
                            <b>Document Category</b>
                            <div class="input-icon">
                                <span class="input-icon-addon">
                                    <i class="fas fa-layer-group"></i>
                                </span>
                                <select class="form-control show-tick" name="category" id="category" required>
                                    <option value="">All Types</option>
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">
                                        {{ $category->category }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                        <div class="col-sm-3">
                            
                            <b>Date From</b>
                            <div class="input-icon">
                                <span class="input-icon-addon">
                                    <i class="far fa-calendar-alt"></i>
                                </span>
                                <input type="date" class="form-control" id="date_from" name="date_from" value="{{ date('Y-m-01') }}" required>
                            </div>

                        </div>
                        <div class="col-sm-3">
                            
                            <b>Date To</b>
                            <div class="input-icon">
                                <span class="input-icon-addon">
                                    <i class="far fa-calendar-alt"></i>
                                </span>
                                <input type="date" class="form-control" id="date_to" name="date_to" value="{{ date('Y-m-t') }}" required>
                            </div>

                        </div>
                        <div class="col-sm-3">
                            <br>
                            <button type="button" class="btn btn-md btn-primary generate-report"><i class="fas fa-spinner mr-2"></i>Generate</button>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12 results">
                            
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')
<script>
    $('.generate-report').on('click', function(){
        var category = $('#category').val(),
            date_from = $('#date_from').val(),
            date_to = $('#date_to').val();

        $.ajax({
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/reports/displayReports',
            method: 'POST',
            data: {'category': category,
                    'date_from': date_from,
                    'date_to': date_to},
            dataType: 'HTML',
            beforeSend: function() {
                $('.results').html('<br><br><div class="progress" style="height: 13px;">' +
                                    '<div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 100%">' +
                                    '<span class="sr-only">40% Complete (success)</span>' +
                                    '</div>' +
                                    '</div>');
            },
            success: function(result) {
                $('.results').html(result);
            },
            error: function(obj, err, ex){
                swal("Server Error", err + ": " + obj.toString() + " " + ex, "error");
            }
        })
    });
</script>
@endpush