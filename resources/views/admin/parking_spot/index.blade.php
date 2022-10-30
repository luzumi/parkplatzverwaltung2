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
                    <th scope="col">Nummer</th>
                    <th scope="col">Reihe</th>
                    <th scope="col">Status</th>
                    <th scope="col">Bild</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($viewData["parking_spots"] as $parking_spot)
                    <tr>
                        <td>{{ $parking_spot->getId() }}</td>
                        <td>{{ $parking_spot->getNumber() }}</td>
                        <td>{{ $parking_spot->getRow() }}</td>
                        <td>{{ $parking_spot->getStatus() }}</td>
                        <td>{{ $parking_spot->getImage() }}</td>
                        <td>Edit</td>
                        <td>Delete</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
