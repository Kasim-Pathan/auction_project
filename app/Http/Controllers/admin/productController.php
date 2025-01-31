<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\product;
use App\Models\Categorie;


class productController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    //     $mydata=product::orderBy('id','desc')
    //     ->leftjoin('categories','products.category_id'  ,'=','categories.id')
    //     ->select('products.*,categories.category_name as temp')
    //     ->get();
    //     dd($mydata->toarray());
        
    //     return view('adminLTE.product',compact('mydata'));
    //     //
            $mydata = product::orderBy('id', 'desc')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->select('products.*', 'categories.category_name as category_name')
            ->get();
            
            return view('adminLTE.product', compact('mydata'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Categorie::orderBy('id','desc')->get();

        return view('adminLTE.addProducts',compact('category'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'Pname'         => ['required',],
            'category_id'   => ['required',],
            'sale_price'    => ['required',],
            'bid_price'     => ['required',],
            'start_at'      => ['required',],
            'end_at'        => ['required',],
            'main_image'    => ['required','image'],
            'more_images' => ['image']
        ]);
        // for image
        $image = $request->file('main_image');
        $name = time().rand(). "." .$image->getClientOriginalExtension();
        $path = public_path('designing\assets\images\product');
        $image->move($path,$name);

        // for optional image
        if($request->has('more_images')){
            $myimage = $request->file('more_images');
            $myname = time().rand(). "." .$myimage->getClientOriginalExtension();
            $mypath = public_path('designing\assets\images\product');
            $myimage->move($mypath,$myname);
        }

        $mydata = new product;
        $mydata->category_id =$request->category_id;
        // $mydata->features_id =$request->name;
        $mydata->name =$request->Pname;
        $mydata->image ='designing\assets\images\product\\'.$name;
        if($request->has('more_images')){
            $mydata->optional_image ='designing\assets\images\product\\'.$myname;
        }

        $mydata->price =$request->sale_price;
        $mydata->bid_price =$request->bid_price;
        $mydata->auction_start =date('Y-m-d H:i:s',strtotime($request->start_at));
        $mydata->auction_end =date('Y-m-d H:i:s',strtotime($request->end_at));

        
        $mydata->save();

        return redirect()->route('admin.product.index')->with('success', 'product created successfully!');


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
        $data=product::findOrFail($id);
        $category = Categorie::orderBy('id','desc')->get();
        return view('adminLTE.addProducts',compact('data','category'));
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'Pname'         => ['required',],
            'category_id'   => ['required',],
            'sale_price'    => ['required',],
            'bid_price'     => ['required',],
            'start_at'      => ['required',],
            'end_at'        => ['required',],
            'main_image'    => ['image'],
            'more_images'   => ['image'],
        ]);
        $mydata=product::findOrFail($id);
        $mydata->category_id = $request->category_id;
        // $mydata->features_id =$request->name;
        $mydata->name =$request->Pname;
        if($request->has('main_image')){
            
            $image = Public_path($mydata->image);
            if(File::exists($image)){
                File::delete($image);
            }

            $image = $request->file('main_image');
            $name = time().rand(). "." .$image->getClientOriginalExtension();
            $path = public_path('designing\assets\images\product');
            $image->move($path,$name);
            $mydata->image ='designing\assets\images\product\\'.$name;
        }
        if($request->has('more_images')){
            $image = Public_path($mydata->optional_image);
            if(File::exists($image)){
                File::delete($image);
            }
            
            $myimage = $request->file('more_images');
            $myname = time().rand(). "." .$myimage->getClientOriginalExtension();
            $mypath = public_path('designing\assets\images\product');
            $myimage->move($mypath,$myname);
            $mydata->optional_image ='designing\assets\images\product\\'.$myname;
        }

        $mydata->price =$request->sale_price;
        $mydata->bid_price =$request->bid_price;
        $mydata->product_start =date('Y-m-d H:i:s',strtotime($request->start_at));
        $mydata->product_end =date('Y-m-d H:i:s',strtotime($request->end_at));

        
        $mydata->save();

        return redirect()->route('admin.product.index')->with('success', 'product updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
        $mydata=product::findOrFail($id);
        // dd($mydata->toarray());
        $image = $mydata->optional_image;
        if($image){
                $image = Public_path($image);
                    if(File::exists($image)){
                    File::delete($image);
                    }
            
        }
        $image = Public_path($mydata->image);
        if(File::exists($image)){
            File::delete($image);
        }
        $mydata->delete();
        return redirect()->route('admin.product.index')->with('success', 'product delete successfully!');

    }
}
