@extends('app')

@section('content')
<style>
    body {
        background-color: #eee
    }
</style>

<div class="container-fluid py-3">
    <div class="row">
        <div class="col-lg-5 mx-auto mb-4">
            <div class="card rounded-0 rounded-start border-0 border-end border-3 border-warning">
                <div class="card-header">
                    <h4 class="card-title h5">Day 4 (16th Feb, 2024) </h4>
                </div>
                <div class="card-body">

                    <div class="mb-4">
                        <img src="{{asset('assets/images/avatar.png')}}" width="100" height="100" class="rounded-circle">
                    </div>

                    <p class="card-text">
                        Y’ello <strong>{{auth()->user()->firstname . ' ' . auth()->user()->lastname}}</strong>,

                        Welcome to the day 4 of the 2024 S&D Sales Conference.
                        Please find below the activities outlined for today.
                    </p>

                    <small class="text-muted d-none">Name</small>
                    <h1 class="h4 mb-3 d-none">
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
                                        Partners Review with L3 and above- The HALL Event Center
                                    </td>
                                    <td>
                                        8am - 2pm
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                       Movement of Partners and L3 Staff from Lagos Continental and Eko Hotel to Conference venue.
                                    </td>
                                    <td>
                                        From 7am
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Staff team building - Levels 1&2 (Lagos Continental Hotel - Ariya Terrace) Lunch for staff at Team Building Venue

                                    </td>
                                    <td>
                                        9am -1pm <br>
                                        1pm-2pm
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Awards and Gala Night - Lagos Continental Movement of Partners from Eko Hotel to Lagos Continental.
                                    </td>
                                    <td>
                                        From 7pm <br>
                                        From 6pm
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-7">
            <h4 class="h5">Travel</h4>
            <ul>
                <li>Transportation to Lagos is by air (except for participants from Lagos/South West Region)</li>
                <li>Airport transfers have been arranged from all local MMA terminals to Continental Hotel, Lagos and Eko Hotels</li>
            </ul>

            <h4 class="h5">Medical Requirements</h4>
            <ul>
                <li>For medical attention, paramedics and medical personnel will be available throughout the duration	of the Sales Conference.</li>
                <li>The location of the clinic and the telephone numbers will be provided on arrival</li>
            </ul>

            <h4 class="h5">Feeding</h4>
            <ul>
                <li>Food will be provided in the Hotel restaurants and other sites which will be communicated</li>
                <li>No room service or personal request (for food, telephone, drinks, cigarettes, etc.) of any kind will be entertained.</li>
            </ul>

            <h5>Laundry</h5>
            <ul>
                <li>Note that in line with MTN policy, no laundry expenses will be borne by the company.</li>
            </ul>

            <h5>Conference Park</h5>
            <ul>
                <li>A pack containing the Conference essentials will be provided. Participants are hence encouraged to come with appropriate dress code for each activity as specified in the dress code guide</li>
            </ul>

            <h5>Health & Safety</h5>
            <ul>
                <li>It is important that every participant evaluates their health conditions before participating in any of the  games.</li>
            </ul>

            <h5>Security</h5>
            <ul>
                <li>Agency will endeavor to ensure security during the conference. Security may not however be guaranteed outside the conference activities and lodging perimeters.</li>
            </ul>

            <h5>Dress code</h5>
            <ul>
                <li>Please refer to attached dress code for guidance.</li>
            </ul>

            <p class="text-danger">
                *Please expect an email containing a QR Unique code which will give you access to all program events.
            </p>
        </div>
    </div>

    <div class="py-3">
        <img src="{{asset('assets/images/banner_sm.jpeg')}}" width="100%">
        <h5 class="my-3">Contacts /Enquiries: (Project Committee)</h5>
        <div class="table-responsive">
            <table class="table table-striped">
                <tbody>
                    <tr>
                        <td>Efe</td>
                        <td>07036813000</td>
                    </tr>
                    <tr>
                        <td>Olaleke</td>
                        <td>08032001795</td>
                    </tr>
                    <tr>
                        <td>Anita</td>
                        <td>08032000680</td>
                    </tr>
                    <tr>
                        <td>Temitope</td>
                        <td>08032000084</td>
                    </tr>
                    <tr>
                        <td>Emeka</td>
                        <td>07036574839</td>
                    </tr>
                    <tr>
                        <td>Beatrice</td>
                        <td>08032004048</td>
                    </tr>
                    <tr>
                        <td>Gbenga</td>
                        <td>08032002526</td>
                    </tr>
                    <tr>
                        <td>Olaniyi (LSW)</td>
                        <td>08032004882</td>
                    </tr>
                    <tr>
                        <td>Victoria</td>
                        <td>08133809017</td>
                    </tr>
                    <tr>
                        <td>Ruth</td>
                        <td>08032001701</td>
                    </tr>
                    <tr>
                        <td>Stella</td>
                        <td>08032001796</td>
                    </tr>
                    <tr>
                        <td>Nkechi (Northwest)</td>
                        <td>08032008067</td>
                    </tr>
                    <tr>
                        <td>Gbemi (Agency)</td>
                        <td>08060054001</td>
                    </tr>
                    <tr>
                        <td>Stephanie</td>
                        <td>07062023162</td>
                    </tr>
                    <tr>
                        <td>Kolajo</td>
                        <td>08032002787</td>
                    </tr>
                    <tr>
                        <td>Hussaina (Northwest)</td>
                        <td>08032000596</td>
                    </tr>
                    <tr>
                        <td>MacDaniels (East)</td>
                        <td>08032009221</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
