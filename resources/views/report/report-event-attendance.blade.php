@extends('layouts.print-portrait-layout')

@section('content')
    <report-event-attendance :prop-id="{{$id}}"></report-event-attendance>
@endsection


