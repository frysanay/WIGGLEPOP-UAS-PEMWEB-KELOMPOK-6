<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('custom_orders', function (Blueprint $table) {
            $table->decimal('final_price', 12, 2)->nullable()->after('budget');
            $table->string('payment_proof')->nullable()->after('final_price');
        });

        // Expand the status enum to include awaiting_payment
        if (DB::getDriverName() === 'mysql') {
            DB::statement("ALTER TABLE custom_orders MODIFY COLUMN status ENUM('pending','awaiting_payment','process','done','cancelled') NOT NULL DEFAULT 'pending'");
        }
    }

    public function down(): void
    {
        if (DB::getDriverName() === 'mysql') {
            DB::statement("ALTER TABLE custom_orders MODIFY COLUMN status ENUM('pending','process','done','cancelled') NOT NULL DEFAULT 'pending'");
        }

        Schema::table('custom_orders', function (Blueprint $table) {
            $table->dropColumn(['final_price', 'payment_proof']);
        });
    }
};
