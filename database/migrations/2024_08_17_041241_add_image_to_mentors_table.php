<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImageToMentorsTable extends Migration
{
    public function up()
    {
        Schema::table('mentors', function (Blueprint $table) {
            $table->string('image')->nullable()->after('bio');
        });
    }

    public function down()
    {
        Schema::table('mentors', function (Blueprint $table) {
           // $table->dropColumn('image');
        });
    }
}