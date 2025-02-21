<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->text('subject');
            $table->text('message');
            $table->string('type', 100)->index();
            $table->string('status', 100)->index();
            $table->string('created_by', 50);
            $table->integer('send_attempts')->nullable()->default(0);
            $table->dateTime('scheduled_at')->useCurrent()->nullable();
            $table->dateTime('sent_at')->nullable();
            $table->boolean('is_active')->nullable()->default(true);
            $table->boolean('is_sent')->nullable()->default(false);
            $table->boolean('has_error')->nullable()->default(false);
            $table->dateTime('failed_at')->nullable();
            $table->string('error_message')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
