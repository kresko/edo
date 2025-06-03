<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryImportController extends Controller
{
    public function importCategories(Request $request)
    {
        $test = '';

        return response()->json([
            'message' => 'Categories imported successfully!',
            'test' => $test,
        ]);
    }
}
