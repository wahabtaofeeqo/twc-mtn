@extends('app')

@section('content')
<style>
    body {
        background-color: #222222
    }
</style>

<div class="container-fluid py-3">
    <div class="col-lg-5 mx-auto">
        <div class="card rounded-0 rounded-start border-0 border-end border-3 border-warning">
            <div class="card-header">
                <h4 class="card-title">Day 0 (13th Feb, 2023) </h4>
            </div>
            <div class="card-body">
                <div class="mb-4">
                    <img src="{{asset('assets/images/avatar.png')}}" width="100" height="100" class="rounded-circle">
                </div>

                <small class="text-muted">Name</small>
                <h1 class="h4 mb-3">
                    <strong>
                       {{auth()->user()->firstname . ' ' . auth()->user()->lastname}}
                    </strong>
                </h1>

                <p>
                    <small class="text-muted">Email</small> <br>
                    <strong>{{auth()->user()->email}}</strong>
                </p>

                <p>
                    <small class="text-muted">Code</small> <br>
                    <strong>{{auth()->user()->code}}</strong>
                </p>

                <p class="card-text mb-1">Activities & Time</p>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Activity</th>
                                <th>Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    Bus conveying staff from Eko hotel to Lagos Continental
                                </td>
                                <td>
                                    7:30 am
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Staff  Day with HR –  African Grand ball room Lagos Continental hotel.
                                </td>
                                <td>
                                    Staff should be seated at 8am
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Tea break and Lunch to be served at the African Grand ball room.
                                </td>
                                <td>
                                    10:00 am/1:30pm
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Dinner to be served for all at Ekaabo restaurant, Lagos Continental.
                                </td>
                                <td>
                                    6pm – 11pm
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Bus/Taxi to convey Staff back to Eko hotel.
                                </td>
                                <td>
                                    8pm
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
