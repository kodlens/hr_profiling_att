@extends('layouts.point-person-layout')

@section('content')
    <point-person-event-view 
        :prop-event-attendees='@json($eventAttendees)'>
    </point-person-event-view>
@endsection
