<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
            abort_if(!Auth::user()->hasPermission('read-categories'), 403);

            $name = ($request->name) ? $request->name : '';
            $description = ($request->description) ? $request->description : '';

            $categories = Category::search('name', $name)
                ->orderBy('created_at', 'desc')
                ->search('description', $description)->paginate(10);

            return view('categories.index')->withCategories($categories)->withName($name)->withDescription($description);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(!Auth::user()->hasPermission('create-categories'), 403);

        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort_if(!Auth::user()->hasPermission('create-categories'), 403);

        $request->validate([
           'name' => 'required|unique:categories,name',
           'description' => 'required',
        ]);

        $category = new Category;
        $category->name = $request->name;
        $category->slug = $this->slugify($request->name, 'categories');
        $category->description = $request->description;
        $category->user_id = Auth::user()->id;
        $category->save();

        return redirect()->route('categories.index')->with('success', 'Category added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        abort_if(!Auth::user()->hasPermission('read-categories'), 403);

        $category = Category::where('slug', $slug)->first();

        return view('categories.show')->withCategory($category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        abort_if(!Auth::user()->hasPermission('update-categories'), 403);

        return view('categories.edit')->withCategory($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        abort_if(!Auth::user()->hasPermission('update-categories'), 403);

        $request->validate([
            'name' => 'required|unique:categories,name,'.$category->id,
            'description' => 'required',
        ]);

        $category->name = $request->name;
        $category->slug = $this->slugify($request->name, 'categories');
        $category->description = $request->description;
        $category->save();

        return redirect()->route('categories.index')->with('success', 'Category updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Category $category
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Category $category)
    {
        abort_if(!Auth::user()->hasPermission('delete-categories'), 403);

        if($category->blogs->count() > 0){
            return back()->with('danger', 'This category has linked blogs, cannot be deleted');
        }

        $category->delete();
        return redirect()->route('categories.index')->with('success', 'This category has deleted');
    }



    public function userindex()
    {
        $categories = Category::paginate(10);

        return view('users.categories.index')->withCategories($categories);
    }
}
