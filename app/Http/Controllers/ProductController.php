<?php

namespace App\Http\Controllers;

use App\Exports\ProductExport;
use App\Models\Customer;
use App\Models\Product;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;


class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with(['customer', 'userName'])->get();
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = Customer::all();
        return view('products.create_edit', compact('customers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' =>'required|min:3|max:50',
            'customer_id' => 'required',
            'quantity' =>'required|numeric|min:1',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $input = $request->input();
        unset($input['_token']);
        unset($input['_method']);
        $input['user_id'] = Auth::user()->id;
        Product::create($input);
        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $customers = Customer::all();
        return view('products.create_edit', compact('product', 'customers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validator = Validator::make($request->all(), [
            'name' =>'required|min:3|max:50',
            'customer_id' => 'required',
            'quantity' =>'required|numeric|min:1',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $input = $request->input();
        unset($input['_token']);
        unset($input['_method']);
        $input['user_id'] = Auth::user()->id;
        $product->update($input);
        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }

    public function Export()
    {
        return Excel::download(new ProductExport, 'products.xlsx');
    }
}
