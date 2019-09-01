<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Product;
use App\Util\Paginate\Paginate;
use App\Util\Filters\ProductFilter;
use App\Http\Requests\Api\CreateProduct;
use App\Http\Requests\Api\UpdateProduct;
use App\Util\Transformers\ProductTransformer;
use Illuminate\Http\Request;


class ProductsController extends ApiController
{
    /**
     * ProductsController constructor.
     *
     * @param ProductTransformer $transformer
     */
    public function __construct(ProductTransformer $transformer)
    {
        $this->transformer = $transformer;

    }

    /**
     * Get all the products.
     *
     * @param ProductFilter $filter
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(ProductFilter $filter)
    {

        $products = new Paginate(Product::filter($filter));

        return $this->respondWithPagination($products);
    }


    /**
     * Create a new Product and return the Product if successful.
     *
     * @param CreateProduct $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateProduct $request)
    {
        $inputs = $request->all();
        $product = Product::create($inputs);

        return $this->respondWithTransformer($product);
    }

    /**
     * Get the product given by its id.
     *
     * @param Product $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Product $product)
    {
        return $this->respondWithTransformer($product);
    }

    /**
     * Update the $product given by its id and return the $product if successful.
     *
     * @param UpdateProduct $request
     * @param Product $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateProduct $request, Product $product)
    {
        $inputs = $request->all();

        $product->update($inputs);

        return $this->respondWithTransformer($product);
    }

    /**
     * Delete the product given by its id.
     *
     * @param DeleteProduct $request
     * @param Product $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return $this->respondSuccess();
    }


}
