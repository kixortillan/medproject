<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicalCaseDiagnosesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('medical_case_diagnoses', function (Blueprint $table) {
            $table->bigInteger('medical_case_id')->unsigned();
            $table->bigInteger('diagnosis_id')->unsigned();
            $table->primary(['medical_case_id', 'diagnosis_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('medical_case_diagnoses');
    }

}
