@extends('layouts.app')
@extends('layouts.alert_message') 
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h5 class="card-title">LARAVEL CHALLENGE: THE CALENDAR APP</h5>

                    <p class="card-text">* Please be sure to follow the Initial instructions on:</p>

                    <p class="card-text">https://github.com/owInteractive/laravel-challenge</p>
                    
                    <h5 class="card-title">PART I: THE BASICS</h5>

                    <p class="card-text">The applicant application must meet the following requirements:</p>

                    <ul>
                    <li>Authentication capabilities (sign in, signup, password reset and profile change)</li>
                    <p class="text-success">DONE</p>
                    <p class="text-danger">Password reset by email was not done.</p>

                    <dd>- Basic profile: email, password, name</dd>
                    <p class="text-success">DONE</p>

                    <p class="card-text">For the authenticated user:</p>

                    <li>Allow to create an event with the following information:</li>
                    <dd>- Basic event: title, description, start datetime, end datetime</dd>
                    <p class="text-success">DONE</p>
                    <p class="text-primary">start datetime, end datetime were split date and time on different columns</p>

                    <li>Allow to edit/delete his own events</li>
                    <p class="text-success">DONE</p>

                    <li>Show the user events on following lists:</li>
                    <dd>- Today events </dd>
                    <dd>- Events for the next 5 days </dd>
                    <dd>- All events (paginated) </dd>
                    <p class="text-success">DONE</p>
                    </ul>


                    <h5 class="card-title">PART II: FILES</h5>

                    <p class="card-text">The user should be able to import and export the events to a CSV, for the same types of events listing developed on Part I.</p>
                    <p class="text-success">DONE</p>
                    <p class="text-primary">A package was used to implement this feature</p>

                    <h5 class="card-title">PART III: INVITING FRIENDS</h5>

                    <p class="card-text">The app should allow to invite some friends to the event</p>
                    <dd>- For this requirement your client did not provide much information, so it is
                    up to you to provide the solution</dd>

                    <p class="text-success">DONE</p>
                    <p class="card-text text-primary">
                    In the Event List there is a button when it is showed the number of friends invited, clicking
                    this button you can invite friends to your event. Also when you update an event in the update page appears the button to invite, too.
                    The idea of this feature is when you invite someone writting his email, an email will be sent to that person with the event's information.
                    </p>

                    <h5 class="card-title">FINISHING UP</h5>

                    <p class="text-success">DONE</p>

                    <p class="card-text">To finish the app send a Pull Request (PR) to the original repository to the master branch. Do not forget UX matters.
                    Good Job and Challenge!!</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
