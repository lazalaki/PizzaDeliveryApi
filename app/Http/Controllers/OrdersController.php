<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderItemRequest;
use App\Services\OrderService;
use Symfony\Component\HttpFoundation\Request;

class OrdersController extends Controller
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function createEmptyOrder($userId)
    {
        return $this->orderService->createEmptyOrder($userId);
    }

    public function getLastOrder($userId)
    {
        return $this->orderService->getLastOrder($userId);
    }

    public function createOrderItem(OrderItemRequest $request, $userId, $orderId)
    {
        return $this->orderService->addOrderItem($request['foodId'], $orderId);
    }

    public function deleteOrderItem(Request $request)
    {
       $orderId = $request->route('order_item_id');

       return $this->orderService->deleteOrderItem($orderId);
    }

    public function getHistory($userId)
    {
        return $this->orderService->getHistory($userId);
    }

    public function completedOrder(Request $request)
    {
        return $this->orderService->completedOrder($request);
    }
}
