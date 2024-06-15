<?php

use App\Models\Application;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Application::class)->constrained()->cascadeOnDelete();
            $table->string('level');
            $table->text('message');
            $table->json('context')->nullable();
            $table->timestamps();
        });
    }
};
