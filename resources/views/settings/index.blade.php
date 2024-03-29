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
                    <a href="#">Settings</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card p-3">
                <div class="body">


                    <div class="row">
                        <div class="col-sm-2">
                            <div class="nav flex-column nav-pills nav-secondary nav-pills-no-bd nav-pills-icons" id="v-pills-tab-with-icon" role="tablist" aria-orientation="vertical">
                                <a class="nav-link active show" id="v-pills-backup-tab-icons" data-toggle="pill" href="#v-pills-backup-icons" role="tab" aria-controls="v-pills-backup-icons" aria-selected="false">
                                    <i class="flaticon-tool"></i>
                                    Back-up
                                </a>
                                <a class="nav-link" id="v-pills-home-tab-icons" data-toggle="pill" href="#v-pills-home-icons" role="tab" aria-controls="v-pills-home-icons" aria-selected="true">
                                    <i class="flaticon-folder"></i>
                                    Other Settings
                                </a>
                            </div>
                        </div>
                        <div class="col-sm-10">
                            <div class="tab-content" id="v-pills-with-icon-tabContent">
                                <div class="tab-pane fade active show" id="v-pills-backup-icons" role="tabpanel" aria-labelledby="v-pills-backup-tab-icons">
                                    <h3>Back-up Files and Database</h3><br><br>
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <b>Back-up Database:</b>
                                        </div>
                                        <div class="col-sm-2">
                                            <a href="{{ route('backup-db') }}" class="btn btn-sm btn-primary"><i class="fas fa-database mr-2"></i>Click to Backup Database</a>
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-sm-2">
                                            <b>Back-up Files:</b>
                                        </div>
                                        <div class="col-sm-2">
                                            <a href="{{ route('backup-files') }}" class="btn btn-sm btn-primary"><i class="fas fa-file-archive mr-2"></i>Click to Backup Files</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="v-pills-home-icons" role="tabpanel" aria-labelledby="v-pills-home-tab-icons">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    

                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script type="text/javascript">
</script>
@endpush