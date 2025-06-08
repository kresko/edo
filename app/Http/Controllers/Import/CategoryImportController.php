<?php

namespace App\Http\Controllers\Import;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\EdoCategory;

class CategoryImportController extends Controller
{
    public function importCategories(Request $request)
    {
        $validatedCategoriesData = $request->validate([
            'categories' => 'required|array',
            'categories.*.name' => 'required|string|max:255',
            'categories.*.description' => 'nullable|string',
        ]);

        $results = [
            'created' => [],
            'updated' => [],
            'skipped' => []
        ];

        try {
            foreach ($validatedCategoriesData['categories'] as $validatedCategoryData) {
                $existing = EdoCategory::where('name', $validatedCategoryData['name'])->first();

                if ($existing) {
                   $existing->update(['description' => $validatedCategoryData['description' ?? null]]); 
                   $results['updated'][] = $existing;

                   continue;
                } 

                $newCategory = EdoCategory::create([
                    'name' => $validatedCategoryData['name'],
                    'description' => $validatedCategoryData['description'] ?? null
                ]);

                $results['created'][] = $newCategory;
            }

            return response()->json([
                'message' => 'Categories imported successfully!',
                'data' => $results,
                'stats' => [
                    'total' => count($validatedCategoriesData['categories']),
                    'created' => count($results['created']),
                    'updated' => count($results['updated']),
                    'skipped' => count($results['skipped'])
                ]
            ]);
        } catch(\Exception $e) {
            return response()->json([
                'message' => 'Error importing categories',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
