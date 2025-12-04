<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('role_id')
                ->nullable()
                ->after('id')
                ->constrained()
                ->nullOnDelete();
        });

        $now = now();
        $rolesTable = DB::table('roles');

        $adminRoleId = $rolesTable->where('slug', 'administrator')->value('id');
        if (! $adminRoleId) {
            $adminRoleId = $rolesTable->insertGetId([
                'name' => 'Administrator',
                'slug' => 'administrator',
                'description' => 'Full system access with management permissions.',
                'is_admin' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        $regularRoleId = $rolesTable->where('slug', 'regular-user')->value('id');
        if (! $regularRoleId) {
            $regularRoleId = $rolesTable->insertGetId([
                'name' => 'Regular User',
                'slug' => 'regular-user',
                'description' => 'Standard user without administrative privileges.',
                'is_admin' => false,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        DB::table('users')
            ->where('is_admin', true)
            ->update(['role_id' => $adminRoleId]);

        DB::table('users')
            ->whereNull('role_id')
            ->update(['role_id' => $regularRoleId]);

        if (Schema::hasColumn('users', 'is_admin')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('is_admin');
            });
        }
    }

    public function down(): void
    {
        if (! Schema::hasColumn('users', 'is_admin')) {
            Schema::table('users', function (Blueprint $table) {
                $table->boolean('is_admin')->default(false);
            });

            $adminRoleIds = DB::table('roles')
                ->where('is_admin', true)
                ->pluck('id')
                ->toArray();

            if (! empty($adminRoleIds)) {
                DB::table('users')
                    ->whereIn('role_id', $adminRoleIds)
                    ->update(['is_admin' => true]);
            }
        }

        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
            $table->dropColumn('role_id');
        });
    }
};
