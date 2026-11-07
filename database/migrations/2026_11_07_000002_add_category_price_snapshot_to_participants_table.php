<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('participants', function (Blueprint $table) {
            $table->foreignId('event_category_id')
                ->nullable()
                ->after('event_id')
                ->constrained('event_categories')
                ->nullOnDelete();

            $table->string('category_name_snapshot')->nullable()->after('event_category_id');
            $table->string('price_type')->nullable()->after('category_name_snapshot');
            $table->decimal('price_amount', 12, 2)->nullable()->after('price_type');
        });
    }

    public function down(): void
    {
        Schema::table('participants', function (Blueprint $table) {
            $table->dropConstrainedForeignId('event_category_id');
            $table->dropColumn([
                'category_name_snapshot',
                'price_type',
                'price_amount',
            ]);
        });
    }
};
