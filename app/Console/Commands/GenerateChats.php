<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Chats;
use App\Services\ChatsService;

class GenerateChats extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-chats';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate chats and messages';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        echo 'Starting Generating Process...'.PHP_EOL;
        $this->generateChats();
        echo 'Chats Generating Success!'.PHP_EOL;
        echo 'Starting Generating Messages for Chats...'.PHP_EOL;
        $this->generateMessages();
        echo 'Messages for Chats Generating Success!'.PHP_EOL;
    }

    /**
     * @return void
     */
    private function generateChats()
    {
        ChatsService::generateChats();
    }

    /**
     * @return void
     */
    private function generateMessages()
    {
        $chats = Chats::all();
        foreach ($chats as $chat)
            ChatsService::generateMessagesForChat($chat);
    }
}
