@extends('layouts.admin-layout')

@section('content')

    @if($id > 0)
        <training-seminar-create-edit :prop-id="{{ $id }}"
            :prop-data='@json($data)'></training-seminar-create-edit>
    @else
        <training-seminar-create-edit :prop-id="0"
            :prop-data='{}'></training-seminar-create-edit>
    @endif


@endsection