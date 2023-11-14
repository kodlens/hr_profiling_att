@extends('layouts.admin-layout')

@section('content')
    <event-create-edit id=""></event-create-edit>

    @if($id > 0)
        <event--create-edit :prop-id="{{ $id }}"
            :prop-data='@json($data)'></event--create-edit>
    @else
        <event--create-edit :prop-id="0"
            :prop-data='{}'></event--create-edit>
    @endif


@endsection