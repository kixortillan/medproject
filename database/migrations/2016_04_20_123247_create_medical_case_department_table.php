<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicalCaseDepartmentTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('medical_case_department', function (Blueprint $table) {
            $table->bigInteger('medical_case_id')->unsigned();
            $table->bigInteger('department_code')->unsigned();
            $table->primary(['medical_case_id', 'department_code']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('medical_case_department');
    }

}
