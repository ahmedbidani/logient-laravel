<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Stevebauman\Location\Facades\Location;
use Illuminate\Support\Facades\Log;


class AccessLogger
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        $startTime = microtime(true);
        // Get url
        $url = $request->fullUrl();
        // Get user id
        $userId = auth()->id();
        // Get ip
        $ip = $request->ip();
        // Get country
        $location = Location::get($ip);
        $country = isset($location->countryName) ? $location->countryName : null;
        // Get user agent of naviagation
        $userAgent = $request->header('User-Agent');
        // Send message to file log access
        $logMessage  = "Le temps d'accès: " . date('Y-m-d H:i:s', $startTime) . "\n";
        $logMessage .= "Le lien accédé: $url\n";
        $logMessage .= "L'identifiant de l'utilisateur s'il est connecté: $userId\n";
        $logMessage .= "Adresse IP du client: $ip\n";
        $logMessage .= "Le pays: $country\n";
        $logMessage .= "Le User Agent du navigateur: $userAgent\n";

        Log::channel('access')->info($logMessage);

        return $response;
    }
}



