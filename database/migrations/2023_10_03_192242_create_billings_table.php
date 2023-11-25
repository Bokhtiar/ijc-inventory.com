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
        Schema::create('billings', function (Blueprint $table) {
            $table->id('billing_id');
            $table->string('ref');
            $table->string('designation');
            $table->string('company_name');
            $table->longText('company_location');
            $table->string('att');
            $table->string('date');
            $table->string('cell_no');
            $table->string('telephone');
            $table->string('email');
            $table->text('website')->nullable();

            $table->longText('less_advance')->nullable();
            $table->longText('foreign_company')->nullable();
            $table->text('bill_creator');
            $table->text('biller_designation');
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('billings');
    }
};
