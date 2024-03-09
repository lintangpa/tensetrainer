<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRequirementsToAchievementsTable extends Migration
{
    public function up()
    {
        Schema::table('achievements', function (Blueprint $table) {
            $table->json('syarat')->nullable()->after('deskripsi');
        });
    }

    public function down()
    {
        Schema::table('achievements', function (Blueprint $table) {
            $table->dropColumn('syarat');
        });
    }
}
