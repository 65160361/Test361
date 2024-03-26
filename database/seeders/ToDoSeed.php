<?php

namespace Database\Seeders;

use App\Models\todo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ToDoSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        todo::create([
            'td_name' => 'ทำข้อสอบ1',
            'td_des' => 'อุกๆอ่าๆ',
            'td_status' => false
        ]);
    }
}
