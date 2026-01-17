<?php

        use App\Core\Database\Schema\Schema;
        use App\Core\Database\Schema\Blueprint;
        use App\Infrastructure\Migrations\Migration;
        
        class Migration_2026_01_17_202354_posts extends Migration
        {
            public function up(): void
            {
                Schema::create('posts', function (Blueprint $table) {
                    $table->id();
                    $table->string('name');
                    $table->timestamps();
                });
            }

            public function down(): void
            {
                // SQL DROP logic
            }
        }