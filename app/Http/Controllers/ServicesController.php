<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServiceOfficer;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    /**
     * Show the customer-facing services page with dynamic data.
     */
    public function index(Request $request)
    {
        $services = Service::with(['options' => function ($query) {
            $query->active()->ordered();
        }])->active()->ordered()->get();

        $options = $services->flatMap->options;
        $officers = ServiceOfficer::active()->ordered()->get();
        $groupedServices = $services->groupBy(function ($service) {
            return $service->category ?: 'General';
        });

        $categoryDescriptions = $groupedServices->map(function ($group) {
            return optional($group->first())->category_description;
        });

        return view('services.index', [
            'services' => $services,
            'options' => $options,
            'officers' => $officers,
            'groupedServices' => $groupedServices,
            'categoryDescriptions' => $categoryDescriptions,
        ]);
    }

    /**
     * Show a single service with its variants/options.
     */
    public function show(Service $service)
    {
        abort_unless($service->is_active, 404);

        $service->load(['options' => function ($query) {
            $query->active()->ordered();
        }]);

        return view('services.show', [
            'service' => $service,
            'options' => $service->options,
        ]);
    }
}
