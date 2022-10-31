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

            <form method="POST" action="{{ route('admin.parking-spot.update', ['id'=> $viewData['parking_spot']->getId()]) }}"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col">
                        <div class="mb-3 row">
                            <div class="col-lg-10 col-md-6 col-sm-12">
                                <input name="status" value="{{ $viewData['parking_spot']->getStatus() }}" type="text" class="form-control-sm">
                                <label class="col-lg-10 col-md-6 col-sm-12 col-form-label">Status:</label>
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
                <button type="submit" class="btn btn-primary">Edit</button>
            </form>
        </div>
    </div>
@endsection
