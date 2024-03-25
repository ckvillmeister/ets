<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{ config('app.name') }}</title>
    <link rel="icon" href="{{ asset('images/trinidad-logo.png') }}" type="image/x-icon">
    <link href="{{ asset('atlantis/assets/css/fonts.min.css') }}" rel="stylesheet">
    <link href="{{ asset('atlantis/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('atlantis/assets/css/atlantis.min.css') }}" rel="stylesheet">
    <link href="{{ asset('atlantis/assets/css/cards-gallery.css') }}" rel="stylesheet">
    <link href="{{ asset('adminbsb/plugins/node-waves/waves.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('adminbsb/plugins/animate-css/animate.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('adminbsb/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />
    <link href="{{ asset('adminbsb/css/themes/all-themes.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('adminbsb/plugins/sweetalert2/dist/sweetalert2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('adminbsb/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet" />
    <link href="{{ asset('adminbsb/plugins/dropzone/dropzone.css') }}" rel="stylesheet">
    <link href="{{ asset('adminbsb/plugins/upload-master/dist/ssi-uploader/styles/ssi-uploader.min.css') }}" rel="stylesheet" />
    @stack('css')
   

</head>

<body>
    <div class="wrapper">

        @include('admin-panel-components.navbar')
        @include('admin-panel-components.sidebar')

        <div class="main-panel">
            <div class="content">
                @yield('content')
            </div>
        </div>
    </div>
    
    <audio id="pop">
      <source src="{{ asset('sound/notification.mp3') }}" type="audio/mpeg">
    </audio>
</body>
<footer>
    <script src="{{ asset('atlantis/assets/js/core/jquery.3.2.1.min.js') }}"></script>
    <script src="{{ asset('atlantis/assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('atlantis/assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('atlantis/assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('atlantis/assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js') }}"></script>
    <script src="{{ asset('atlantis/assets/js/atlantis.min.js') }}"></script>
    <script src="{{ asset('atlantis/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>
    <script src="{{ asset('atlantis/assets/js/plugin/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('atlantis/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
    <script src="{{ asset('adminbsb/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>
    <script src="{{ asset('adminbsb/plugins/jquery-slimscroll/jquery.slimscroll.js') }}"></script>
    <script src="{{ asset('adminbsb/plugins/node-waves/waves.js') }}"></script>
    <script src="{{ asset('adminbsb/plugins/sweetalert2/dist/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('adminbsb/plugins/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('adminbsb/plugins/upload-master/dist/ssi-uploader/js/ssi-uploader.min.js') }}"></script>
    <script src="{{ asset('adminbsb/plugins/momentjs/moment.js') }}"></script>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script>
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('18669f53ffa7e0c4529c', {
          cluster: 'ap1'
        });

        var channel = pusher.subscribe('document-stored');
        channel.bind('notif', function(data) {
            var content = {};

            content.title = 'Notification';
            content.message = data['message'] + " (<b>" + moment().fromNow() + "</b>)";
            content.icon = 'fa fa-bell';

            $('audio#pop')[0].play();

            $.notify(content,{
                type: 'primary',
                placement: {
                    from: 'top',
                    align: 'right'
                },
                time: 1000,
                delay: 0,
            });

          //alert(JSON.stringify(data['message']));
        });

        function notif(){
            $.ajax({
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/notifyl',
                method: 'GET',
                dataType: 'HTML',
                success: function(result) {
                    
                }
            })
        }
    </script>
    @stack('scripts')
</footer>

</html>