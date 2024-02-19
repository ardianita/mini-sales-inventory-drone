<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Shipping;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ShippingItemController extends Controller
{
    public function store(Request $request, ResponseFormatter $responseFormatter)
    {

        foreach ($request->list_items as $key => $value) {
            $item = [
                'item_id' => $value['item_id'],
                'qty' => $value['qty'],
                'order_date' => Carbon::now(),
            ];

            $items = Shipping::create($item);
        }
        try {
            return $responseFormatter->success($items, 'Successfullly Created!', 202);
        } catch (\Throwable $th) {
            return $responseFormatter->error($th, 'Failed Created!', 400);
        }
    }
}
