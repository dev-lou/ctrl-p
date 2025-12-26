<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceOption;
use App\Models\ServiceOfficer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceManagementController extends Controller
{
    /**
     * Display services management page.
     */
    public function index()
    {
        $services = Service::with('options')->ordered()->get();
        $officers = ServiceOfficer::ordered()->get();
        
        $stats = [
            'total_services' => Service::count(),
            'active_services' => Service::where('is_active', true)->count(),
            'total_officers' => ServiceOfficer::count(),
            'active_officers' => ServiceOfficer::where('is_active', true)->count(),
        ];

        return view('admin.services.index', compact('services', 'officers', 'stats'));
    }

    /**
     * Store a new service.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|string|max:50',
            'price_bw' => 'nullable|numeric|min:0',
            'price_color' => 'nullable|numeric|min:0',
            'price_label' => 'nullable|string|max:100',
            'category' => 'nullable|string|max:100',
            'category_description' => 'nullable|string|max:500',
            'is_active' => 'boolean',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['sort_order'] = Service::max('sort_order') + 1;
        $validated['icon'] = $validated['icon'] ?? '🖨️';
        $validated['is_active'] = $request->boolean('is_active', true);
        if (empty($validated['category'])) {
            $validated['category'] = 'General';
        }

        $service = Service::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Service created successfully!',
            'service' => $service->load('options'),
        ]);
    }

    /**
     * Update an existing service.
     */
    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|string|max:50',
            'price_bw' => 'nullable|numeric|min:0',
            'price_color' => 'nullable|numeric|min:0',
            'price_label' => 'nullable|string|max:100',
            'category' => 'nullable|string|max:100',
            'category_description' => 'nullable|string|max:500',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active', true);
        if (empty($validated['category'])) {
            $validated['category'] = 'General';
        }

        $service->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Service updated successfully!',
            'service' => $service->fresh()->load('options'),
        ]);
    }

    /**
     * Delete a service.
     */
    public function destroy(Service $service)
    {
        $service->delete();

        return response()->json([
            'success' => true,
            'message' => 'Service deleted successfully!',
        ]);
    }

    /**
     * Toggle service active status.
     */
    public function toggleStatus(Service $service)
    {
        $service->update(['is_active' => !$service->is_active]);

        return response()->json([
            'success' => true,
            'is_active' => $service->is_active,
            'message' => $service->is_active ? 'Service activated!' : 'Service deactivated!',
        ]);
    }

    /**
     * Store a service option.
     */
    public function storeOption(Request $request, Service $service)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'dimensions' => 'nullable|string|max:100',
            'price_bw' => 'nullable|numeric|min:0',
            'price_color' => 'nullable|numeric|min:0',
            'price_bw_label' => 'nullable|string|max:100',
            'price_color_label' => 'nullable|string|max:100',
            'size_class' => 'required|in:short,standard,long',
            'badge' => 'nullable|string|max:100',
            'is_active' => 'boolean',
        ]);

        $validated['sort_order'] = $service->options()->max('sort_order') + 1;
        $validated['is_active'] = $request->boolean('is_active', true);

        $option = $service->options()->create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Option added successfully!',
            'option' => $option,
        ]);
    }

    /**
     * Update a service option.
     */
    public function updateOption(Request $request, ServiceOption $option)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'dimensions' => 'nullable|string|max:100',
            'price_bw' => 'nullable|numeric|min:0',
            'price_color' => 'nullable|numeric|min:0',
            'price_bw_label' => 'nullable|string|max:100',
            'price_color_label' => 'nullable|string|max:100',
            'size_class' => 'required|in:short,standard,long',
            'badge' => 'nullable|string|max:100',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active', true);

        $option->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Option updated successfully!',
            'option' => $option,
        ]);
    }

    /**
     * Delete a service option.
     */
    public function destroyOption(ServiceOption $option)
    {
        $option->delete();

        return response()->json([
            'success' => true,
            'message' => 'Option deleted successfully!',
        ]);
    }

    /**
     * Store a new officer.
     */
    public function storeOfficer(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'nullable|string|max:255',
            'messenger_url' => 'nullable|url|max:500',
            'is_active' => 'boolean',
        ]);

        $validated['title'] = $validated['title'] ?? 'PRINTING OFFICER';
        $validated['sort_order'] = ServiceOfficer::max('sort_order') + 1;
        $validated['is_active'] = $request->boolean('is_active', true);

        $officer = ServiceOfficer::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Officer added successfully!',
            'officer' => $officer,
        ]);
    }

    /**
     * Update an officer.
     */
    public function updateOfficer(Request $request, ServiceOfficer $officer)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'nullable|string|max:255',
            'messenger_url' => 'nullable|url|max:500',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active', true);

        $officer->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Officer updated successfully!',
            'officer' => $officer,
        ]);
    }

    /**
     * Delete an officer.
     */
    public function destroyOfficer(ServiceOfficer $officer)
    {
        $officer->delete();

        return response()->json([
            'success' => true,
            'message' => 'Officer removed successfully!',
        ]);
    }
}
