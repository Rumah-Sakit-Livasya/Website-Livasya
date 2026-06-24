<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Role;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Migrasi kolom users.role ke sistem Spatie Permission.
     * Mapping:
     *   admin     -> super-admin
     *   user      -> user
     *   pelamar   -> pelamar
     *   hrd       -> user
     */
    public function up(): void
    {
        // Pastikan semua role Spatie sudah ada
        $roles = ['super-admin', 'user', 'pelamar'];
        foreach ($roles as $roleName) {
            Role::firstOrCreate(['name' => $roleName, 'guard_name' => 'web']);
        }

        // Mapping dari kolom role lama ke Spatie role
        $mapping = [
            'admin'   => 'super-admin',
            'user'    => 'user',
            'pelamar' => 'pelamar',
            'hrd'     => 'user',
        ];

        $users = DB::table('users')->whereNotNull('role')->get();

        foreach ($users as $user) {
            $oldRole = $user->role ?? null;
            if (!$oldRole || !isset($mapping[$oldRole])) {
                continue;
            }

            $spatieRoleName = $mapping[$oldRole];
            $spatieRole = Role::where('name', $spatieRoleName)->where('guard_name', 'web')->first();
            if (!$spatieRole) {
                continue;
            }

            // Cek apakah user sudah punya role ini di Spatie
            $alreadyHasRole = DB::table('model_has_roles')
                ->where('role_id', $spatieRole->id)
                ->where('model_id', $user->id)
                ->where('model_type', 'App\\Models\\User')
                ->exists();

            if (!$alreadyHasRole) {
                DB::table('model_has_roles')->insert([
                    'role_id'    => $spatieRole->id,
                    'model_id'   => $user->id,
                    'model_type' => 'App\\Models\\User',
                ]);
            }
        }

        // Hapus kolom role dari tabel users
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Tambahkan kembali kolom role
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->nullable()->after('password');
        });

        // Restore data dari Spatie ke kolom role
        $reverseMapping = [
            'super-admin' => 'admin',
            'user'        => 'user',
            'pelamar'     => 'pelamar',
        ];

        $assignments = DB::table('model_has_roles')
            ->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
            ->where('model_type', 'App\\Models\\User')
            ->select('model_has_roles.model_id', 'roles.name as role_name')
            ->get();

        foreach ($assignments as $assignment) {
            $roleName = $reverseMapping[$assignment->role_name] ?? null;
            if ($roleName) {
                DB::table('users')
                    ->where('id', $assignment->model_id)
                    ->update(['role' => $roleName]);
            }
        }
    }
};
