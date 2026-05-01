@extends('layouts.defaultLayout')
@section('pageName', 'User Dashboard')
    @section('mainContent')
        <div class="container py-5">
            <div class="row">
                <div class="col-12">
                    <h2 class="h2 font-weight-semibold text-dark">
                        Dashboard
                    </h2>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-lg-8 mx-auto">
                    <div class="card shadow-sm">
                        <div class="card-body text-dark">
                            You're logged in!
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

