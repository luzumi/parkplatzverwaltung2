@extends('layouts.admin')
@section('title', $viewData["title"])
@section('content')

    <div class="card mb-4">
        <div class="card-header">
            Neues Fahrzeug erstellen
        </div>
        <div class="card-body">
            @if($errors->any())
                <ul class="alert alert-danger list-unstyled">
                    @foreach($errors->all() as $error)
                        <li> - {{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            <form method="POST" action="{{ route('admin.car.store') }}">
                @csrf
                <div class="row">
                    <div class="col">
                        <div class="mb-1 row">
                            <div class="col-lg-10 col-md-6 col-sm-12">
                                <input name="sign" value="{{ old('sign') }}" type="text" class="form-control">
                                <label class="col-lg-10 col-sm-12 col-form-label">Kennzeichen</label>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3 row">
                            <dic class="col-lg-10 col-md-6 col-sm-12">
                                <input name="manufacturer" value="{{ old('manufacturer') }}" type="text" class="form-control">
                            <label class="col-lg-10 col-md-6 col-sm-12 col-form-label">Hersteller</label>
                            </dic>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3 row">
                            <dic class="col-lg-10 col-md-6 col-sm-12">
                                <input name="model" value="{{ old('model') }}" type="text" class="form-control">
                            <label class="col-lg-10 col-md-6 col-sm-12 col-form-label">Model</label>
                            </dic>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3 row">
                            <dic class="col-lg-10 col-md-6 col-sm-12">
                                <input name="color" value="{{ old('color') }}" type="text" class="form-control">
                            <label class="col-lg-10 col-md-6 col-sm-12 col-form-label">Farbe</label>
                            </dic>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3 row">
                            <dic class="col-lg-10 col-md-6 col-sm-12">
                                <input name="image" value="{{ old('image') }}" type="text" class="form-control">
                            <label class="col-lg-10 col-md-6 col-sm-12 col-form-label">Bild</label>
                            </dic>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Absenden</button>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            Manage Products
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Kennzeichen</th>
                    <th scope="col">Hersteller</th>
                    <th scope="col">Modell</th>
                    <th scope="col">Farbe</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($viewData["cars"] as $car)
                    <tr>
                        <td>{{ $car->getId() }}</td>
                        <td>{{ $car->getSign() }}</td>
                        <td>{{ $car->getManufacturer() }}</td>
                        <td>{{ $car->getModel() }}</td>
                        <td>{{ $car->getColor() }}</td>
                        <td>Edit</td>
                        <td>Delete</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
