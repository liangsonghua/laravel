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
@endsection
