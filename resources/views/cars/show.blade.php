@extends('layouts.app')
@section('title', $viewData["title"])
@section('subtitle', $viewData["subtitle"])
@section('content')
    <div class="card mb-3">
        <div class="row">
{{-- Anzeige des ausgewählten fahrzeuges --}}
            <img src="{{ asset('/storage/media/'.$viewData['car']->image) }}" class="img-fluid rounded-start"
                 alt="Image not found">
            <p class="card-body">
            <h5 class="card-title">
                {{ $viewData["car"]->manufacturer }}
                {{ $viewData["car"]->model }}
                {{ $viewData["car"]->color }}
                <p class="card-text">{{ $viewData["car"]->sign }}</p>
            </h5>
            <div class="card-text">
                <table class="table table-bordered">
                    <tr class="table-primary">
                        <th>Parkplatz mieten - Nummer:</th>
                        <th>
                            <form method="POST"
                                  action="{{ route('parking_spots.storeThisCar') }}"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('POST')
                                <div class="col">
                                    <div class="mb-3 row">
                                        <div class="col-lg-10 col-md-6 col-sm-12">
                                            <label for="spot">
{{-- Auswahlmöglichkeit der noch reservierbaren Fahrzeuge --}}
                                                <select name="status" id="spot">
                                                    @foreach($viewData['parking_spots'] as $spot)
                                                        <option value="{{ $spot->id }}" name="id">{{$spot->number}}</option>
                                                    @endforeach
                                                </select>
                                                <button type="submit" class="btn btn-primary">Reservieren</button>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </th>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection
