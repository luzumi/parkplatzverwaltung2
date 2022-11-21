@php use App\Models\Car;use App\Models\ParkingSpot;use App\Models\User; @endphp
@extends('welcome')
@section('title', $viewData["title"])
@section('subtitle', $viewData["subtitle"])
@section('content')
    <div class="card mb-3">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="{{ asset('/storage/media/'. $viewData['user']->getImage()) }}"
                     class="img-card rounded-start"
                     alt="Image not found">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">
                        Name: {{ $viewData["user"]->getName() }} <br>
                        eMail: {{ $viewData["user"]->getEmail() }} <br>
                        Telefon: {{ $viewData["user"]->getTelefon() }} <br>

                        Land: {{ $viewData["address"]['Land'] }} <br>
                        PLZ: {{ $viewData["address"]['PLZ'] }} <br>
                        Stadt: {{ $viewData["address"]['Stadt'] }} <br>
                        Straße: {{ $viewData["address"]['Strasse'] . " "
                        . $viewData["address"]['Nummer'] }} <br>
                        <br>
                        <p class="mb-sm-auto">Letzter Login: {{ $viewData["user"]->getupdatedAt() }}</p>
                        User-Rolle: {{ $viewData["user"]->getRole() }} <br><br>
                        <p class="card-text">
                            <a class="align-content-lg-center"
                               href="{{ route('user.editor-id', $viewData["user"]->getId()) }}">
                                <small class="text-muted">Userdaten bearbeiten</small>
                            </a>
                        </p>
                        <br>

                        Fahrzeuge:
                        <table class="table table-bordered">
                            <tr class="table-primary">
                                <th>Kennzeichen</th>
                                <th>Hersteller</th>
                                <th>Model</th>
                                <th>Farbe</th>
                                <th>Vorschau</th>
                                <th>Parkplatz</th>
                            </tr>
                            <object{{ $i = 0 }}>
                            @foreach($viewData['cars'] as $car)
                                    <tr class="table-active">
                                        <td>{{ $car->sign }}</td>
                                        <td>{{ $car->manufacturer }}</td>
                                        <td>{{ $car->model }}</td>
                                        <td>{{ $car->color }}</td>
                                        <td>
                                        @if(!isset($viewData['cars'][$i++]->parkingSpot->number))
                                                <a href="{{ route('cars.show', ['id'=> $car->getId()]) }}">
                                                    <img src="{{ asset('/storage/media/'. $car->image) }}"
                                                         class="img-thumbnail row-cols-sm-4" alt="image not found">
                                                </a>
                                            @else
                                                <img src="{{ asset('/storage/media/'. $car->image) }}"
                                                     class="img-thumbnail row-cols-sm-4" alt="image not found">
                                            @endif
                                        </td>
                                        <td>{{ $car->parkingSpot->number ?? ''}} </td>
                                    </tr>
                            @endforeach
                        </table>
                    </h5>
{{--                    {{dd($viewData['address']['Strasse'])}}--}}
                </div>
            </div>
        </div>
    </div>
@endsection
