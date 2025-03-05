<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function __invoke(Request $request): Response
    {
        // Get search query from request
        $search = $request->input('search');
        $typeFilter = $request->input('typeFilter'); // Get the type filter from request

        // Fetch items, applying search and type filter
        $items = Item::query()
            ->when($search, function ($query, $search) {
                $query->where('name', 'LIKE', "%{$search}%")
                      ->orWhere('description', 'LIKE', "%{$search}%")
                      ->orWhere('content_type', 'LIKE', "%{$search}%");
            })
            ->when($typeFilter, function ($query, $typeFilter) {
                $query->where('content_type', $typeFilter);
            })
            ->oldest()
            ->limit(10)
            ->get();

        return Inertia::render('Dashboard', [
            'items' => $items,
            'search' => $search,
            'typeFilter' => $typeFilter
        ]);
    }

    // Deletes item by id
    public function destroy(Item $item)
    {
        $item->delete();

        return redirect()->back()->with('success', 'Item deleted successfully.');
    }
}
