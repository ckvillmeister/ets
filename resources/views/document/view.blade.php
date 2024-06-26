@extends('index')
@section('content')

<style>
    .gallery img:hover {
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

            @if(!$document)
            <div class="row">
                <div class="col-sm-4"></div>
                <div class="col-sm-4">
                    <div class="card-body cart zero-results">
                        <div class="col-sm-12 empty-cart-cls text-center">
                            <img src="{{ asset('images/empty.gif') }}" width="250" height="250" class="img-fluid mb-4 mr-3">
                            <h3><strong>Document Not Found!</strong></h3>
                            <h5>Are you sure you provided the correct document ID?</h5>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4"></div>
            </div>

            @else
            <div class="card p-3">
                <div class="card-header">
                    <h4><i class="fas fa-file mr-2"></i>Document Info</h4>
                </div>
                @php ($category = $document->category()->first()->category)

                <div class="card-body" id="content">
                    
                    <div class="row">
                        <div class="col-sm-5">
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
                                <label>{{ (str_contains($category, 'Incoming')) ? 'From' : 'For' }}</label>
                                <h2><b>{{ $document->sender }}&nbsp;{{ ($document->datetimesent) ? '(Date Sent: '.date('F d, Y @ h:i A', strtotime($document->datetimesent)).')' : '' }}</b></h2>
                            </div>
                            @endif

                            @if ($document->recipient)
                            <div class="form-group">
                                <label>Received by:</label>
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
                        <div class="col-sm-7">
                            <ul class="nav nav-pills nav-secondary" id="pills-tab" role="tablist">
                                <li class="nav-item submenu">
                                    <a class="nav-link active show" id="pills-attachments-tab" data-toggle="pill" href="#pills-attachments" role="tab" aria-controls="pills-attachments" aria-selected="true">Attachments</a>
                                </li>
                                <li class="nav-item submenu">
                                    <a class="nav-link" id="pills-logs-tab" data-toggle="pill" href="#pills-logs" role="tab" aria-controls="pills-logs" aria-selected="false">Logs</a>
                                </li>
                            </ul>
                            <div class="tab-content mt-2 mb-3" id="pills-tabContent">
                                <div class="tab-pane fade active show" id="pills-attachments" role="tabpanel" aria-labelledby="pills-attachments-tab">
                                     <!-- <div class="form-group">
                                        <label>Attachments</label>
                                    </div> -->

                                    <div class="row gallery">
                                    @php ($index = 0)
                                    @php ($attachments = $document->attachments) 
                                    @foreach ($attachments as $attachment)
                                        @php ($path='files/'.$attachment->info()->first()->filename)
                                        @php ($type=$attachment->info()->first()->type)
                                            
                                            <div class="col-md-5">
                                                <div class="card border-0 transform-on-hover" style="height: 400px !important">
                                                    <div class="card-body">
                                                        <a class="lightbox" href="#">
                                                            @if (in_array($type,  ['jpg', 'jpeg', 'png', 'bmp', 'gif']))
                                                                <img src="{{ asset($path) }}" class="card-img-top" data-file="image" data-index="{{ $index++ }}">
                                                            @elseif ($type == 'pdf')
                                                                <div class="text-center">
                                                                    <i class="far fa-file-pdf pt-4" style="height: 150px; font-size: 80pt"></i>
                                                                </div>
                                                            @elseif ($type == 'docx')
                                                                <div class="text-center">
                                                                    <i class="far fa-file-word pt-4" style="height: 150px; font-size: 80pt"></i>
                                                                </div>
                                                            @endif
                                                        </a>
                                                    </div>
                                                    <div class="card-footer text-center">
                                                        <button class="btn btn-sm btn-primary waves-effect" data-url="{{ asset($path) }}" title="Print File" role="button" onclick="print()"><i class="fas fa-print mr-2"></i>Print
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        
                                    @endforeach
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-logs" role="tabpanel" aria-labelledby="pills-logs-tab">
                                    
                                    <table class="table table-xs table-hover table-striped table-condensed" id="tbl" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No</th>
                                                <th class="text-center">Action</th>
                                                <th class="text-center">Created / Modified By</th>
                                                <th class="text-center">Date Created / Modified</th>
                                            </tr>
                                        </thead>
                                        <tbody id="table-filelist">
                                            @php ($ctr = 1)
                                            @foreach ($document->history_logs as $logs)
                                            <tr class="text-center">
                                                <td class="text-center">{{ $ctr++ }}</td>
                                                <td class="text-center td-image">
                                                    {{ \App\Enums\Actions::$actions[$logs->action] }}
                                                </td>
                                                <td>{{ $logs->executor()->first()->firstname.' '.$logs->executor()->first()->lastname }}</td>
                                                <td>{{ date('F d, Y h:i A', strtotime($logs->execution_date)) }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>

                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            @endif

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
    function print() {
        var title = "{{ ($document) ? $document->title : '' }}";
        var url = $(event.target).attr('data-url');  

        var mywindow = window.open('', title, 'height=800,width=1020,scrollbars=yes');
          mywindow.document.write('<html><head>');
          mywindow.document.write('<title>'+title+'</title>');
          mywindow.document.write('</head><body>');
          mywindow.document.write('<center><img src="'+url+'" style="width: 650px"></center>');
          mywindow.document.write('</body></html>');
          mywindow.document.close();
          setTimeout(function(){
              mywindow.focus();
              mywindow.print();    
          },1000);           
    }     
    
    $('[data-file=image]').click(function (e) {
        e.preventDefault();

        var items = [],
            options = {
            index: $(this).attr('data-index'),
            initMaximized: true
        };

        //console.log(options);

        $(".gallery img").each(function() {  
            imgsrc = this.src;
            //console.log(imgsrc);
            items.push({
                src: imgsrc
            });
        });  
        
        new PhotoViewer(items, options);
    });
</script>
@endpush