<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::where('parent_id', 0)->get()
            ->map(function($query) {
                $query->sub = $this->getChildCategories($query->id);
                return $query;
            });
    
        return view('admin.category.index', compact('categories'));
    }

    private function getChildCategories($parent_id)
    {
        $categories = Category::where('parent_id', $parent_id)->get();

        if ($categories->count() > 0) {
            $categories->map(function($query) {
                $query->sub = $this->getChildCategories($query->id);
                return $query;
            });
            return $categories;
        }

        return null;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Category::where('name', $request->name)->get()) {
            return back()->with('conflict', 'Conflicted');
        }

        $category = Category::create([
            'name' => $request->name,
            'parent_id' => $request->parent
        ]);

        return redirect('/admin/categories/'.$category->id.'/edit')->with('created', 'Category created');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.category.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
