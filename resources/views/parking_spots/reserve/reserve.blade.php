@extends('layouts.app')
@section('title', $viewData["title"])
@section('subtitle', $viewData["subtitle"])

@section("content")
    <div class="card mb-3">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="{{ asset('/storage/media/'. $viewData['parking_spot']->getImage()) }}"
                     class="img-fluid rounded-start" alt="Image not found">
            </div>
            <div class="col-md-8">

            </div>
        </div>
    </div>



@endsection
