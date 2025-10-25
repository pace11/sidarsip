<?php

declare(strict_types=1);

use Phinx\Seed\AbstractSeed;

class UsersSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     */
    public function run(): void
    {
        $data = [
            ['name' => 'Super Admin Kemenag', 'email' => 'super-admin@kemenag.id', 'password' => 'eHRaZDdHV0l0bkFuelZXeXd1T0drUT09', 'type' => 'superadmin'],
            ['name' => 'Admin Kemenag', 'email' => 'admin@kemenag.id', 'password' => 'eHRaZDdHV0l0bkFuelZXeXd1T0drUT09', 'type' => 'admin'],
            ['name' => 'Admin TK', 'email' => 'admin-tk@kemenag.id', 'password' => 'd1BkZStPL2g4S1h0aitGMFpQQXFwUT09', 'type' => 'tk'],
            ['name' => 'Admin SD', 'email' => 'admin-sd@kemenag.id', 'password' => 'd1BkZStPL2g4S1h0aitGMFpQQXFwUT09', 'type' => 'sd'],
            ['name' => 'Admin SMP', 'email' => 'admin-smp@kemenag.id', 'password' => 'd1BkZStPL2g4S1h0aitGMFpQQXFwUT09', 'type' => 'smp'],
            ['name' => 'Admin SMA', 'email' => 'admin-sma@kemenag.id', 'password' => 'd1BkZStPL2g4S1h0aitGMFpQQXFwUT09', 'type' => 'sma'],
        ];

        $this->table('users')->insert($data)->saveData();
    }
}
