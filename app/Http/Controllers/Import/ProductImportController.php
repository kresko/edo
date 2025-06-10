<?php

namespace App\Http\Controllers\Import;

use App\Http\Controllers\Controller;
use App\Models\EdoProduct;
use Illuminate\Http\Request;

class ProductImportController extends Controller
{
    public function importProducts(Request $request)
    {
        $validatedProductsData = $request->validate([
            'products' => 'required|array',
            'products.*.name' => 'required|string|max:255',
            'products.*.description' => 'nullable|string',
        ]);

        $results = [
            'created' => [],
            'updated' => [],
            'skipped' => []
        ];

        try {
            foreach ($validatedProductsData['products'] as $validatedProductData) {
                $existing = EdoProduct::where('name', $validatedProductData['name'])->first();

                if ($existing) {
                    $existing->update(['description' => $validatedProductData['description' ?? null]]);
                    $results['updated'][] = $existing;

                    continue;
                }

                $newProduct = EdoProduct::Create([
                    'name' => $validatedProductData['name'],
                    'description' => $validatedProductData['description'] ?? null
                ]);

                $results['created'][] = $newProduct;
            }

            return response()->json([
                'message' => 'Products imported successfully!',
                'data' => $results,
                'stats' => [
                    'total' => count($validatedProductsData['products']),
                    'created' => count($results['created']),
                    'updated' => count($results['updated']),
                    'skipped' => count($results['skipped'])
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error importing products!',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}