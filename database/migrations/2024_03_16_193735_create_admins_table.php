<?php

use App\Models\User;
use App\Models\Admin;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('photo')->nullable();
            $table->text('address')->nullable();
            $table->text('phone')->nullable();
            $table->timestamps();
        });
        
        $admin =  User::create([
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'other_names' => 'Admin',
            'role' => 'admin',
            'nameSlug' => 'admin',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => bcrypt('12345678'),
        ]);

        Admin::create([
            'user_id' => $admin->id,
            'phone' => '08132634481',
            'address' => 'No. 1 Str Road, City State, Country'
        ]);
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
