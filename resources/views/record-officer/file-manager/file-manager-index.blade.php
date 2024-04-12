@extends('layouts.admin-layout')

@section('content')

    <file-manager-index
        prop-employee-id="{{ $id }}"></file-manager-index>

@endsection


