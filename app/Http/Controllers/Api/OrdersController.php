<?php

namespace App\Http\Controllers\Api;

use App\Models\Order;
use App\Models\User;
use App\Models\Loan;
use App\Util\Paginate\Paginate;
use App\Util\Filters\OrderFilter;
use App\Http\Requests\Api\CreateOrder;
use App\Http\Requests\Api\UpdateOrder;
use App\Util\Transformers\OrderTransformer;
use Illuminate\Http\Request;


class OrdersController extends ApiController
{
    /**
     * OrdersController constructor.
     *
     * @param OrderTransformer $transformer
     */
    public function __construct(OrderTransformer $transformer)
    {
        $this->transformer = $transformer;

    }

    /**
     * Get all the orders.
     *
     * @param OrderFilter $filter
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(OrderFilter $filter)
    {

        $orders = new Paginate(Order::filter($filter));

        return $this->respondWithPagination($orders);
    }


    /**
     * Create a new Order and return the Order if successful.
     *
     * @param CreateOrder $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateOrder $request)
    {

        $inputs = $request->all();
        $order = Order::create($inputs);
        $order->update(['price' => 1]); // update for auto calculate price by quantity and discount in Order model

        return $this->respondWithTransformer($order);
    }

    /**
     * Get the order given by its id.
     *
     * @param Order $order
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Order $order)
    {
        return $this->respondWithTransformer($order);
    }

    /**
     * Update the order given by its id and return the order if successful.
     *
     * @param UpdateOrder $request
     * @param User $order
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateOrder $request, Order $order)
    {
        $inputs = $request->all();

        $order->update($inputs);

        return $this->respondWithTransformer($order);
    }

    /**
     * Delete the order given by its id.
     *
     * @param DeleteOrder $request
     * @param Order $order
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Order $order)
    {
        $order->delete();

        return $this->respondSuccess();
    }


}
