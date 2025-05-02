<?php

namespace App\Console\Commands;

use App\Models\Admin;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CreateAdmin extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'admin:create';

    /**
     * The console command description.
     */
    protected $description = 'Create a new admin user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $username = $this->ask('Enter admin username');
        $password = $this->secret('Enter admin password');

        // Validate inputs
        if (empty($username) || empty($password)) {
            $this->error('Username and password cannot be empty.');
            return 1; // Failure
        }

        // Check if username already exists
        $exists = DB::table('admins')->where('username', $username)->exists();
        if ($exists) {
            $this->error('Username already exists!');
            return 1; // Failure
        }

        // Insert new admin
//        DB::table('admins')->insert([
//            'username' => $username,
//            'password' => Hash::make($password),
//        ]);

        Admin::create([
            'username' => $username,
            'password' => Hash::make($password),
        ]);

        $this->info('Admin user created successfully!');

        return 0; // Success
    }
}
