@extends('layouts.app')

@section('content')
        <div class="flex-center position-ref full-height">
            <div class="container">
                @foreach ($models as $u)
                    {{ $u->user }}
                @endforeach
            </div>

            {!! $models->render() !!}
        </div>
         <!--<script src="//{{ Request::getHost() }}:6001/socket.io/socket.io.js"></script>-->
             <script src="/js/pusher.min.js"></script>
           <script>
                 Pusher.logToConsole = true;
                var pusher = new Pusher('6ab827fb733f86beff8b', {
                  encrypted: true
                });

                var channel = pusher.subscribe('douban.1');
                channel.bind('server.douabn', function(data) {
                  console.log(data);
                });
            </script>
@endsection
