@extends('layouts.admin')
@section('title', $viewData["title"])
@section('content')

    <div class="card mb-4">
        <div class="card-header">
            Neuen User erstellen
        </div>
        <div class="card-body">
            @if($errors->any())
                <ul class="alert alert-danger list-unstyled">
                    @foreach($errors->all() as $error)
                        <li> - {{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            <form method="POST" action="{{ route('admin.user.store') }}">
                @csrf
                <div class="row">
                    <div class="col">
                        <div class="mb-1 row">
                            <div class="col-lg-10 col-md-6 col-sm-12">
                                <input name="name" value="{{ old('name') }}" type="text" class="form-control">
                                <label class="col-lg-10 col-sm-12 col-form-label">Name</label>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3 row">
                            <dic class="col-lg-10 col-md-6 col-sm-12">
                                <input name="email" value="{{ old('email') }}" type="text" class="form-control">
                                <label class="col-lg-10 col-md-6 col-sm-12 col-form-label">eMail</label>
                            </dic>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3 row">
                            <dic class="col-lg-10 col-md-6 col-sm-12">
                                <input name="telefon" value="{{ old('telefon') }}" type="text" class="form-control">
                                <label class="col-lg-10 col-md-6 col-sm-12 col-form-label">Telefon</label>
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
                    <th scope="col">Name</th>
                    <th scope="col">email</th>
                    <th scope="col">Telefon</th>
                    <th scope="col">Status</th>
                    <th scope="col">Bild</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($viewData["users"] as $user)
                    <tr>
                        <td>{{ $user->getId() }}</td>
                        <td>{{ $user->getName() }}</td>
                        <td>{{ $user->getEmail() }}</td>
                        <td>{{ $user->getTelefon() }}</td>
                        <td>{{ $user->getStatus() }}</td>
                        <td>{{ $user->getImage() }}</td>
                        <td>Edit</td>
                        <td>Delete</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
