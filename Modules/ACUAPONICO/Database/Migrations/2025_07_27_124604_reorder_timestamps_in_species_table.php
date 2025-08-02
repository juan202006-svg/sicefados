<?php
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("
            ALTER TABLE species
            MODIFY COLUMN created_at TIMESTAMP NULL AFTER description,
            MODIFY COLUMN updated_at TIMESTAMP NULL AFTER created_at,
            MODIFY COLUMN deleted_at TIMESTAMP NULL AFTER updated_at
        ");
    }

    public function down(): void
    {
        // Opcional: revertir al orden original
        DB::statement("
            ALTER TABLE species
            MODIFY COLUMN created_at TIMESTAMP NULL AFTER productive_unit_id,
            MODIFY COLUMN updated_at TIMESTAMP NULL AFTER created_at,
            MODIFY COLUMN deleted_at TIMESTAMP NULL AFTER updated_at
        ");
    }
};
