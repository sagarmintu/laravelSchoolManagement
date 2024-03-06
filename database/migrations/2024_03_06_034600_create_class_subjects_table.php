<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_subjects', function (Blueprint $table) {
            $table->id();
            $table->integer('class_id')->nullable();
            $table->integer('subject_id')->nullable();
            $table->integer('created_by')->nullable();
            $table->tinyInteger('is_delete')->default('0')->comment('0=not, 1=yes');
            $table->tinyInteger('status')->default('0')->comment('0=active, 1=inactive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('class_subjects');
    }
};
