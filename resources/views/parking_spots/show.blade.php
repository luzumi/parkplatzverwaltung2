@extends("layouts.app")

@section("title", $viewData['title'])
@section("subtitle", $viewData['subtitle'])

@section("content")
    <div class="card mb-3">
        <div class="row g-0">
            <div class="col-md-4">
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">
                            {{--                            <img src="{{ asset('/img/.png') }}" class="card-img-top img-card" alt="Image not found">--}}
                            {{ $viewData['parking_spot']['number'] }}
                            {{ $viewData['parking_spot']['row'] }}
                            {{ $viewData['parking_spot']['status'] ? 'Parkplatz derzeit frei' : 'Parkplatz besetzt'}}
                        </h5>
                    </div>
{{--                    <a href="{{ asset('/img/parking_spot.png') }}" class="btn bg-primary text-white>"> </a>--}}
                </div>
            </div>
        </div>
    </div>
@endsection
