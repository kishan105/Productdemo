<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\product;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Imports\productImport;
use App\Exports\productExport;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\Console\Input\Input;

class productController extends Controller
{
    public function list(Request $request)
    {
        $product = product::query();

        if($request->get('min_price')!==null && $request->get('max_price')!==null)
        {
            $min=$request->get('min_price');
            $max=$request->get('max_price');

            if($min >0 && $max >0){
                $product = $product->whereBetween('price',[$min,$max]);
            }
        }
        $product= $product->get()->toArray();
        return view('product.list')->with(['product'=>$product]);
    }

    public function add()
    {
        $product = product::get();
        return view('product.add')->with(['product'=>$product]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required|max:100',
            'price' => 'required',
            'video' => 'required'

        ]);
        $product = new product;
        $product->product_name = $request->input('product_name');
        $product->price = $request->input('price');
        $product->stock = $request->input('stock');
        $product->shop_id = $request->input('shop_id');
        if($request->hasfile('video'))
        {
            $file = $request->file('video');
            $extenstion = $file->getClientOriginalExtension();
            $filename = time().'.'.$extenstion;
            $file->move('uploads/product/', $filename);
            $product->video = $filename;
        }
        $product->save();
            Session::flash('message', 'product added successfully.');
            Session::flash('alert-class', 'alert-success');

        return redirect()->back();
    }

    public function edit($id)
    {
        $product = product::find($id);
        $shops = shop::all();
        return view('product.edit')->with(['product'=>$product,'shops'=>$shops]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'product_name' => 'required|max:100',
            'price' => 'required',
            'video' => 'required'
        ]);
        $check = product::where('shop_id',$request->input('shop_id'))->where('product_name',$request->input('product_name'))->count();
        if($check > 0){
            Session::flash('message', 'product duplicate found for same shop.');
            Session::flash('alert-class', 'alert-danger');
        }else{
            $product = product::find($id);
            $product->product_name = $request->input('product_name');
            $product->price = $request->input('price');
            $product->stock = $request->input('stock');
            $product->shop_id = $request->input('shop_id');
            if($request->hasfile('video'))
            {
                $destination = 'uploads/product/'.$product->video;
                if(File::exists($destination))
                {
                    File::delete($destination);
                }
                $file = $request->file('video');
                $extenstion = $file->getClientOriginalExtension();
                $filename = time().'.'.$extenstion;
                $file->move('uploads/product/', $filename);
                $product->video = $filename;
            }
            $product->update();
                Session::flash('message', 'product updated successfully.');
                Session::flash('alert-class', 'alert-success');


        }
        return redirect()->back();
    }

    public function delete($id)
    {
        $product = product::find($id);
        $destination = 'uploads/product/'.$product->video;
        if(File::exists($destination))
        {
            File::delete($destination);
        }
        $product->delete();

        return redirect()->back()->with('message','product deleted successfully');
    }

    public function importproduct()
    {
        Excel::import(new productImport, request()->file('file'));
        return redirect()->back()->with('success','Data Imported Successfully');
    }

    public function exportproduct()
    {
        return Excel::download(new productExport, 'product.csv');
    }
}
