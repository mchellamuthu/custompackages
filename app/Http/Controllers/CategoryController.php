<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Chella\Auditlogs\Auditor;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $categories = Category::get();

        return response()->json(['data' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = Category::create([
            'name' => $request->name,
        ]);

        Auditor::log(
            action: 'created',
            resource: $category,
            newValues: $category->getRawOriginal(),
        );

        return response()->json(['msg' => 'created']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Category $category)
    {
        // return response()->json(config('auditlog.database_connection'));
        Auditor::log(
            action: 'retrieved',
            resource: $this,
        );

        return response()->json(['data' => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category->name = $request->name;
        if ($category->isDirty()) {
            $category->save();
            Auditor::log(
                action: 'updated',
                resource: $category,
                newValues: $category->getRawOriginal(),
                oldValues: $category->getChanges(),
            );
        }

        return response()->json(['msg' => 'updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Category $category)
    {
        if ($category->delete()) {
            Auditor::log(
                action: 'deleted',
                resource: $category,
                oldValues: $category->getOriginal(),
            );
        }

        return response()->json(['msg' => 'deleted']);
    }
}
