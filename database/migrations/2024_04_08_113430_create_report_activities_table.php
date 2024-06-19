<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Report;
use App\Models\Activity;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('report_activities', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignIdFor(Report::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Activity::class)->constrained()->cascadeOnDelete();
            $table->string('reservation_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('report_activities');
    }
};
