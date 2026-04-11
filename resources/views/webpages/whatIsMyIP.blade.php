@extends('layouts.defaultLayout')

    @section('header')
    @endsection
        
    @section('mainContent')
        @if($location)
            <h1>What's My IP?</h1>
            <hr>
            <p> Location data may not be 100% accurate, but it provides a general idea of where your IP address is located. </p>
            <p> The information displayed below is based on the IP address detected from your request.</p>
            <p> Data is retrieved using the Stevebauman\Location package that utilizes the IP2Location database to provide geolocation information based on the visitor's IP address. </p>
            <hr><br>
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
                        <tr>
                            <td><strong>Timezone:</strong></td>
                            <td>{{ $location->timezone}}</td>
                        </tr>

                    </tbody>
                </table>
        @else
            <h1>Unable to retrieve your IP information.</h1>
            <p>Please try again later.</p>
        @endif

    @endsection
