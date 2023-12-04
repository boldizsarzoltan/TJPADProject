<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("name");
            $table->text("description");
            $table->timestamp("start")->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp("end")->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->foreignIdFor(User::class);
            $table->unique(["name", "user_id"], 'unique_task_for_user');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
