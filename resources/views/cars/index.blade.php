@extends('layouts.app')
@section('title', $viewData["title"])
@section('subtitle', $viewData["subtitle"])
@section('content')
    <div class="row">
        @foreach ($viewData["cars"] as $car)
            <div class="col-md-4 col-lg-3 mb-2">
                <div class="card">
                    <img src="{{ asset('/storage/'.$car->getImage()) }}" class="card-img-top" alt="Image not found">
                    <div class="card-body text-center">
                        <a href="{{ route('cars.show', ['id'=> $car->getId()]) }}"
                           class="btn bg-primary text-white">{{ $car->getSign() }}</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
