@extends('layouts.app')
@section('title', $viewData["title"])
@section('subtitle', $viewData["subtitle"])

@section("content")
    <div class="card mb-3">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="{{ asset('/img/'.$viewData['parking_spot']->getImage()) }}" class="img-fluid rounded-start" alt="Image not found">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">
                        Parkplatz {{ $viewData["parking_spot"]->getNumber() }}, Reihe
                        {{ $viewData["parking_spot"]->getRow() }},<br>
                        {{ $viewData["parking_spot"]->getStatus()? 'Frei' : 'Besetzt' }}
                    </h5>
                    Letzte Änderung: <p class="card-text">{{ $viewData["parking_spot"]->getUpdatedAT() }}</p>
                    <p class="card-text"><small class="text-muted">****************************</small></p>
                    <a href="{{ route('parking_spot.index') }}" class="btn bg-primary text-white>">
                        zurück zur Übersicht
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
