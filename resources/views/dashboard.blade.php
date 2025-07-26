@extends('layouts.defaultLayout')
    @section('mainContent')
        <div class="container py-5">
            <div class="row">
                <div class="col-12">
                    <h2 class="h2 font-weight-semibold text-dark">
                        {{ __('Dashboard') }}
                    </h2>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-lg-8 mx-auto">
                    <div class="card shadow-sm">
                        <div class="card-body text-dark">
                            {{ __("You're logged in!") }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

