<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */

    private $tableName = 'chats';
    public function up(): void
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->integer('id',true,true)->primary();
            $table->string('name',255);
            $table->text('description')->nullable();
            // потому что 2038 год скоро
            $table->bigInteger('created_at',false,true);
            $table->index('created_at');
            $table->bigInteger('updated_at',false,true)->nullable();
            $table->index('updated_at');
            $table->string('last_message_text',100)->nullable();
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
