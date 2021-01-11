@extends('app')

@section('title', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-md-3">
        <div class="list-group">
            <li class="list-group-item active text-center">Menu</li>
            <a href="{{ route('dashboard.index') }}" class="list-group-item" style="color: #212529;">Dashboard</a>
            <a href="{{ route('dashboard.logout') }}" class="list-group-item" style="color: #212529;">Logout</a>
        </div>
    </div>

    <div class="col-md-9">
        <div class="card">
            <div class="card-body">
                <label>Dashboard</label>
                <hr>
                Selamat Datang, {{ Auth::user()->name }}
            </div>
        </div>
    </div>
</div>
@endsection
