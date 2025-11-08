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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('phone');
            $table->enum('order_type', ['pickup', 'catering', 'custom-cake', 'weekly'])->default('pickup');
            $table->date('pickup_date')->nullable();
            $table->string('pickup_time')->nullable();
            $table->json('products')->nullable(); // Store selected products as JSON array
            $table->string('dietary')->nullable();
            $table->text('order_details');
            $table->boolean('newsletter')->default(false);
            $table->boolean('sms_alerts')->default(false);
            $table->timestamps();

            // Indexes for common queries
            $table->index('email');
            $table->index('order_type');
            $table->index('pickup_date');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
