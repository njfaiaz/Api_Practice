<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ErrorResource;
use App\Http\Resources\SuccessResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    // Category View -------------------------------------------------------------
    public function index()
    {
        $categories = Category::latest()->get();

        return new SuccessResource([
            'message' => 'All Category',
            'data' => $categories
        ]);

    } // End Method



    // Data insert ----------------------------------------------------------------
    public function store(CategoryStoreRequest $request)
    {
        $formData = $request->validated();
        $formData['slug'] = Str::slug($formData['name']);

        Category::create($formData);

        return (new SuccessResource(['message' => 'Successfully Category Created.']))->response()->setStatusCode(201);

    } // End Method


    // Data show -------------------------------------------------------------
    public function show(Category $category) //  Category $category Model Binding
    {
        // $formatData['data'] = new CategoryResource($category);
        // return new SuccessResource($formatData);
        return new SuccessResource(['data' => $category]);

    } // End Method

    // Category Update -------------------------------------------------
    public function update(CategoryUpdateRequest $request, Category $category) //  Category $category Model Binding
    {
        $formData = $request->validated();
        $formData['slug'] = Str::slug($formData['name']);

        $category->update($formData);

        return new SuccessResource(['message' => 'Successfully Category updated.']);
    } // End Method


    // Category Delete ------------------------------------------------------
    public function destroy(Category $category) //  Category $category Model Binding
    {
        $category->delete();

        return (new SuccessResource(['message' => 'Successfully Category deleted.']))->response()->setStatusCode(201);

    } // End Method

}
