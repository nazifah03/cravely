<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('barista')) {
            Schema::create('barista', function (Blueprint $table) {
                $table->id('id_barista');
                $table->string('nama');
                $table->string('posisi')->unique();
                $table->string('shift')->nullable();
                $table->string('password');
                $table->rememberToken();
                $table->timestamps();
            });
        } elseif (Schema::hasColumn('barista', 'id_barista')) {
            $database = DB::connection()->getDatabaseName();
            $baristaColumn = DB::select(
                'SELECT COLUMN_TYPE FROM information_schema.columns WHERE table_schema = ? AND table_name = ? AND column_name = ?',
                [$database, 'barista', 'id_barista']
            );

            if (!empty($baristaColumn) && stripos($baristaColumn[0]->COLUMN_TYPE, 'unsigned') === false) {
                DB::statement('ALTER TABLE `barista` MODIFY `id_barista` bigint unsigned NOT NULL AUTO_INCREMENT');
            }
        }

        if (!Schema::hasTable('pelanggan')) {
            Schema::create('pelanggan', function (Blueprint $table) {
                $table->id('id_pelanggan');
                $table->string('nama');
                $table->string('email')->nullable();
                $table->string('telepon')->nullable();
                $table->text('alamat')->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('kategori')) {
            Schema::create('kategori', function (Blueprint $table) {
                $table->id('id_kategori');
                $table->string('nama_kategori', 100);
                $table->timestamps();
            });
        }
        
        if (!Schema::hasTable('menu')) {
            Schema::create('menu', function (Blueprint $table) {
                $table->id('id_menu');
                $table->string('nama_kopi');
                $table->decimal('harga', 12, 2)->default(0);
                $table->enum('size', ['Small', 'Medium', 'Large']);
                $table->unsignedBigInteger('id_kategori');
                $table->timestamps();

                $table->foreign('id_kategori')
                    ->references('id_kategori')
                    ->on('kategori')
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();
            });
        }

        if (!Schema::hasTable('pesanan')) {
            Schema::create('pesanan', function (Blueprint $table) {
                $table->id('id_pesanan');
                $table->unsignedBigInteger('id_pelanggan');
                $table->unsignedBigInteger('id_barista');
                $table->dateTime('tanggal_pesan');
                $table->decimal('total', 14, 2)->default(0);
                $table->string('status')->default('pending');
                $table->timestamps();

                $table->foreign('id_pelanggan')->references('id_pelanggan')->on('pelanggan')->cascadeOnDelete();
                $table->foreign('id_barista')->references('id_barista')->on('barista')->cascadeOnDelete();
            });
        } elseif (Schema::hasColumn('pesanan', 'id_barista')) {
            $database = DB::connection()->getDatabaseName();
            $baristaColumn = DB::select(
                'SELECT COLUMN_TYPE FROM information_schema.columns WHERE table_schema = ? AND table_name = ? AND column_name = ?',
                [$database, 'barista', 'id_barista']
            );
            $pesananColumn = DB::select(
                'SELECT COLUMN_TYPE FROM information_schema.columns WHERE table_schema = ? AND table_name = ? AND column_name = ?',
                [$database, 'pesanan', 'id_barista']
            );

            if (!empty($baristaColumn) && !empty($pesananColumn)) {
                $baristaType = $baristaColumn[0]->COLUMN_TYPE;
                $pesananType = $pesananColumn[0]->COLUMN_TYPE;

                if ($baristaType !== $pesananType) {
                    DB::statement(sprintf('ALTER TABLE `pesanan` MODIFY `id_barista` %s NOT NULL', $baristaType));
                }
            }

            $constraints = DB::select(
                'SELECT CONSTRAINT_NAME FROM information_schema.table_constraints WHERE table_schema = ? AND table_name = ? AND constraint_type = ?',
                [$database, 'pesanan', 'FOREIGN KEY']
            );

            $hasFk = false;
            foreach ($constraints as $constraint) {
                if ($constraint->CONSTRAINT_NAME === 'pesanan_id_barista_foreign') {
                    $hasFk = true;
                    break;
                }
            }

            if (!$hasFk) {
                DB::statement('ALTER TABLE `pesanan` ADD CONSTRAINT `pesanan_id_barista_foreign` FOREIGN KEY (`id_barista`) REFERENCES `barista` (`id_barista`) ON DELETE CASCADE');
            }
        }

        if (!Schema::hasTable('detail_pesanan')) {
            Schema::create('detail_pesanan', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('id_pesanan');
                $table->unsignedBigInteger('id_menu');
                $table->integer('jumlah')->default(1);
                $table->decimal('harga', 12, 2)->default(0);
                $table->timestamps();

                $table->foreign('id_pesanan')->references('id_pesanan')->on('pesanan')->cascadeOnDelete();
                $table->foreign('id_menu')->references('id_menu')->on('menu')->cascadeOnDelete();
            });
        }

        if (!Schema::hasTable('reservasi')) {
            Schema::create('reservasi', function (Blueprint $table) {
                $table->id('id_reservasi');
                $table->unsignedBigInteger('id_pelanggan')->nullable();
                $table->dateTime('waktu_mulai');
                $table->dateTime('waktu_selesai')->nullable();
                $table->string('status')->default('booked');
                $table->timestamps();

                $table->foreign('id_pelanggan')->references('id_pelanggan')->on('pelanggan')->nullOnDelete();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservasi');
        Schema::dropIfExists('detail_pesanan');
        Schema::dropIfExists('pesanan');
        Schema::dropIfExists('menu');
        Schema::dropIfExists('pelanggan');
        Schema::dropIfExists('barista');
    }
};
