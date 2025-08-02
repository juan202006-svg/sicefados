<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE crops MODIFY COLUMN created_at TIMESTAMP NULL AFTER aquaponic_system_id");
        DB::statement("ALTER TABLE crops MODIFY COLUMN updated_at TIMESTAMP NULL AFTER created_at");
        DB::statement("ALTER TABLE crops MODIFY COLUMN deleted_at TIMESTAMP NULL AFTER updated_at");
    }

    public function down(): void
    {
        // Puedes revertir si lo deseas
        DB::statement("ALTER TABLE crops MODIFY COLUMN created_at TIMESTAMP NULL AFTER finish_date");
        DB::statement("ALTER TABLE crops MODIFY COLUMN updated_at TIMESTAMP NULL AFTER created_at");
        DB::statement("ALTER TABLE crops MODIFY COLUMN deleted_at TIMESTAMP NULL AFTER updated_at");
    }
};
