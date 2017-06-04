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
    <script src="//{{ Request::getHost() }}:6001/socket.io/socket.io.js"></script>
    <script>
         var socket = io('http://localhost:6001');
         socket.on('douban.1', function (data) {
            console.log(data);
      });

    </script>
           
@endsection
