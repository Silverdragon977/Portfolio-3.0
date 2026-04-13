<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stevebauman\Location\Facades\Location;
use App\Models\Visitors;
use App\Models\Visits;


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
        // $userIP = '66.106.0.0'; // Example IP address for testing


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
            ];
        }
        // Store or update the visitor information in the database
        $visitor = Visitors::updateOrCreate(
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
            ]
        );

        // Checks database cache to prevent spam refresh counting
        $recentVisit = Visits::where('visitor_id', $visitor->id)
            ->where('visited_at', '>', now()->subMinutes(10))
            ->exists();

        // If there is no recent visit, create a new visit record    
        if (!$recentVisit) {
            Visits::create([
                'visitor_id' => $visitor->id,
                'visited_at' => now(),
            ]);
        }
        return view('index', compact('location'));
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
            ];
        }
        return view('webpages.whatIsMyIP', ['location' => $location]);
    }

    public function getStatsData()
    {
        // Unique visitors per day (new users)
        $uniquePerDay = Visitors::selectRaw('DATE(created_at) as date, COUNT(DISTINCT ip) as unique_visitors')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Total visits per day (including repeat visits)
        $totalPerDay = Visits::selectRaw('DATE(visited_at) as date, COUNT(*) as total_visits')
            ->groupBy('date')
            ->orderBy('date')
            ->get();
        
        // Today
        $todayUnique = Visitors::whereDate('created_at', now()->toDateString())->distinct('ip')->count('ip');
        $todayTotal = Visits::whereDate('visited_at', now()->toDateString())->count();

        // This week
        $weekUnique = Visitors::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->distinct('ip')->count('ip');
        $weekTotal = Visits::whereBetween('visited_at', [now()->startOfWeek(), now()->endOfWeek()])->count();    

        // This month
        $monthUnique = Visitors::whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()])->distinct('ip')->count('ip');
        $monthTotal = Visits::whereBetween('visited_at', [now()->startOfMonth(), now()->endOfMonth()])->count();

        // All time
        $allUnique = Visitors::distinct('ip')->count('ip');
        $allTotal = Visits::count();

        return [
                    'today' => ['unique' => $todayUnique, 'total' => $todayTotal],
                    'week' => ['unique' => $weekUnique, 'total' => $weekTotal],
                    'month' => ['unique' => $monthUnique, 'total' => $monthTotal],
                    'all' => ['unique' => $allUnique, 'total' => $allTotal],
                    'uniquePerDay' => $uniquePerDay,
                    'totalPerDay' => $totalPerDay
                ];  
    }
    public function stats()
    { // grabs the stats data and returns it as JSON for the admin dashboard to use in charts
        $statsData = $this->getStatsData();
        return response()->json($statsData);
    }


}
