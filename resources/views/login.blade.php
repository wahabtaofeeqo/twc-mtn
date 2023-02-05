@extends('app')

@section('content')
<div class="container-fluid h-100 bg-black m-0 img-bg-overlay d-flex align-items-center justify-content-center">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-0">Welcome</h4>
                <p><small class="text-muted">Enter your code to view your details</small></p>

                @if ($errors->has('code'))
                    <div class="alert alert-danger">
                        {{ $errors->first('code') }}
                    </div>
                @endif

                <form action="{{route('login')}}"  method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="" class="form-label">Username</label>
                        <input type="text" disabled required readonly name="username" class="form-control" value="SalesConf2023">
                    </div>

                    <div class="mb-4">
                        <label for="" class="form-label">Your code</label>
                        <input type="password" required name="code" class="form-control" placeholder="Your unique code?">
                    </div>

                    <button class="btn btn-warning px-4 float-end">Continue</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $("#loginForm").submit(function(e) {
        e.preventDefault();
        login($(this).serialize());
    })

    function login(params) {
        axios.get(`/api/verify/${params.code}`)
            .then(res => {
                const data = res.data;
                if(data.status) {
                    toastr.success(data.message)
                }
                else {
                    toastr.error(data.message)
                }
            })
            .catch(e => {
                let message = e.response?.data?.message || e.message
                toastr.error(message)
            })
    }
</script>
@endpush
