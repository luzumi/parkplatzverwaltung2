@extends('layouts.app')
@section('title', $viewData["title"])
@section('subtitle', $viewData["subtitle"])
@section('content')
    <div class="card mb-3">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="{{ asset('/storage/media/'. $viewData['car']->image) }}" class="img-fluid rounded-start" alt="Image not found">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">
                        Name: {{ $viewData["user"]->name }} <br>
                        eMail: {{ $viewData["user"]->email }} <br>
                        Telefon: {{ $viewData["user"]->telefon }} <br>
                        User-Rolle: {{ $viewData["user"]->role }} <br>
                    </h5>
                    <img src="{{ asset('/storage/media/'. $viewData['user']->image) }}" class="img-fluid rounded-start" alt="Image not found">
                    Letzter Login: <p class="card-text">{{ $viewData["user"]->updatedAt }}</p>
                    <p class="card-text"><small class="text-muted">Userdaten bearbeiten</small></p>
                </div>
            </div>
        </div>
    </div>
@endsection
