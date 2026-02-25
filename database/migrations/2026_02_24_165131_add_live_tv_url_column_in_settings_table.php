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
        Schema::table('settings', function (Blueprint $table) {
            $table->string('live_tv_url')->nullable()->after('youtube');
            $table->text('live_tv_description')->nullable()->after('live_tv_url');
            $table->string('bhakti_live_tv_url')->nullable()->after('live_tv_description');
            $table->string('bhakti_live_tv_description')->nullable()->after('bhakti_live_tv_url');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn('live_tv_url');
            $table->dropColumn('live_tv_description');
            $table->dropColumn('bhakti_live_tv_url');
            $table->dropColumn('bhakti_live_tv_description');
        });
    }
};
