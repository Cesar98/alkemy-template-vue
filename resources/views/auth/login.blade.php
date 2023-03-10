@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card bg-dark text-white" style="border-radius: 1rem;">
                    <div class="card-body p-5 text-center">

                        <div class="mb-md-5 mt-md-4">

                            <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
                            <p class="text-white-50 mb-5">Please enter your email and password!</p>

                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="form-outline form-white mb-4">
                                    <label class="form-label text-white-50" for="email">Email</label>

                                    <input type="email" id="email" name="email"
                                        placeholder="example@example.example"
                                        class="form-control form-control-lg @error('email') is-invalid @enderror" />

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-outline form-white mb-4">
                                    <label class="form-label text-white-50" for="password">Password</label>

                                    <input type="password" id="password" name="password" placeholder="password"
                                        class="form-control form-control-lg @error('password') is-invalid @enderror" />

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <button class="btn btn-outline-light btn-lg mt-5" type="submit">Login</button>
                            </form>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
