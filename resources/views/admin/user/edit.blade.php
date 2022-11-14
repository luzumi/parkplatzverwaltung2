@extends('layouts.admin')
@section('title', $viewData["title"])
@section('content')
    <div class="card mb-4">
        <div class="card-header">
            Editiere Fahrzeug
        </div>
        <div class="card-body">
            @if($errors->any())
                <ul class="alert alert-danger list-unstyled">
                    @foreach($errors->all() as $error)
                        <li>- {{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            <form method="POST" action="{{ route('admin.user.update', ['id'=> $viewData['user']->getId()]) }}"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col">
                        <div class="mb-3 row">
                            <div class="col-lg-10 col-md-6 col-sm-12">
                                <input name="name" value="{{ $viewData['user']->getName() }}" type="text" class="form-control-sm">
                                <label class="col-lg-10 col-md-6 col-sm-12 col-form-label">Name:</label>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3 row">
                            <div class="col-lg-10 col-md-6 col-sm-12">
                                <input name="email" value="{{ $viewData['user']->getEmail() }}" type="text" class="form-control-sm">
                                <label class="col-lg-10 col-md-6 col-sm-12 col-form-label-sm">Email:</label>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3 row">
                            <div class="col-lg-10 col-md-6 col-sm-12">
                                <input name="telefon" value="{{ $viewData['user']->getTelefon() }}" type="text" class="form-control-sm">
                                <label class="col-lg-10 col-md-6 col-sm-12 col-form-label-sm">Telefon:</label>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3 row">
                            <div class="col-lg-10 col-md-6 col-sm-12">
                                <input name="role" value="{{ $viewData['user']->getRole() }}" type="text" class="form-control-sm">
                                <label class="col-lg-10 col-md-6 col-sm-12 col-form-label-sm">Rolle:</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="mb-3 row">
                            <div class="col-lg-10 col-md-6 col-sm-12">
                                <input name="image" value="{{ $viewData['user']->getImage() }}" type="file" class="form-control" >
                                <label class="col-lg-10 col-md-6 col-sm-12 col-form-label-sm">Image:</label>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        &nbsp;
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Edit</button>
            </form>
        </div>
    </div>
@endsection
