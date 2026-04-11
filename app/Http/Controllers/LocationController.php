<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stevebauman\Location\Facades\Location;
use App\Models\Visitors;
use App\Models\Visit;


class LocationController extends Controller
{
    //
    public function index(Request $request)
    {
        $userIP = $request->ip();
        // or
        // $userIP = $request->getClientIp();
        // or 
        // $userIP = $_SERVER['REMOTE_ADDR'];
        // or manually assign
        // $userIP = '66.102.0.0'; // Example IP address for testing

        // Get the location information based on the user's IP address
        $location = Location::get($userIP);
        // Fallback to default values if location information is not available
        if (!$location) {
            $location = (object) [
                'ip' => $userIP,
                'countryName' => null,
                'countryCode' => null,
                'regionName' => null,
                'regionCode' => null,
                'cityName' => null,
                'zipCode' => null,
                'latitude' => null,
                'longitude' => null,
                'areaCode' => null,
                'timeZone' => null,
            ];
        }
        // Store or update the visitor information in the database
        Visitors::updateOrCreate(
            ['ip' => $location->ip],
            [
                'country' => $location->countryName,
                'country_code' => $location->countryCode,
                'region_name' => $location->regionName,
                'region_code' => $location->regionCode,
                'city_name' => $location->cityName,
                'zip_code' => $location->zipCode,
                'latitude' => $location->latitude,
                'longitude' => $location->longitude,
                'area_code' => $location->areaCode,
                'time_zone' => $location->timeZone
            ]
        );

        // Checks database cache to prevent spam refresh counting
        $recentVisit = Visit::where('visitor_id', $visitor->id)
            ->where('visited_at', '>', now()->subMinutes(10))
            ->exists();

        // If there is no recent visit, create a new visit record    
        if (!$recentVisit) {
            Visit::create([
                'visitor_id' => $visitor->id,
                'visited_at' => now(),
            ]);
        }

        return view('index', ['location' => $location]);
    }

    public function displayIPData(Request $request)
    {
        $userIP = $request->ip();
        // $userIP = '66.101.0.0'; // Example IP address for testing
        $location = Location::get($userIP);

         // Fallback to default values if location information is not available
         if (!$location) {
            $location = (object) [
                'ip' => $userIP,
                'countryName' => null,
                'countryCode' => null,
                'regionName' => null,
                'regionCode' => null,
                'cityName' => null,
                'zipCode' => null,
                'latitude' => null,
                'longitude' => null,
                'areaCode' => null,
                'timeZone' => null,
            ];
        }
        return view('webpages.whatIsMyIP', ['location' => $location]);
    }



}
