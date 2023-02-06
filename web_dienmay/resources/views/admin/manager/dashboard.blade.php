@extends('admin.layout.app')
@section('title', 'Dashboard')
@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">

             <h3>Welcome to Admin : {{Auth::user()->email}}</h3>

        </div>
    </div>
@endsection
@push('scripts-custom')


@endpush

