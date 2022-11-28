@extends('layouts.app')
@section('title', $viewData["title"])
@section('subtitle', $viewData["subtitle"])
@section('content')
    <div class="row">
        @foreach ($viewData["cars"] as $car)
            <div class="col-md-4 col-lg-3 mb-2">
                <div class="card">
                    <img src="{{ asset('/storage/'.$car->image) }}" class="img-card" alt="Image not found">
                    <div class="card-body text-center">
                        <a href="{{ route('cars.show', ['id'=> $car->id]) }}"
                           class="btn bg-primary text-white">{{ $car->sign }}</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
