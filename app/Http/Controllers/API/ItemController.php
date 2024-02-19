<?php

namespace App\Http\Controllers\API;

use App\Models\Item;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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

        $item = Item::create($data);

        try {
            return $responseFormatter->success($item, 'Successfully Created!', 201);
        } catch (\Throwable $th) {
            return $responseFormatter->error($th, 'Failed Created!', 400);
        }
    }

    public function update(Item $idItem, Request $request, ResponseFormatter $responseFormatter)
    {
        $data = $request->validate([
            'name' => ['required', 'string'],
            'stock' => ['required', 'string'],
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
