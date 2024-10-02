@extends('layouts.guest')
@section('title')
JSPacas | Ingresa a tu panel de control
@endsection

@section('content')
    <div class="px-5 ms-xl-5">
        <h4 class="text-uppercase mt-4 pt-5 mt-xl-5">Cuenta Administrativa</h4>
        <p class="text-muted mt-2  pb-2">Ingresa tus datos para iniciar sesión</p>
    </div>
    <div class="d-flex align-items-center h-custom-2 px-5 ">

        <form method="POST" action="{{ route('login') }}" style="width: 23rem;">
            @csrf
            <div class="mb-3">
                <div class="col-md-12">
                    <div class="form-floating mb-3">
                        <input id="email" type="text" id="floatingInput"
                            class="mt-4 form-control custom-input @error('email') is-invalid @enderror" name="email"
                            value="{{ old('email') }}" required autocomplete="email" autofocus
                            placeholder="Correo electronico">
                        <label for="floatingInput">Email address</label>
                    </div>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <div class="col-md-12">
                        <div class="form-floating mb-3">
                            <input id="floatingPassword" type="password"
                                class="mt-2 form-control custom-input @error('password') is-invalid @enderror"
                                name="password" required autocomplete="current-password" placeholder="Password">
                            <label for="floatingPassword">Password</label>
                        </div>

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>
                </div>

                <div class="mb-3">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="checkbox-signin" checked>
                        <label class="form-check-label" for="checkbox-signin">Recordar acceso</label>
                    </div>
                </div>

                <div class="mb-3 d-grid text-center">
                    <button class="btn btn-primary" type="submit"> Iniciar sesión</button>
                </div>
            </div>
        </form>
    </div>
@endsection
