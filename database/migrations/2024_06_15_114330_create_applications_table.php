<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->string('label');
            $table->string('secret_key');
            $table->dateTime('last_logs_sent_at')->nullable();
            $table->string('site_url')->nullable();
            $table->timestamps();
        });
    }
};
