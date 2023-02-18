@extends('app')
@section('content')
<nav class="navbar navbar-expand-lg bg-warning">
    <div class="container">
        <a class="navbar-brand" href="{{route('dashboard')}}">Dashboard</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="/">Home</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="h-100 bg-light">
    <div class="container py-3">

        <div class="row mb-4">
            <div class="col-lg-4 mb-4">
                <div class="d-flex justify-content-between align-items-center rounded border p-3 bg-white">
                   <div>
                        <i class="fa-solid fa-users"></i>
                        <p class="mb-0 mt-1">Total Users</p>
                   </div>
                   <h2>{{$users}}</h2>
                </div>
            </div>

            <div class="col-lg-4 mb-4">
                <div class="d-flex justify-content-between align-items-center rounded border p-3 bg-white">
                   <div>
                        <i class="fa-solid fa-user"></i>
                        <p class="mb-0 mt-1">Clock Ins</p>
                   </div>
                   <h2>{{$all}}</h2>
                </div>
            </div>
        </div>

        <div class="card border-0">
            <div class="card-body">
                <div class="mb-4 d-flex justify-content-between">
                    <h4>Today Clock Ins</h4>
                    <button class="btn btn-info px-4 d-none" type="button" data-bs-toggle="modal" data-bs-target="#bookModal">Book Seat</button>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Firstname</th>
                                <th scope="col">Lastname</th>
                                <th scope="col">Email</th>
                                <th scope="col">Date & Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $row)
                                <tr>
                                    <th scope="row">
                                        {{$loop->index + 1}}
                                    </th>
                                    <td>
                                        {{$row->user->firstname}}
                                    </td>
                                    <td>
                                        {{$row->user->lastname ?? 'N/A'}}
                                    </td>
                                    <td>
                                        {{$row->user->email}}
                                    </td>
                                    <td>
                                        {{ $row->created_at }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{$data->links()}}
            </div>
        </div>
    </div>
</div>
@endsection
