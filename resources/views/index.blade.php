<!-- // HomePage -->
@extends('layouts.defaultLayout')

    @section('header')
        
    @endsection
        
    @section('mainContent')
        <br><br><br>
        <h1>Welcome to My Portfolio!</h1>
        {{-- @if($location->ip === '127.0.0.1')
            <h2>Unable to retrieve your IP information.</h2>
            <h3>It seems you are accessing the site from a local environment (localhost).</h3>
            <h5>Please deploy the site to a live server to see your actual IP information.</h5>
        @elseif($location)
            <table class="table table-striped table-bordered" style="width: 50%; max-width: 800px; margin: auto; ">
                <thead>
                    <tr>
                        <th>Data Type</th>
                        <th>Value</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Your IP Address:</strong></td>
                        <td>{{ $location->ip }}</td>
                    </tr>
                    <tr>
                        <td><strong>Country:</strong></td>
                        <td>{{ $location->countryName }} ({{ $location->countryCode }})</td>
                    </tr>
                    <tr>
                        <td><strong>Region Name:</strong></td>
                        <td>{{ $location->regionName }}</td>
                    </tr>
                    <tr>
                        <td><strong>Region Code:</strong></td>
                        <td>{{ $location->regionCode }}</td>
                    </tr>
                    <tr>
                        <td><strong>City Name:</strong></td>
                        <td>{{ $location->cityName }}</td>
                    </tr>
                    <tr>
                        <td><strong>Zip Code:</strong></td>
                        <td>{{ $location->zipCode }}</td>
                    </tr>
                    <tr>
                        <td><strong>Latitude:</strong></td>
                        <td>{{ $location->latitude }}</td>
                    </tr>
                    <tr>
                        <td><strong>Longitude:</strong></td>
                        <td>{{ $location->longitude }}</td>
                    </tr>
                    <tr>
                        <td><strong>Area Code:</strong></td>
                        <td>{{ $location->areaCode }}</td>
                    </tr>
                    {{-- <tr>
                        <td><strong>Timezone:</strong></td>
                        <td>{{ $location->timezone}}</td>
                    </tr> --}}
            
                </tbody>
            </table>
        @else
            <h1>Unable to retrieve your IP information.</h1>
            <p>Please try again later.</p>
        @endif --}}
    @endsection
