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

            $table->string('account_name_1');
            $table->string('account_number_1');
            $table->string('account_routing_no_1');
            $table->string('bank_name_1');
            $table->string('branch_name_1');

            $table->string('account_name_2');
            $table->string('account_number_2');
            $table->string('account_routing_no_2');
            $table->string('bank_name_2');
            $table->string('branch_name_2');

            $table->text('bill_creator');
            $table->text('biller_designation');
            $table->tinyInteger('delete_at')->default(0);
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
