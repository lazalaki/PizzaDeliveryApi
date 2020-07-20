<?php

namespace App\Services;

use App\Http\Requests\OrderItemRequest;
use App\Order;
use App\OrderItem;
use Exception;

class OrderService {

    public function createEmptyOrder($userId)
    {   
        $lastOrder = $this->getLastStartedOrder($userId);
        if($lastOrder) {
            return $lastOrder;
        }
        $order = new Order();
        $order->user_id = $userId;
        $order->state = 'started';
        $order->address = '';

        try {
            $order->save();
            return response()->json(['order' => $order], 200);
        } catch(Exception $exception) {
            return response()->json(['message' => $exception->getMessage()], 400);
        }
    }

    public function getLastStartedOrder($userId)
    {
        $order = Order::where('user_id', $userId)->where('state', 'started')->with('order_items.food')->first();

        if($order) {
            return $order;
        }
        return null;
    }

    public function getLastOrder($userId)
    {
        try {
            $order = $this->getLastStartedOrder($userId);
            return response()->json(['order' => $order], 200);
        } catch(Exception $exception) {
            return response()->json(['message' => $exception->getMessage()]);
        }
    }

    public function addOrderItem($foodId, $orderId)
    {
        $orderItem = new OrderItem();
        $orderItem->food_id = $foodId;
        $orderItem->order_id = $orderId;
        
        

        try {
            $orderItem->save();
            return response()->json([], 200);
        } catch(Exception $exception) {
            return response()->json(['message' => $exception->getMessage()], 400);
        }
    }

    public function deleteOrderItem($orderItemId)
    {
        $orderItem = OrderItem::findOrFail($orderItemId);

        try {
            $orderItem->delete();
            return response()->json([], 200);
        } catch(Exception $exception) {
            return response()->json(['message' => $exception->getMessage()], 400);
        }
    }

    public function getHistory($userId)
    {
        $orders = Order::where('user_id', $userId)->where('state', 'completed')->with('order_items.food')->latest()->get();
        
        try {
            return response()->json(['orders' => $orders]);
        } catch(Exception $exception) {
            return response()->json(['message' => $exception->getMessage()], 400);
        }
    }

    public function completedOrder($request)
    {
        $order = Order::findOrFail($request['orderId']);

        try {
            $order->update([
                'state' => 'completed',
                'address' => $request['address']
            ]);
            return response()->json([], 200);
        } catch(Exception $exception) {
            return response()->json(['message' => $exception->getMessage()], 400);
        }
    }

}