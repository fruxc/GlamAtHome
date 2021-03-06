<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Products;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $products = Products::latest()->paginate(5);
      return view('products.index',compact('products'))
          ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $request->validate([
      'type' => ['required', 'string', 'max:255'],
      'name' => ['required', 'string', 'max:255'],
      'quality' => ['required', 'string', 'max:255'],
      'cost' => ['required'],
      ]);

      Products::create($request->all());

      return redirect()->route('products.index')
                      ->with('success','Product has been created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

      $products = Products::find($id);
      return view('products.show',compact('products'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $products = Products::find($id);
      return view('products.edit',compact('productsx'));

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
      $request->validate([
      'name' => ['required', 'string', 'max:255'],
      'type' => ['required', 'string', 'max:255'],
      'quality' => ['required', 'string', 'max:255'],
      'cost' => ['required'],
      ]);

      $products = Products::find($id);
      $products->update($request->all());

      return redirect()->route('products.index')
                      ->with('success','Product has been created successfully.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

      $products = Products::find($id);
      $products->delete();

      return redirect()->route('products.index')
                      ->with('success','Product has been deleted successfully');
    }
}
