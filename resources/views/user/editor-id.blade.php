@extends('welcome')
@section('title', $viewData['title'])
@section('subtitle', $viewData['subtitle'])

@section('content')
    <div class="container-xl px-4 mt-4">
        <hr class="mt-0 mb-4">
        <div class="row">
            <div class="col-xl-4">
                {{--Profile picture card--}}
                <div class="card mb-4 mb-xl-0">
                    <div class="card-header">Profile Picture</div>
                    <div class="card-body text-center">
                        <!-- Profile picture image-->
                        <img class="img-account-profile rounded-circle mb-2"
                             src="{{ asset('/storage/media/'. $viewData['user']->image) }}" alt="y">
                        <!-- Profile picture help block-->
                        <div class="small font-italic text-muted mb-4">JPG or PNG</div>
                        <!-- Profile picture upload button-->
                        <form method="POST"
                              action="{{ route('user.updatePicture', ['id'=> $viewData['user']->id]) }}"
                              enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col col-12">
                                    <div class="mb-6 row">
                                        <div class="col-lg-10 col-md-6 col-sm-12">
                                            <input name="image" value="{{ $viewData['user']->image }}" type="file"
                                                   class="form-control col-10">
                                            <label class="col-lg-10 col-md-6 col-sm-12 col-form-label-sm">Profilbild&nbsp;uploaden</label>
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
                {{-- Change password card --}}
                <div class="card mb-4 align-content-lg-center">
                    <div class="card-header">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">{{ __('Change Password') }}</div>

                                        <form action="{{ route('user.update-password') }}" method="POST">
                                            @csrf
                                            <div class="card-body">
                                                @if (session('status'))
                                                    <div class="alert alert-success" role="alert">
                                                        {{ session('status') }}
                                                    </div>
                                                @elseif (session('error'))
                                                    <div class="alert alert-danger" role="alert">
                                                        {{ session('error') }}
                                                    </div>
                                                @endif
                                                <div class="mb-3">
                                                    <label for="oldPasswordInput" class="form-label">Old
                                                        Password</label>
                                                    <input name="old_password" type="password"
                                                           class="form-control @error('old_password') is-invalid @enderror"
                                                           id="oldPasswordInput"
                                                           placeholder="Old Password">
                                                    @error('old_password')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="newPasswordInput" class="form-label">New
                                                        Password</label>
                                                    <input name="new_password" type="password"
                                                           class="form-control @error('new_password') is-invalid @enderror"
                                                           id="newPasswordInput"
                                                           placeholder="New Password">
                                                    @error('new_password')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="confirmNewPasswordInput" class="form-label">Confirm New
                                                        Password</label>
                                                    <input name="new_password_confirmation" type="password"
                                                           class="form-control" id="confirmNewPasswordInput"
                                                           placeholder="Confirm New Password">
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <button class="btn btn-success">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    {{-- Delete account card --}}
                    <div class="card-header">Delete Account</div>
                    <div class="card-body">
                        <p>Das Löschen Ihres Kontos ist eine dauerhafte Aktion und kann nicht rückgängig gemacht
                            werden. Wenn Sie sicher sind, dass Sie Ihr Konto löschen möchten, wählen Sie die
                            Schaltfläche unten.</p>
                        <form action="{{ route('user.delete') }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger-soft text-danger">
                                Ich habe verstanden, Account löschen!
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-xl-8">
                @if($errors->any())
                    <ul class="alert alert-danger list-group">
                        @foreach($errors->all() as $error)
                            <li>- {{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
{{-- Account details card --}}
                <div class="card mb-4">
                    <div class="card-header">Account Details</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('user.update', ['id'=> $viewData['user']->id]) }}"
                              enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <div class="col-md-6">
                                    <label class="small mb-1" for="name">Name </label>
                                    <input class="form-control" id="name" type="text" name="name"
                                           placeholder="Enter your Name" value="{{$viewData['user']['name']}}">
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="col-md-6">
                                    <label class="small mb-1" for="email">Email address</label>
                                    <input class="form-control" id="email" type="email" name="email"
                                           placeholder="Enter your email address" value="{{$viewData['user']->email}}">
                                </div>
                            </div>
                            <div class="row gx-3 mb-3">
                                <div class="col-md-6">
                                    <label class="small mb-1" for="telefon">Phone number</label>
                                    <input class="form-control" id="telefon" type="tel" name="telefon"
                                           placeholder="Enter your phone number" value="{{$viewData['user']->telefon}}">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                            <div class="col">
                                &nbsp;
                            </div>
                        </form>
                    </div>
                </div>
{{-- Address details card --}}
                <div class="card mb-4">
                    <div class="card-header">Address Details</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('address.create', ['id'=> $viewData['user']->id]) }}"
                              enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <!-- Form Group (username)-->
                            <div class="mb-3">
                                <label class="small mb-1" for="Land">Land </label>
                                <input class="form-control" id="Land" type="text" name="Land"
                                       placeholder="Enter your Country"
                                       value="{{$viewData['address']->getAttribute('Land')}}">
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="PLZ">PLZ </label>
                                <input class="form-control" id="PLZ" type="text" name="PLZ"
                                       placeholder="Enter your Postal-Code"
                                       value="{{$viewData['address']->getAttribute('PLZ')}}">
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="Stadt">Stadt </label>
                                <input class="form-control" id="Stadt" type="text" name="Stadt"
                                       placeholder="Enter your City"
                                       value="{{$viewData['address']->getAttribute('Stadt')}}">
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="Strasse">Straße </label>
                                <input class="form-control" id="Strasse" type="text" name="Strasse"
                                       placeholder="Enter your Street"
                                       value="{{$viewData['address']->getAttribute('Strasse')}}">
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="Nummer">Nummer </label>
                                <input class="form-control" id="Nummer" type="text" name="Nummer"
                                       placeholder="Enter your House-Number"
                                       value="{{$viewData['address']->getAttribute('Nummer')}}">
                            </div>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                            <div class="col">
                                &nbsp;
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
