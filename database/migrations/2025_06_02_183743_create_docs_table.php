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
        Schema::create('docs', function (Blueprint $table) {
            $table->id('docs_id');
            $table->integer('docs_hash');
            $table->string('docs_name', 32);
            $table->foreignId('docs_type_id')->nullable()->constrained('docs_type');
            $table->foreignId('docs_status_id')->nullable()->constrained('docs_status');
            $table->foreignId('access_id')->nullable()->constrained('doc_access');
            $table->foreignId('priority_id')->nullable()->constrained('priority_id');
            $table->string('abstract', 256)->nullable();
            $table->string('docs_path', 256)->nullable();
            $table->integer('parent_docs_id')->nullable();
            $table->dateTime('deadline')->nullable();
            $table->timestamp('date_created')->useCurrent();
            $table->timestamp('date_updated')->useCurrent();
        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('docs');
    }
};
