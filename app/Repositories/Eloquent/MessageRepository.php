<?php
namespace App\Repositories\Eloquent;

use App\Models\Message;
use App\Repositories\Contracts\MessageRepositoryInterface;

class MessageRepository extends Repository implements MessageRepositoryInterface
{
    /**
     * @return mixed
     */
    public function model()
    {
        return Message::class;
    }
}
