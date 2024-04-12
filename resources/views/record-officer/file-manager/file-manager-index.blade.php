@extends('layouts.admin-layout')

@section('content')

    <file-manager-index
        :prop-data='@json($data)'></file-manager-index>

@endsection


