<?php

namespace App\Http\Controllers;

use App\Category;
use App\Contributor;
use App\User;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::with('contributors')->get();
        return view('categories.all',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        return view('categories.new',compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $name = request('name');
        $user_ids = request('users');
        $percs = request('percentages');

        $category = Category::create(['name'=>$name]);

        foreach ($user_ids as $key => $u_id) {
            Contributor::create([
                'category_id'=>$category->id,
                'user_id' => $u_id,
                'contribution' => $percs[$key]
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $category)
    {
        $user_ids = request('users');
        $percs = request('percentages');

        foreach ($user_ids as $key => $u_id) {
            Contributor::where([
                'category_id'=>$category,
                'user_id' => $u_id
            ])
            ->update(['contribution'=>$percs[$key]]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
    }
}
