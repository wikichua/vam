<?php

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Str;

class CreateUsersColumns extends Migration
{
    public function up()
    {
        // create columns
        Schema::table('users', function (Blueprint $table) {
            $table->string('type')->default('user');
            $table->string('timezone')->default(config('app.timezone'))->index();
        });

        // create default admin user
        $user = app(config('auth.providers.users.model'))->create([
            'name' => 'Admin',
            'email' => 'admin@email.com',
            'password' => Hash::make('admin123'),
        ]);

        // give default admin user default admin role
        $user->roles()->attach(app(config('vam.models.role'))->where('admin', true)->first()->id);

        // create permissions
        app(config('vam.models.permission'))->createGroup('Users', ['Create Users', 'Read Users', 'Update Users', 'Delete Users', 'Update User Password']);
        
        Schema::dropIfExists('password_resets');
        Schema::create('password_resets', function (Blueprint $table) {
            $table->string('email')->index();
            $table->string('token')->index();
            $table->timestamp('created_at');
        });
    }

    public function down()
    {
        // drop columns
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('admin');
            $table->dropColumn('timezone');
        });

        // delete permissions
        app(config('vam.models.permission'))->where('group', 'Users')->delete();

        Schema::drop('password_resets');
    }
}