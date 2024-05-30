<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->date('visit_date');
            $table->integer('ticket_count');
            $table->string('promo_code')->nullable();
            $table->decimal('total_price', 8, 2);
            $table->string('status');
            $table->timestamps();

            $table->foreign('user_id')
                  ->references('id')
                  ->on('users_customer')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
}

