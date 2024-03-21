@extends('index')
@section('content')

<style>
    img:hover {
        cursor: -moz-zoom-in; 
        cursor: -webkit-zoom-in; 
        cursor: zoom-in;
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
                    <a href="#">View</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card p-3">
                <div class="card-header">
                    <h4><i class="fas fa-file mr-2"></i>Document Info</h4>
                </div>
                @php ($category = $document->category()->first()->category)

                <div class="card-body" id="content">
                    
                    <div class="row">
                        <div class="col-sm-6">
                            @if ($document->series)
                            <div class="form-group">
                                <label>No.</label>
                                <h2><b>{{ $document->series }}</b></h2>
                            </div>
                            @endif

                            <div class="form-group">
                                <label>Document Title</label>
                                <h2><b>{{ $document->title }}</b></h2>
                            </div>

                            <div class="form-group">
                                <label>Description</label>
                                <h2><b>{{ $document->description }}</b></h2>
                            </div>

                            @if ($document->sender)
                            <div class="form-group">
                                <label>Sender</label>
                                <h2><b>{{ $document->sender }}&nbsp;{{ ($document->datetimesent) ? '(Date Sent: '.date('F d, Y @ h:i A', strtotime($document->datetimesent)).')' : '' }}</b></h2>
                            </div>
                            @endif

                            @if ($document->recipient)
                            <div class="form-group">
                                <label>Recipient</label>
                                <h2><b>{{ $document->recipient }}&nbsp;{{ ($document->datetimereceived) ? '(Date Received: '.date('F d, Y @ H:i A', strtotime($document->datetimereceived)).')' : '' }}</b></h2>
                            </div>
                            @endif


                            <div class="form-group">
                                <label>Category</label>
                                <h2><b>{{ $category }}</b></h2>
                            </div>

                            <div class="form-group">
                                <label>Date Created</label>
                                <h2><b>{{ date('F d, Y', strtotime($document->doc_date)) }}</b></h2>
                            </div>

                            <div class="form-group">
                                <a href="{{ url('document/update?id='.$document->id) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit mr-2"></i>Edit Document</a>
                            </div>

                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Attachments</label>
                            </div>

                            <div class="row gallery">
                            @php ($index = 0)
                            @php ($attachments = $document->attachments) 
                            @foreach ($attachments as $attachment)
                                @php ($path='files/'.$attachment->info()->first()->filename)
                                @php ($type=$attachment->info()->first()->type)
                                    
                                    <div class="col-md-5">
                                        <div class="card border-0 transform-on-hover">
                                            <a class="lightbox" href="#">
                                                
                                            </a>
                                            <div class="card-body">
                                                @if (in_array($type,  ['jpg', 'jpeg', 'png', 'bmp', 'gif']))
                                                    <img src="{{ asset($path) }}" class="card-img-top" style="height: 150px" data-file="image" data-index="{{ $index++ }}">
                                                @elseif ($type == 'pdf')
                                                    <div class="text-center">
                                                        <i class="far fa-file-pdf pt-4" style="height: 150px; font-size: 80pt"></i>
                                                    </div>
                                                @elseif ($type == 'docx')
                                                    <div class="text-center">
                                                        <i class="far fa-file-word pt-4" style="height: 150px; font-size: 80pt"></i>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                
                            @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('css')
<link href="{{ asset('adminbsb/plugins/photoviewer-master/dist/photoviewer.min.css') }}" rel="stylesheet" />
@endpush
@push('scripts')
<script src="{{ asset('adminbsb/plugins/photoviewer-master/dist/photoviewer.min.js') }}"></script>
<script>
    
    $('[data-file=image]').click(function (e) {
        e.preventDefault();

        var items = [],
            options = {
            index: $(this).attr('data-index'),
            initMaximized: true
        };

        console.log(options);

        $(".gallery img").each(function() {  
            imgsrc = this.src;
            console.log(imgsrc);
            items.push({
                src: imgsrc
            });
        });  
        
        new PhotoViewer(items, options);
    });
</script>
@endpush