@extends("layouts.app")

@section("title", $viewData['title'])
@section("subtitle", $viewData['subtitle'])

@section("content")
    <div class="row">
        @foreach($viewData["parking_spots"] as $parking_spot)
            <div class="col-md-4 col-lg-3 mb-2">
                <div class="card">
                    <img src="{{ asset('/img/parking_spot.png') }}" class="card-img-top img-card
                    {{$parking_spot['status'] ? 'bg-danger' : 'opacity-25'}}" alt="image not found">
                    <div class="card-body text-center ">
                        <a href="{{ asset('/img/parking_spot.png') }}"
                           class="btn {{$parking_spot['status'] ? 'bg-primary' : 'bg-black opacity-25'}} text-white>">
                            Parkplatz {{ $parking_spot['number'] }}
                            {{ $parking_spot['status'] ? ' derzeit frei' : ' besetzt'}}
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
