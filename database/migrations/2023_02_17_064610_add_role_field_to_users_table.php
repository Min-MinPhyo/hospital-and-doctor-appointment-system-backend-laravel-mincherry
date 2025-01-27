<?php

use App\Enums\RoleType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->tinyInteger('role')->default(RoleType::USER->value);
        });
    }


    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
        $table->dropColumn('role');
        });
    }
};
