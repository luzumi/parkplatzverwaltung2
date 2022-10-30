@extends('layouts.app')
@section('title', $viewData["title"])
@section('content')
    <div class="row">
        <div class="col-md-6 col-lg-4 mb-2">
            <img src="{{ asset('/img/unregistered_user.png') }}" class="img-fluid rounded" alt="image not found">
        </div>
        <div class="col-md-6 col-lg-4 mb-2">
            <img src="{{ asset('/img/parking_area.png') }}" class="img-fluid rounded" alt="image not found">
        </div>
        <div class="col-md-6 col-lg-4 mb-2">
            <img src="{{ asset('/img/admin_user.png') }}" class="img-fluid rounded" alt="image not found">
        </div>
    </div>
@endsection
