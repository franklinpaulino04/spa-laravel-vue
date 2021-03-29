<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        try
        {
            $products = Product::all()->sortByDesc->toArray();
            return response()->json(['result' => 1, 'data' => $products]);
        }
        catch (\Exception $e)
        {
            return response()->json(['result' => 0, 'msg' => $e->getMessage()]);
        }
    }

    public function store(Request $request)
    {
        try
        {
            $validator = \Validator::make($request->all(), [
                'name'           => 'required',
                'description'    => 'required',
                'price'          => 'required',
                'quantity'       => 'required',
            ]);

            if($validator->fails())
            {
                return response()->json(['errors' => $validator->errors(), 'result' => 0 , 'msg' => 'Bad Request']);
            }
            else
            {
                $product = new Product([
                    'name'           => $request->input('name'),
                    'description'    => $request->input('description'),
                    'price'          => $request->input('price'),
                    'quantity'       => $request->input('quantity'),
                ]);

                if($product->save())
                {
                    return response()->json(['result' => 1, 'msg' => 'Product created!']);
                }
            }
        }
        catch (\Exception $e)
        {
            return response()->json(['result' => 0, 'msg' => $e->getMessage()]);
        }

    }

    public function show($producId)
    {
        try
        {
            if($product = Product::find($producId))
            {
                return response()->json(['result' => 1, 'data' => $product]);
            }
        }
        catch (\Exception $e)
        {
            return response()->json(['result' => 0, 'msg' => $e->getMessage()]);
        }
    }

    public function update(Request $request, $id)
    {
        try
        {
            $validator = \Validator::make($request->all(), [
                'name'           => 'required',
                'description'    => 'required',
                'price'          => 'required',
                'quantity'       => 'required',
            ]);

            if($validator->fails())
            {
                return response()->json(['errors' => $validator->errors(), 'result' => 0 , 'msg' => 'Bad Request']);
            }
            else
            {
                $product = Product::find($id);
                $data = [
                    'name'           => $request->input('name'),
                    'description'    => $request->input('description'),
                    'price'          => $request->input('price'),
                    'quantity'       => $request->input('quantity'),
                ];

                if($product->update($data))
                {
                    return response()->json(['result' => 1, 'msg' => 'Product updated!']);
                }
            }
        }
        catch (\Exception $e)
        {
            return response()->json(['result' => 0, 'msg' => $e->getMessage()]);
        }
    }

    public function destroy($productId)
    {
        try
        {
            $product = Product::find($productId);
            if($product->delete())
            {
                return response()->json('Product deleted!');
            }
        }
        catch (\Exception $e)
        {
            return response()->json(['result' => 0, 'msg' => $e->getMessage()]);
        }
    }
}
