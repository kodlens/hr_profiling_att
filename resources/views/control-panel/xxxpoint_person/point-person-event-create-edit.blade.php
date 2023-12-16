@extends('layouts.point-person-layout')

@section('content')

    @if($id > 0)
        <point-person-event-create-edit :prop-id="{{ $id }}"
            :prop-data='@json($data)'></point-person-event-create-edit>
    @else
        <point-person-event-create-edit :prop-id="0"
            :prop-data='{}'></point-person-event-create-edit>
    @endif


@endsection