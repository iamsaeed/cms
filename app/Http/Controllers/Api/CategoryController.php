<?php

namespace App\Http\Controllers\Api;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ProcessResponseTrait;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    use ProcessResponseTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $name = ($request->name) ? $request->name : '';
        $description = ($request->description) ? $request->description : '';

        $categories = Category::search('name', $name)
            ->orderBy('created_at', 'desc')
            ->search('description', $description)->paginate(10);

            return $this->processResponse($categories,'success');


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        if(!$request->has('id')) {
            $request->validate([
                'name' => 'required|unique:categories,name',
                'description' => 'required',
            ]);
        } else {
            $request->validate([
                'name' => 'required|unique:categories,name,'.$request->id,
                'description' => 'required',
            ]);
        }

        if($request->has('slug'))
        {
            $slug = $this->slugify($request->name, 'categories');
        };

        $category = Category::updateOrCreate(
            ['id' => $request->id],
            [
            'user_id' => 1,
            'slug' => ($request->has('slug')) ? $this->slugify($request->slug, 'categories') : Category::find($request->id)->slug,
            'name' => $request->name,
            'description' => $request->description
            ]
        );


        return $this->processResponse($category,'success', 'Category created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Category $category
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy($id)
    {

        $category = Category::find($id);

        if($category)
        {
            if($category->blogs->count() > 0)
            {
                return $this->processResponse(null,'error', 'This category has linked blogs, cannot be deleted');
            }
            $category->delete();

            return $this->processResponse(null,'success', 'This category has been deleted');

        } else {
            return $this->processResponse(null,'error', 'This category does not exists');
        }

    }
}
