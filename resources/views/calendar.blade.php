@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center" style="margin-bottom: 1rem">
        <div class="col-sm-3 justify-content-center">
            <a href="{{ route('google-login') }}" class="btn btn-primary">Refresh</a>
        </div>
        <div class="col-sm-3 justify-content-center">
            <a href="{{ route('login') }}" class="btn btn-primary">Back to Login Page</a>
        </div>
    </div>
    <div class="row justify-content-center">
        @foreach($calendarEvents['2018'] as $key => $events)
            <div class="col-xs-1">
                <table class="table table-striped">
                    <tr>
                        <th class="text-center">{{ $key }}</th>
                    </tr>
                    @foreach($events as $key => $event)
                        <tr>
                            <td @if(isset($event['color'])) style="background-color: {{ $event['color'] }}" @endif><sup class="text-left align-text-top">{{$key }} </sup><span class="text-center align-middle">{{ isset($event['summary']) ? $event['summary'] : '' }}</span></td>
                        </tr>
                    @endforeach
                </table>
            </div>
        @endforeach
    </div>
</div>
@endsection
