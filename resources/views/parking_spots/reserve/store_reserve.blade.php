@extends('layouts.app')
@section('title', $viewData["title"])
@section('subtitle', $viewData["subtitle"])

@section("content")
    <div class="card mb-3">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="{{ asset('/storage/media/' . $viewData['parking_spot']->image) }}"
                     class="img-fluid rounded-start" alt="Image not found">
            </div>
            <div class="col-md-12">
                <div class="card-body">
                    <h3 class="offset-lg-5">
                        <h5 class="card-body ">
                            Der Parkplatz Nr.<strong>{{ $viewData['parking_spot']->number }}</strong>
                            wurde für Ihr Fahrzeug mit dem Kennzeichen
                            <strong>{{ $viewData['cars']->first()->getAttribute('sign') }}</strong>
                            zur Reservierung angemeldet.
                        </h5>
                    </h3>
                </div>
            </div>
            <div class="alert-dark">
                <a href="{{ route('user.show', Auth::id()) }}"
                   class="btn rounded-bottom text-white offset-lg-5">
                    zurück zur Übersicht
                </a>
            </div>
        </div>
    </div>



@endsection
