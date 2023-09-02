@extends('layouts.employee-layout')

@section('content')
    <employee-personal-data-sheet prop-civils='@json($civils)'
        prop-citizenships='@json($citizenships)'
        prop-data='@json($user)'>
    </employee-personal-data-sheet>
@endsection
