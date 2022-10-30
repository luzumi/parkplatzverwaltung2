@extends('layouts.admin')
@section('title', $viewData["title"])
@section('content')
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
