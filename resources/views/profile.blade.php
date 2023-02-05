@extends('app')

@section('content')
<div class="container-fluid bg-dark h-100 py-3 d-flex align-items-center">
    <div class="col-lg-5 mx-auto">
        <div class="card rounded-0 rounded-start border-0 border-end border-3 border-warning">
            <div class="card-body">
                <div class="mb-4">
                    <img src="{{asset('assets/images/mtn.png')}}" width="100" height="100" class="rounded-circle">
                </div>

                <h1 class="h4 mb-3">
                    <strong>
                       {{auth()->user()->name}}
                    </strong>
                </h1>

                <p>
                    Email: <strong>{{auth()->user()->email}}</strong>
                </p>

                <p>
                    Code: <strong>{{auth()->user()->code}}</strong>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
