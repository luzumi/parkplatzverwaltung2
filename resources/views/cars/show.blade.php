@extends('layouts.app')
@section('title', $viewData["title"])
@section('subtitle', $viewData["subtitle"])
@section('content')
    <div class="card mb-3">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="{{ asset('/img/'.$viewData['car']->getImage()) }}" class="img-fluid rounded-start" alt="Image not found">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">
                        {{ $viewData["car"]->getManufacturer() }}
                        {{ $viewData["car"]->getModel() }}
                        {{ $viewData["car"]->getColor() }}
                    </h5>
                    <p class="card-text">{{ $viewData["car"]->getSign() }}</p>
                    <p class="card-text"><small class="text-muted">Parkplatz reservieren</small></p>
                </div>
            </div>
        </div>
    </div>
@endsection
