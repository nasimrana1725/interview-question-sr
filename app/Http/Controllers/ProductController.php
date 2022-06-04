<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantPrice;
use App\Models\Variant;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $products = Product::with('productVariantePrice')->groupBy('id')->get();
        $productID = collect($products)->pluck('id')->toArray();
        $products_price = ProductVariantPrice::whereIN('product_id',$productID)->get()->toArray();
        $products_variante = ProductVariant::whereIN('product_id',$productID)->get()->toArray();
        $data = [];
        $productDetails = [];
        foreach ($products as $key=>$product){
            $products_key_price = collect($products_price)->where('product_id',$product->id)->toArray();
            $products_key_variant = collect($products_variante)->where('product_id',$product->id)->toArray();
            $data ['id'] = $product->id;
            $data ['title'] = $product->title;
            $data ['description'] = $product->description;
            $data ['price'] = $products_key_price;
            $data ['variante'] = $products_key_variant;
            $productDetails[$key] = $data;

            dd($data,$productDetails);
        }
//        with('productVariante')->
//        dd($products_variante,$products,$productID,collect($products_price)->where('product_id',1)->toArray());
        return view('products.index',compact('productDetails'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        $variants = Variant::all();
        return view('products.create', compact('variants'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        dd($request->all());
    }


    /**
     * Display the specified resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function show($product)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $variants = Variant::all();
        return view('products.edit', compact('variants'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
