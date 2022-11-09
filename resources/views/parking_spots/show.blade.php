@extends('layouts.app')
@section('title', $viewData["title"])
@section('subtitle', $viewData["subtitle"])

@section("content")
    <div class="card mb-3">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="{{ asset('/storage/'. $viewData['parking_spot']->getImage()) }}"
                     class="img-fluid rounded-start" alt="Image not found">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">
                        Parkplatz {{ $viewData["parking_spot"]->getNumber() }}, Reihe
                        {{ $viewData["parking_spot"]->getRow() }},<br>
                        {{ $viewData["parking_spot"]->getStatusMessage() }}
                        | {{ $viewData["parking_spot"]->getStatus() }}
                    </h5>

                    @if($viewData["parking_spot"]->getStatus() == 'frei')
                        <form method="POST" action="{{ route('parking_spots.reserve_index',  $viewData["parking_spot"]->getNumber()) }}" enctype="multipart/form-data">
                            @csrf

                            <h5 class="card-title">
                                Name: {{ $viewData["user"]->getName() }} <br><br>
                                Fahrzeuge:
                                <table class="table table-bordered">
                                    <tr class="table-primary">
                                        <th>Auswahl</th>
                                        <th>Kennzeichen</th>
                                        <th>Hersteller</th>
                                        <th>Model</th>
                                        <th>Farbe</th>
                                        <th>Vorschau</th>
{{--                                        TODO anzeigen welchen parkplatz das auto belegt--}}
                                    </tr>
                                    @foreach($viewData['cars'] as $car)
                                        <tr class="table-active">
                                            <td>
                                                <div class="radio">
                                                    <label class="input-group-sm">
                                                        <input type="radio" id='{{ $car->id }}' name="radio">
                                                    </label>
                                                </div>
                                            </td>
                                            <td>{{ $car->sign }}</td>
                                            <td>{{ $car->manufacturer }}</td>
                                            <td>{{ $car->model }}</td>
                                            <td>{{ $car->color }}</td>
                                            <td><img src="{{ asset('/storage/'. $car->image) }}"
                                                     class="img-thumbnail col-sm-6" alt="image not found"></td>
                                        </tr>
                                    @endforeach
                                </table>
                            </h5>

                            <button type="submit" class="btn btn-primary">Absenden</button>
                        </form>
                    @endif

                    Letzte Änderung: <p class="card-text">{{ $viewData["parking_spot"]->getUpdatedAT() }}</p>
                    <p class="card-text"><small class="text-muted">****************************</small></p>
                    <a href="{{ route('user.show', Auth::id()) }}"
                       class="btn {{ $viewData["parking_spot"]->switchStatus() }} text-white offset-lg-7">
                        zurück zur Übersicht
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
