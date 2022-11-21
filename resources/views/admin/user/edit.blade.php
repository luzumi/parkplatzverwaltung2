@extends('layouts.admin')
@section('title', $viewData["title"])
@section('content')
    <div class="card mb-4">
        <div class="card-header">
            Editiere Fahrzeug
        </div>
        <div class="card-body">
            <div class="card-img-top"
            @if($errors->any())
                <ul class="alert alert-danger list-unstyled">
                    @foreach($errors->all() as $error)
                        <li>- {{ $error }}</li>
                    @endforeach
                </ul>
            @endif
        </div>
        <form method="POST" action="{{ route('admin.user.update', ['id'=> $viewData['user']->getId()]) }}"
              enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col">
                    <div class="mb-3 row">
                        <div class="col-lg-10 col-md-6 col-sm-12">
                            <label class="col-lg-10 col-md-6 col-sm-12 col-form-label">Name:</label>
                            <label>
                                <input name="name" value="{{ $viewData['user']->getName() }}" type="text"
                                       class="form-control-sm">
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="mb-3 row">
                        <div class="col-lg-10 col-md-6 col-sm-12">
                            <label class="col-lg-10 col-md-6 col-sm-12 col-form-label-sm">Email:</label>
                            <label>
                                <input name="email" value="{{ $viewData['user']->getEmail() }}" type="text"
                                       class="form-control-sm">
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="mb-3 row">
                        <div class="col-lg-10 col-md-6 col-sm-12">
                            <label class="col-lg-10 col-md-6 col-sm-12 col-form-label-sm">Telefon:</label>
                            <label>
                                <input name="telefon" value="{{ $viewData['user']->getTelefon() }}" type="text"
                                       class="form-control-sm">
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="mb-3 row">
                        <div class="col-lg-10 col-md-6 col-sm-12">
                            <label class="col-lg-10 col-md-6 col-sm-12 col-form-label-sm">Rolle:</label>
                            <label>
                                <input name="role" value="{{ $viewData['user']->getRole() }}" type="text"
                                       class="form-control-sm">
                            </label>
                        </div>
                    </div>
                </div>

                {{--                Address--}}
                <div class="row">
                    <div class="col">
                        <div class="mb-3 row">
                            <div class="col-lg-10 col-md-6 col-sm-12">
                                <label class="col-lg-10 col-md-6 col-sm-12 col-form-label">Land:</label>
                                <label>
                                    <input name="Land" value="{{ $viewData['address']->getLand() }}" type="text"
                                           class="form-control-sm">
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="mb-sm-1 row">
                            <div class="col-lg-10 col-md-6 col-sm-12">
                                <label class="col-lg-10 col-md-6 col-sm-12 col-form-label-sm">PLZ:</label>
                                <label>
                                    <input name="PLZ" value="{{ $viewData['address']->getPLZ() }}" type="text"
                                           class="form-control-sm">
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="mb-1 row">
                            <div class="col-lg-10 col-md-6 col-sm-12">
                                <label class="col-lg-10 col-md-6 col-sm-12 col-form-label-sm">Stadt:</label>
                                <label>
                                    <input name="Stadt" value="{{ $viewData['address']->getStadt() }}" type="text"
                                           class="form-control-sm">
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="mb-3 row">
                            <div class="col-lg-10 col-md-6 col-sm-12">
                                <label class="col-lg-10 col-md-6 col-sm-12 col-form-label-sm">Strasse:</label>
                                <label>
                                    <input name="Strasse" value="{{ $viewData['address']->getStrasse() }}" type="text"
                                           class="form-control-sm">
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="mb-sm-0">
                            <div class="col-lg-10 col-md-6 col-sm-12">
                                <label for="Nummer" class="col-lg-10 col-md-6 col-sm-12 col-form-label-sm">Nummer:</label>
                                <label>
                                    <input name="Nummer" value="{{ $viewData['address']->getNummer() }}" type="text"
                                           class="form-control-sm">
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                {{--                    {{dd($viewData['address'])}}--}}
            </div>
            <div class="row">
                <div class="col">
                    <div class="mb-3 row">
                        <div class="col-lg-10 col-md-6 col-sm-12">
                            <input name="image" value="{{ $viewData['user']->getImage() }}" type="file"
                                   class="form-control">
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
@endsection
