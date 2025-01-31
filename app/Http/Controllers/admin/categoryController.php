<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categorie;
use Illuminate\Support\Facades\File;

class categoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mydata=Categorie::orderBy('id','desc')->get();

        return view('adminLTE.category',compact('mydata'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('adminLTE.addCategory');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
        ]);
        $image = $request->file('image');
        $name = time().rand(). "." .$image->getClientOriginalExtension();
        $path = public_path('designing\assets\images\auction');
        $image->move($path,$name);
        // dd($request->toarray());

        $mydata = new Categorie;
        $mydata->category_name = $request->name;
        $mydata->category_image ='designing\assets\images\auction\\'.$name;
        $mydata->category_description= $request->description;

        $mydata->save();

        
        return redirect()->route('admin.category.index')->with('success', 'Category created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // $category=categories::(orderBYd])
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $mydata=categorie::where('id','=',$id)->firstOrFail();
        $image = Public_path($mydata->category_image);
        if(File::exists($image)){
            File::delete($image);
        }
        $mydata->delete();
        return redirect()->route('admin.category.index')->with('success', 'Category delete successfully!');

    }
}
