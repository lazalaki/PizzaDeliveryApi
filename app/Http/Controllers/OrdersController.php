<?php

namespace App\Http\Controllers;

use App\Services\OrderService;
use Symfony\Component\HttpFoundation\Request;

class OrdersController extends Controller
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function setOrders(Request $request, $userId)
    {
        return $this->orderService->setOrder($request, $userId);
    }

    public function getLastOrder($userId)
    {
        return $this->orderService->getLastOrder($userId);
    }

    public function setOrderItem($foodId, $orderId)
    {
        return $this->orderService->setOrderItem($foodId, $orderId);
    }

    public function deleteOrderItem(Request $request)
    {
       $orderId = $request->route('order_item_id');

       return $this->orderService->deleteOrderItem($orderId);
    }

    public function getAllOrders($userId)
    {
        return $this->orderService->getOrders($userId);
    }

    public function completedOrder(Request $request)
    {
        return $this->orderService->completedOrder($request);
    }
}
