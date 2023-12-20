@extends('databatablebase')
@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
@section('body_content')
    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif
{{--    <a href="{{url("/create_task/")}}" class="btn btn-sm btn-success">Add task</a>--}}
    <a href="{{route("create_link")}}" class="btn btn-sm btn-success">Add task</a>
    <div class="container">
        <div class="card">
            <div class="card-header">Manage Users</div>
            <div class="card-body">
                {{ $dataTable->table() }}
            </div>
        </div>
    </div>
@stop

