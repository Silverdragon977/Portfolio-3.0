<!-- // HomePage -->
@extends('layouts.defaultLayout')

    @section('header')
        {{-- <script> # Script to auto play and pause based on visibility
            document.addEventListener('DOMContentLoaded', () => {
                const videos = document.querySelectorAll('video');
            
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.play();
                        } else {
                            entry.target.pause();
                        }
                    });
                }, {
                    threshold: 0.5
                });
                videos.forEach(video => observer.observe(video));
            });
        </script> --}}
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const sections = document.querySelectorAll('.video-section');
            
                let activeVideo = null;
            
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        const section = entry.target;
                        const video = section.querySelector('video');
                    
                        if (entry.isIntersecting && entry.intersectionRatio > 0.6) {
                            //  Make this the active section
                            sections.forEach(s => s.classList.remove('active'));
                            section.classList.add('active');
                        
                            //  Pause previous video
                            if (activeVideo && activeVideo !== video) {
                                activeVideo.pause();
                            }
                        
                            //  Play this one
                            video.play();
                            activeVideo = video;
                        
                        } else {
                            section.classList.remove('active');
                            section.classList.add('inactive');
                        
                            video.pause();
                            video.currentTime = 0; // Reset to start
                        }
                    });
                }, {
                    threshold: [0.2, 0.6, 1.0]
                });
            
                sections.forEach(section => observer.observe(section));
            });
        </script>
    @endsection
        
    @section('mainContent')
        <br>
        <h1>Welcome to My Portfolio!</h1>
        <br><br>
        <h2> Below is a tour of my website and its features as a user and administrator. </h2>
        <br>
        <x-video-card 
            videoName="1ProtectedRoutesWithBreeze"
            caption="<strong>Using Laravel Breeze I can protect CRUD routes and ensure only authenticated users can access them. <br><br> This way only users can post messages to my backend for me to view later!</strong>"
            side="left"
            heading="Laravel Breeze Route Protection" />
        
        <x-video-card
            videoName="2AdminPanelProtection"
            caption="<strong>Admin Panel Protection</strong>"
            side="right"
            heading="Admin Panel Protection" />
        
        <x-video-card
            videoName="3AdminPanelDemoPt1"
            caption="<strong>Admin Panel CRUD Operations</strong>"
            side="left"
            heading="Admin Panel CRUD Operations" />
        
        <x-video-card
            videoName="4AdminPanelDemoPt2"
            caption="<strong>Admin Panel User Management</strong>"
            side="right"
            heading="Admin Panel User Management" />
        
        <x-video-card
            videoName="5WhatsMyIPDemo"
            caption="<strong>Whats My IP Demo</strong>"
            side="left"
            heading="Whats My IP Demo" />
        
        <x-video-card
            videoName="6ClickerGameDemo"
            caption="<strong>Clicker Game Demo</strong>"
            side="right"
            heading="Clicker Game Demo" />
        



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
            
                {{-- </tbody>
            </table>
        @else
            <h1>Unable to retrieve your IP information.</h1>
            <p>Please try again later.</p>
        @endif --}}
    @endsection
