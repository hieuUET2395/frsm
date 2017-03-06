<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Criteria\Message\FindMessageInRoomCriteria;
use App\Repositories\Contracts\MessageRepositoryInterface as MessageRepository;
use Auth;
use App\Events\MessagePosted;
use DB;

class MessageController extends Controller
{
    protected $messageRepository;

    public function __construct(MessageRepository $messageRepository)
    {
        $this->messageRepository = $messageRepository;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $message = $this->messageRepository->create([
                'user_id' => Auth::id(),
                'schedule_id' => $request->room_id,
                'content' => $request->message,
            ]);
            event(new MessagePosted($message));
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['error'], 500);
        }
    }
}
