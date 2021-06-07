<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Category::all();
    }
    public function store()
    {
        $category = new Category;
        $category->name = request()->name;
        $category->save();

        return $category;
    }

    public function show($category)
    {
        return Category::find($category);
    }

    public function update($category)
    {
        $category = Category::find($category);
        $category->name = request()->name;
        $category->save();

        return $category;

    }

    public function destroy($category)
    {
        $category = Category::find($category);
        $category->delete();
        return $category;
    }
}
