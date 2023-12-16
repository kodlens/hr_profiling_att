@extends('layouts.admin-layout')

@section('content')
    <training-seminar-participant-index
        :prop-training-seminar-id="{{ $id }}"
        :prop-data='@json($data)'></training-seminar-participant-index>
@endsection