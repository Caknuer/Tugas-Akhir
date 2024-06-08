@extends('layout.template')

@section('P')

<!-- LOGIN -->
    <div class="w-50 center border rounded px-3 py-3 mx-auto">
        <h1>Login</h1>
        <form action="{{ url('sesi/login')}}" method="post">
            @csrf
            @method("POST")
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" value="{{Session::get('email')}}" name="email" class="form-control">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control">
            </div>
            <div class="mb-3 d-grid">
                <button name="submit" type="submit" class="btn btn-primary">Login</button>
            </div>
            <li class="nav-item">
                <a>Silahkan daftar terlebih dahulu ;)</a>
                <a href="/sesi/register" class="nav-link center border mx-auto" type="submit">Sing in-</a>
            </li>
        </form>
    </div>
@endsection