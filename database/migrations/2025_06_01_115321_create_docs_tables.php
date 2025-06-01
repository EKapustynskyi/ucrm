<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('docs_status', function (Blueprint $table) {
            $table->id('docs_status_id');
            $table->string('docs_status_name', 32)->unique();
            $table->boolean('active')->default(1);
        });

        DB::table('docs_status')->insert([
            ['docs_status_id' => 1, 'docs_status_name' => 'Новий', 'active' => 1],
            ['docs_status_id' => 2, 'docs_status_name' => 'На узгодженні', 'active' => 1],
            ['docs_status_id' => 3, 'docs_status_name' => 'Повернутий з узгодження', 'active' => 1],
            ['docs_status_id' => 4, 'docs_status_name' => 'На доопрацюванні', 'active' => 1],
            ['docs_status_id' => 5, 'docs_status_name' => 'Узгоджений', 'active' => 1],
            ['docs_status_id' => 6, 'docs_status_name' => 'На розгляді', 'active' => 1],
            ['docs_status_id' => 7, 'docs_status_name' => 'На виконанні', 'active' => 1],
            ['docs_status_id' => 8, 'docs_status_name' => 'Виконаний', 'active' => 1],
            ['docs_status_id' => 9, 'docs_status_name' => 'Закритий', 'active' => 1],
        ]);

        Schema::create('docs_type', function (Blueprint $table) {
            $table->id('docs_type_id');
            $table->string('docs_type_name', 64)->unique();
            $table->boolean('active')->default(1);
        });

        DB::table('docs_type')->insert([
            ['docs_type_id' => 1, 'docs_type_name' => 'Службові', 'active' => 1],
            ['docs_type_id' => 2, 'docs_type_name' => 'Розпорядження', 'active' => 1],
            ['docs_type_id' => 3, 'docs_type_name' => 'Накази', 'active' => 1],
            ['docs_type_id' => 4, 'docs_type_name' => 'Інформаційна розсилка', 'active' => 1],
        ]);

        Schema::create('doc_access', function (Blueprint $table) {
            $table->id('access_id');
            $table->string('access_name', 32)->unique();
        });

        DB::table('doc_access')->insert([
            ['access_id' => 1, 'access_name' => 'Приватний'],
            ['access_id' => 2, 'access_name' => 'Загальний'],
        ]);

        Schema::create('priority_id', function (Blueprint $table) {
            $table->id('priority_id');
            $table->string('priority_name', 32)->unique();
        });

        DB::table('priority_id')->insert([
            ['priority_id' => 1, 'priority_name' => 'Без контролю'],
            ['priority_id' => 2, 'priority_name' => 'Особливий'],
        ]);

        Schema::create('employee', function (Blueprint $table) {
            $table->id('employee_id');
            $table->integer('employee_name'); // якщо це має бути текст, заміни на string()
        });

        Schema::create('files', function (Blueprint $table) {
            $table->id('file_id');
            $table->string('file_path', 256);
            $table->string('file_type', 8)->default('');
            $table->integer('size')->nullable();
            $table->date('date_created')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('hash', 256)->nullable();
            $table->foreignId('employee_id')->constrained('employee');
        });

        Schema::create('docs', function (Blueprint $table) {
            $table->id('docs_id');
            $table->integer('docs_hash');
            $table->string('docs_name', 32);
            $table->foreignId('docs_type_id')->nullable()->constrained('docs_type');
            $table->foreignId('docs_status_id')->nullable()->constrained('docs_status');
            $table->foreignId('access_id')->nullable()->constrained('doc_access');
            $table->foreignId('priority_id')->nullable()->constrained('priority_id');
            $table->string('abstract', 256)->nullable();
            $table->integer('parent_docs_id')->nullable();
            $table->dateTime('deadline')->nullable();
            $table->timestamp('date_created')->useCurrent();
            $table->timestamp('date_updated')->useCurrent();
        });

        Schema::create('docs_employee', function (Blueprint $table) {
            $table->primary(['docs_id', 'employee_id']);
            $table->foreignId('docs_id')->constrained('docs');
            $table->foreignId('employee_id')->constrained('employee');
            $table->integer('position_id')->nullable();
            $table->boolean('signed')->default(0);
        });

        Schema::create('docs_files', function (Blueprint $table) {
            $table->primary(['doc_id', 'file_id']);
            $table->foreignId('doc_id')->constrained('docs');
            $table->foreignId('file_id')->constrained('files');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('docs_files');
        Schema::dropIfExists('docs_employee');
        Schema::dropIfExists('docs');
        Schema::dropIfExists('files');
        Schema::dropIfExists('employee');
        Schema::dropIfExists('priority_id');
        Schema::dropIfExists('doc_access');
        Schema::dropIfExists('docs_type');
        Schema::dropIfExists('docs_status');
    }
};
