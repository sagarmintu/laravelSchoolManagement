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
        Schema::create('assign_class_teacher', function (Blueprint $table) {
            $table->id();
            $table->string('class_id')->nullable();
            $table->string('teacher_id')->nullable();
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
        Schema::dropIfExists('assign_class_teacher');
    }
};
