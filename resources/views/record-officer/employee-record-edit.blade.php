@extends('layouts.admin-layout')

@section('content')

    <employee-record-edit
        prop-civils='@json($civils)'
        prop-citizenships='@json($citizenships)'
        prop-data='@json($user)'></employee-record-edit>

@endsection


