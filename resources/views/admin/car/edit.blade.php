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
{{--Usereingaben--}}
            <form method="POST" action="{{ route('admin.car.update', ['id'=> $viewData['car']->id]) }}"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col">
                        <div class="mb-3 row">
                            <div class="col-lg-10 col-md-6 col-sm-12">
                                <label>
                                    <input name="sign" value="{{ $viewData['car']->sign }}" type="text" class="form-control-sm">
                                </label>
                                <label class="col-lg-10 col-md-6 col-sm-12 col-form-label">Kennzeichen:</label>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3 row">
                            <div class="col-lg-10 col-md-6 col-sm-12">
                                <label>
                                    <input name="manufacturer" value="{{ $viewData['car']->manufacturer }}" type="text" class="form-control-sm">
                                </label>
                                <label class="col-lg-10 col-md-6 col-sm-12 col-form-label-sm">Hersteller:</label>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3 row">
                            <div class="col-lg-10 col-md-6 col-sm-12">
                                <label>
                                    <input name="model" value="{{ $viewData['car']->model }}" type="text" class="form-control-sm">
                                </label>
                                <label class="col-lg-10 col-md-6 col-sm-12 col-form-label-sm">Modell:</label>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3 row">
                            <div class="col-lg-10 col-md-6 col-sm-12">
                                <label>
                                    <input name="color" value="{{ $viewData['car']->color }}" type="text" class="form-control-sm">
                                </label>
                                <label class="col-lg-10 col-md-6 col-sm-12 col-form-label-sm">Farbe:</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="mb-3 row">
                            <div class="col-lg-10 col-md-6 col-sm-12">
                                <input class="form-control" type="file" name="image">
                                <label class="col-lg-10 col-md-6 col-sm-12 col-form-label-sm">Image:</label>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        &nbsp;
                    </div>
                </div>
{{--absenden--}}
                <button type="submit" class="btn btn-primary">Edit</button>
            </form>
        </div>
    </div>
@endsection
