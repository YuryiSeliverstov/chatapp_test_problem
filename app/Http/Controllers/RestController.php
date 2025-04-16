<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\{Request, JsonResponse};
use App\Models\Chats;
use App\Services\ChatsService;

class RestController extends Controller
{
    public function index(Request $request):JsonResponse
    {
        $offset = $request->get('offset',0);
        $limit = $request->get('limit',20);
        $chats = DB::table(Chats::getTableName())->offset($offset)->limit($limit)->orderBy('updated_at','DESC')->get();
        return response()->json(ChatsService::formatChatsResponse($chats));
    }
}
