<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('checkouts', function (Blueprint $table) {
            $table->enum('status', ['pending', 'processing', 'shipped', 'delivered', 'cancelled'])->default('pending');
            $table->text('shipping_address')->nullable()->after('status');
            $table->string('notes')->nullable()->after('shipping_address');
        });
    }
    public function down(): void {
        Schema::table('checkouts', function (Blueprint $table) {
            $table->dropColumn(['status', 'shipping_address', 'notes']);
        });
    }
};
