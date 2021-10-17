<?php

namespace App\Http\Controllers\Api;

use App\Exports\ProductExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\HTTP\Response;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $products = Product::all();
        return response()->json(['message' => 'Product updated!', 'products' => ProductResource::collection($products)], Response::HTTP_OK);


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AddProductRequest $request
     * @return JsonResponse
     */
    public function store(AddProductRequest $request): JsonResponse
    {
        try {
            $product = new Product([
                'title' => $request->title,
                'description' => $request->description,
                'price' => $request->price
            ]);
            $product->save();

            return response()->json('Product created!', Response::HTTP_OK);

        } catch (QueryException $ex) {
            return response()->json($ex->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'No Product Found Against this Id.'], Response::HTTP_BAD_REQUEST);
        }
        return response()->json(new ProductResource($product), Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProductRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UpdateProductRequest $request, int $id): JsonResponse
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'No Product Found Against this Id.'], Response::HTTP_BAD_REQUEST);
        }
        try {
            $product->update($request->all());
            return response()->json('Product updated!', Response::HTTP_OK);
        } catch (QueryException $ex) {
            return response()->json($product, Response::HTTP_BAD_REQUEST);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'No Product Found Against this Id.'], Response::HTTP_BAD_REQUEST);
        }
        $product->delete();

        return response()->json('Product deleted!', Response::HTTP_OK);
    }

    public function export(){
        (new ProductExport())->store('products.csv','public');

        return response()->json('Product Export in Process!', Response::HTTP_OK);
    }
}
