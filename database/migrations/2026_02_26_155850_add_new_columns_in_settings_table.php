<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->text('code_in_head')->nullable();
            $table->text('code_after_body')->nullable();
            $table->text('code_before_body_close')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn('code_in_head');
            $table->dropColumn('code_after_body');
            $table->dropColumn('code_before_body_close');
        });
    }
};
