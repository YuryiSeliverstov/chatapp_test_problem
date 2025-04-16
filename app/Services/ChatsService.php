<?php

namespace App\Services;
use App\Models\{Chats, ChatsMessages};
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

/**
 * Chats Messages Service
 */
class ChatsService
{
    /**
     * @param Collection $chats
     * @return array
     */
    public static function formatChatsResponse(Collection $chats): array
    {
        $r = [];
        /** @var Chats $chat */
        foreach ($chats as $chat) {
            $r[] = [
                'id' => $chat->id,
                'name' => $chat->name,
                'last_message' => $chat->last_message_text,
                'last_message_date' => date('Y-m-d H:i:s', $chat->updated_at)
            ];
        }

        return $r;
    }

    /**
     * @return void
     * @throws \Exception
     */
    public static function generateChats()
    {
        $insertData = [];
        for($i=0; $i < 100; $i++) {
            $insertData[] = [
                'name' => ChatsService::generateRandomString(),
                'description' => ChatsService::generateRandomString(512),
                'created_at' => time()
            ];
        }
        DB::table(Chats::getTableName())->insert($insertData);
    }

    /**
     * @param Chats $chat
     * @return void
     */
    public static function generateMessagesForChat(Chats $chat)
    {
        $max = rand(10,100);
        $insertData = [];
        $maxTimestamp = 0;
        $lastMessageText = 0;
        for ($i = 0; $i < $max; $i++) {
            $timestamp = rand(531176400,2677096800);
            $messageText = self::generateRandomString(512);
            if ($timestamp > $maxTimestamp) {
                $maxTimestamp = $timestamp;
                $lastMessageText = mb_substr($messageText,0,100);
            }

            $insertData[] = [
                'chats_id' => $chat->id,
                'message' => $messageText,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ];
        }

        $chat->update(['updated_at' => $maxTimestamp, 'last_message_text' => $lastMessageText]);

        DB::table(ChatsMessages::getTableName())->insert($insertData);
    }

    /**
     * @param int $maxLength
     * @return string
     * @throws \Exception
     */
    public static function generateRandomString(int $maxLength = 255): string {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';

        for ($i = 0; $i < $maxLength; $i++)
            $randomString .= $characters[random_int(0, $charactersLength - 1)];

        return $randomString;
    }
}
