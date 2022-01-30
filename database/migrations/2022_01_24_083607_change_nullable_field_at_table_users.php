<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use phpDocumentor\Reflection\Types\Nullable;

class ChangeNullableFieldAtTableUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->longText('address')->nullable()->change();
            $table->integer('districts_id')->nullable()->change();
            $table->integer('regencies_id')->nullable()->change();
            $table->integer('zip_code')->nullable()->change();
            $table->integer('provinces_id')->nullable()->change();
            $table->string('phone_number')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->longText('address')->nullable(false)->change();
            $table->integer('districts_id')->nullable(false)->change();
            $table->integer('regencies_id')->nullable(false)->change();
            $table->integer('zip_code')->nullable(false)->change();
            $table->integer('provinces_id')->nullable(false)->change();
            $table->string('phone_number')->nullable(false)->change();
        });
    }
}
