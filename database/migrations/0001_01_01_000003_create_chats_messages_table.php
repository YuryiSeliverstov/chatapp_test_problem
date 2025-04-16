<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */

    private $tableName = 'chats_messages';
    public function up(): void
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->integer('id',true,true)->primary();
            $table->integer('chats_id',false,true);
            $table->foreign('chats_id')->references('id')->on('chats')->onDelete('cascade');
            $table->index('chats_id');
            $table->text('message');
            $table->bigInteger('created_at',false,true);
            $table->index('created_at');
            $table->bigInteger('updated_at',false,true);
            $table->index('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists($this->tableName);
    }
};
