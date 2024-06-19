@extends('layouts.login')

@section('main-login')
<div class="form-regis">
    <img src="/img/curveregis.png" class="curveregis" alt="">
    <img src="/img/register.png" class="regis" alt="">
    <img src="/img/BIlogin.png" class="logoregis" alt="">
    <form action="/register" method="post">
        @csrf
            <div class="form-floating mb-1">
                <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" id="username" placeholder="Your Name" required value="{{ old('username') }}">
                <label for="username">Username</label>
                @error('username')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-floating mb-1">
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="name@example.com" required value="{{ old('email') }}">
                <label for="email">Email address</label>
                @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-floating mb-1">
                <input type="password" name="password" class="form-control rounded-bottom @error('password') is-invalid @enderror" id="password" placeholder="Password" required>
                <label for="password">Password</label>
                @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <button class="btn btn-primary mt-3 w-100 py-2" type="submit">Register</button>
            <small class="d-block text-center mt-3">Already register? <a href="/login">Login</a></small>
        </form>
</div>
@endsection