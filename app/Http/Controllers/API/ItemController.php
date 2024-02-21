<?php

namespace App\Http\Controllers\API;

use App\Models\Item;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ItemResource;
use App\Models\Incoming;
use Carbon\Carbon;

class ItemController extends Controller
{
    public function index(ResponseFormatter $responseFormatter)
    {
        $item = Item::all();

        try {
            return $responseFormatter->success($item, 'Successfully Retrive Item', 200);
        } catch (\Throwable $th) {
            return $responseFormatter->error($th, 'Failed Retrive Item', 400);
        }
    }

    public function store(Request $request, ResponseFormatter $responseFormatter)
    {
        $data = $request->validate([
            'name' => ['required', 'string'],
            'stock' => ['required', 'string'],
        ]);
        $item = Item::where('name', $request->name)->first();
        $name = $item->name;
        // dd($item->stock);
        if ($data['name'] != $name) {
            Item::create($data);
            $items = Incoming::create([
                'item_id' => $request->id,
                'jumlah' => $request->stock,
            ]);
        } else {
            $stock = $item->stock;
            $stock += $data['stock'];
            Item::where('id', $item->id)->update([
                'stock' => $stock,
                'updated_at' => Carbon::now(),
            ]);
            $items = Incoming::create([
                'item_id' => $item->id,
                'jumlah' => $request->stock,
            ]);
        }

        try {
            return $responseFormatter->success($items, 'Successfully Created!', 201);
        } catch (\Throwable $th) {
            return $responseFormatter->error($th, 'Failed Created!', 400);
        }
    }

    public function show(Item $idItem, ResponseFormatter $responseFormatter)
    {
        $item = new ItemResource($idItem);

        try {
            return $responseFormatter->success($item, 'Successfully Updated!', 200);
        } catch (\Throwable $th) {
            return $responseFormatter->error($th, 'Failed Updated!', 400);
        }
    }

    public function update(Item $idItem, Request $request, ResponseFormatter $responseFormatter)
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string'],
        ]);

        $item = $idItem->update($data);

        try {
            return $responseFormatter->success($item, 'Successfully Updated!', 200);
        } catch (\Throwable $th) {
            return $responseFormatter->error($th, 'Failed Updated!', 400);
        }
    }

    public function destroy(Item $idItem)
    {
        $idItem->delete();

        return response()->json([
            'meta' => [
                'code' => 202,
                'status' => 'success',
                'message' => $idItem->id_item . ' has been deleted'
            ],
        ], 202);
    }
}
