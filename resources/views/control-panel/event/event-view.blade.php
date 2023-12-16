@extends('layouts.admin-layout')

@section('content')
    <event-view 
        :prop-event-attendees='@json($eventAttendees)'>
    </event-view>
@endsection
