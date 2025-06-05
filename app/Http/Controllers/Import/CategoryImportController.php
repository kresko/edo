<?php

namespace App\Http\Controllers\Import;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
