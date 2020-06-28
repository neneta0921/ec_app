<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MineTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('mines')->truncate(); //2回目実行の際にシーダー情報をクリア
        DB::table('mines')->insert([
            'name' => 'フィルムカメラ',
            'age' => 10,
        ]);
        DB::table('mines')->insert([
            'name' => 'イヤホン',
            'age' => 20,
        ]);
    }
}
