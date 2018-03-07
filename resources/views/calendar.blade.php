@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center" style="margin-bottom: 1rem">
        <div class="col-sm-3 justify-content-center">
            <a href="{{ route('google-login') }}" class="btn btn-primary">Refresh</a>
        </div>
        <div class="col-sm-3 justify-content-center">
            <a href="{{ route('login') }}" class="btn btn-primary">Back to Login Page</a>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-xs-12 small">
            <table class="table table-striped">
                @foreach($calendarEvents['2018'] as $key => $events)
                    <tr>
                        <td class="text-center">{{ $key }}</td>
                        @foreach($events as $key => $event)
                            <td @if(isset($event['color'])) style="background-color: {{ $event['color'] }}" @endif><sup class="text-left align-text-top">{{$key }} </sup><span class="text-center align-middle">{{ isset($event['summary']) ? $event['summary'] : '' }}</span></td>
                        @endforeach
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
@endsection
