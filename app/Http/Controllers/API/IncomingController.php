<?php

namespace App\Http\Controllers\API;

use App\Models\Item;
use App\Models\Incoming;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IncomingController extends Controller
{
    public function index(ResponseFormatter $responseFormatter)
    {
        $incoming = Incoming::all();

        try {
            return $responseFormatter->success($incoming, 'Successfullly Retrieve Item!', 200);
        } catch (\Throwable $th) {
            return $responseFormatter->error($th, 'Failed Retrieve Item!', 400);
        }
    }

    public function store(Request $request, ResponseFormatter $responseFormatter)
    {
        $data = $request->validate([
            'item_id' => ['required', 'string'],
            'jumlah' => ['required', 'numeric'],
            'date' => ['required', 'string'],
        ]);

        $incoming = Incoming::create($data);

        $stock = Item::where('id', $data['item_id'])->first()->stock;
        $stock += $data['jumlah'];
        Item::where('id', $data['item_id'])->update([
            'stock' => $stock,
        ]);

        try {
            return $responseFormatter->success($incoming, 'Successfullly Created!', 202);
        } catch (\Throwable $th) {
            return $responseFormatter->error($th, 'Failed Created!', 400);
        }
    }
}
