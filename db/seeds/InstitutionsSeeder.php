<?php

declare(strict_types=1);

use Phinx\Seed\AbstractSeed;

class InstitutionsSeeder extends AbstractSeed
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
            ['name' => 'MI Jaya Bersama', 'level' => 'sd'],
            ['name' => 'MTS Jaya Bersama', 'level' => 'smp'],
            ['name' => 'MA Jaya Bersama', 'level' => 'sma'],
        ];

        $this->table('institutions')->insert($data)->saveData();
    }
}
