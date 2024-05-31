<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use App\Models\Product;

class ProductController extends Controller
{
    // this method will show product page 
    public function index(){
        $products=Product::orderBy('created_at','DESC')->get();
        return view('products.list',['products'=>$products]);
        // $products=Product::all();
        // return view('products.list',compact($products));
    }
    // this method will show create product page 
    public function create(){
        return view('products.create');
    }
    // this method will store a product in db 
    public function store(Request $request){
        $rules=[
            'name'=>'required|min:5',
            'sku'=>'required|min:3',
            'price'=>'required|numeric'
        ];
        //only image will be selected 
        if($request->image!=''){
            $rules['image']='image';
        }

        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return redirect()->route('products.create')->withInput()->withErrors($validator);
        }
        // here we will insert product into db 
        $product = new Product();
        $product->name=$request->name;
        $product->sku=$request->sku;
        $product->price=$request->price;
        $product->description=$request->description;
        $product->save();

        if($request->image!=''){
            //image store
        $image = $request->image;
        $ext = $image->getClientOriginalExtension();
        $imageName = time().'.'.$ext;//unique image name
        
        // save image to products directory
        $image->move(public_path('uploads/products'),$imageName);

        //save name in database
        $product->image=$imageName;
        $product->save();
        }

        return redirect()->route('products.index')->with('success','Product added successfully.');
    }
    // this method will edit a product 
    public function edit($id){
        $product = Product::findOrFail($id);
        return view('products.edit',[
            'product'=>$product
        ]);
    }
    // this method will update a product  
    public function update($id, Request $request){
        $product = Product::findOrFail($id);
        $rules=[
            'name'=>'required|min:5',
            'sku'=>'required|min:3',
            'price'=>'required|numeric'
        ];
        //only image will be selected 
        if($request->image!=''){
            $rules['image']='image';
        }

        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return redirect()->route('products.edit',$product->id)->withInput()->withErrors($validator);
        }
        // here we will insert product into db 
        $product->name=$request->name;
        $product->sku=$request->sku;
        $product->price=$request->price;
        $product->description=$request->description;
        $product->save();

        if($request->image!=''){
            // delete old image 
            File::delete(public_path('uploads/products/'.$product->image));
            //image store
        $image = $request->image;
        $ext = $image->getClientOriginalExtension();
        $imageName = time().'.'.$ext;//unique image name

        // save image to products directory
        $image->move(public_path('uploads/products'),$imageName);

        //save name in database
        $product->image=$imageName;
        $product->save();
        }

        return redirect()->route('products.index')->with('success','Product updated successfully.');
    }
    // this method will distroy a product   
    public function destroy($id){
        $product = Product::findOrFail($id);
        // delete image 
        File::delete(public_path('uploads/products/'.$product->image));
        // delete product
        $product->delete();
        return redirect()->route('products.index')->with('success','Product deleted successfully.');

    }
}
