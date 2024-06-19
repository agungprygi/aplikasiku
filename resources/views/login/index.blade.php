@extends('layouts.login')

@section('main-login')
<div class="logo-login">
    <img src="/img/curveblue.png" alt="" class="curveblue">
    <img src="/img/curve.png" alt="" class="curve">
    <img src="/img/mobil.png" alt="" class="mobil">
    <img src="/img/BIlogin.png" alt="" class="BIlogin">
</div>
<div class="login form-signin text-center">
    @if (session()->has('success'))  
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if (session()->has('loginError'))  
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('loginError') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <h2 style="color: #2A9DF4">Selamat Datang</h2>
    <form action="/login" method="post">
        @csrf
        <div class="form-floating mb-2">
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="name@example.com" autofocus required value="{{ old('email') }}">
            <label for="email">Email address</label>
            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-floating mb-3">
            <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
            <label for="floatingPassword">Password</label>
        </div>

        <button class="btn btn-primary w-100 py-2" type="submit">Login</button>
    </form>
    <small class="d-block text-center mt-2">Not Register? <a href="/register">Register now!</a></small>
</div>
@endsection