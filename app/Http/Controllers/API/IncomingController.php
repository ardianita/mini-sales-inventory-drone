<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
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
}
