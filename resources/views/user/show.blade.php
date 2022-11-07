@extends('welcome')
@section('title', $viewData["title"])
@section('subtitle', $viewData["subtitle"])
@section('content')
    <div class="card mb-3">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="{{ asset('/storage/'. $viewData['user']->getImage()) }}" class="img-fluid rounded-start"
                     alt="Image not found">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">
                        Name: {{ $viewData["user"]->getName() }} <br>
                        eMail: {{ $viewData["user"]->getEmail() }} <br>
                        Telefon: {{ $viewData["user"]->getTelefon() }} <br>
                        User-Rolle: {{ $viewData["user"]->getRole() }} <br><br>
                        Fahrzeuge:
                        <table class="table table-bordered">
                            <tr class="table-primary">
                                <th>Kennzeichen</th>
                                <th>Hersteller</th>
                                <th>Model</th>
                                <th>Farbe</th>
                                <th>Vorschau</th>
                            </tr>
                            @foreach($viewData['cars'] as $car)
                                <tr class="table-active">
                                    <td>{{ $car->sign }}</td>
                                    <td>{{ $car->manufacturer }}</td>
                                    <td>{{ $car->model }}</td>
                                    <td>{{ $car->color }}</td>
                                    <td><img src="{{ asset('/storage/'. $car->image) }}" class="img-thumbnail col-sm-4"></td>
                                </tr>
                            @endforeach
                        </table>
                    </h5>
                    Letzter Login: <p class="card-text">{{ $viewData["user"]->getupdatedAt() }}</p>
                    <p class="card-text"><small class="text-muted">Userdaten bearbeiten</small></p>
                </div>
            </div>
        </div>
    </div>
@endsection
