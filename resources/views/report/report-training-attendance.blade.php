@extends('layouts.print-portrait-layout')

@section('content')
    <report-training-attendance :prop-id="{{$id}}"></report-training-attendance>
@endsection


