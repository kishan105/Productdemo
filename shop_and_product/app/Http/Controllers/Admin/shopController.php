<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\shop;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Imports\shopImport;
use App\Exports\shopExport;
use Maatwebsite\Excel\Facades\Excel;

class shopController extends Controller
{
    public function list()
    {
        $shop = shop::get()->toArray();
        return view('shop.list')->with(['shop'=>$shop]);
    }

    public function add()
    {
        return view('shop.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'shop_name' => 'required|max:100',
            'address' => 'required|max:100',
            'email' => 'required|unique',
            'image' => 'required|max:100'

        ]);
        $shop = new shop;
        $shop->shop_name = $request->input('shop_name');
        $shop->address = $request->input('address');
        $shop->email = $request->input('email');
        if($request->hasfile('image'))
        {
            $file = $request->file('image');
            $extenstion = $file->getClientOriginalExtension();
            $filename = time().'.'.$extenstion;
            $file->move('uploads/shop/', $filename);
            $shop->image = $filename;
        }
        $shop->save();
            Session::flash('message', 'shop added successfully.');
            Session::flash('alert-class', 'alert-success');

        return redirect()->back();
    }

    public function edit($id)
    {
        $shop = shop::find($id);
        return view('shop.edit')->with(['shop'=>$shop]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'shop_name' => 'required|max:100',
            'address' => 'required|max:100',
            'email' => 'required|max:50'
        ]);
        $shop = shop::find($id);
        $shop->shop_name = $request->input('shop_name');
        $shop->address = $request->input('address');
        $shop->email = $request->input('email');
        if($request->hasfile('image'))
        {
            $destination = 'uploads/shop/'.$shop->image;
            if(File::exists($destination))
            {
                File::delete($destination);
            }
            $file = $request->file('image');
            $extenstion = $file->getClientOriginalExtension();
            $filename = time().'.'.$extenstion;
            $file->move('uploads/shop/', $filename);
            $shop->image = $filename;
        }
        $shop->update();
            Session::flash('message', 'shop updated successfully.');
            Session::flash('alert-class', 'alert-success');

        return redirect()->back();
    }

    public function delete($id)
    {
        $shop = shop::find($id);
        $destination = 'uploads/shop/'.$shop->image;
        if(File::exists($destination))
        {
            File::delete($destination);
        }
        $shop->delete();

        return redirect()->back()->with('message','shop deleted successfully');
    }

    public function import()
    {
        Excel::import(new shopImport, request()->file('file'));
        return redirect()->back()->with('success','Data Imported Successfully');
    }

    public function export()
    {
        return Excel::download(new shopExport, 'shop.csv');
    }
}
