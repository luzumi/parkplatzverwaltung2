@extends('layouts.app')
@section('title', $viewData["title"])
@section('subtitle', $viewData["subtitle"])
@section('content')
    <div class="row">
        @foreach ($viewData["users"] as $user)
            <div class="col-md-4 col-lg-3 mb-2">
                <div class="card">
                    <img src="{{ asset('/storage/'. $user->getImage()) }}" class="card-img-top img-card"
                         alt="Image not found">
                    <div class="card-body text-center">
                        <a href="{{ route('user.show', ['id'=> $user->getId()]) }}"
                           class="btn bg-primary text-white">
                            {{ $user->getName() }} <br> {{ $user->getRole() }}</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
