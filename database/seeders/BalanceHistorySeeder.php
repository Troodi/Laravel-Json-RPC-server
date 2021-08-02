<?php

namespace Database\Seeders;

use App\Models\BalanceHistory;
use App\Models\User;
use Illuminate\Database\Seeder;

class BalanceHistorySeeder extends Seeder
{
    /**
     * Заполняет таблицу истории операций для всех существубщих пользователей, несколько строк на каждого пользователя
     * генерируется рандомный баланс и количество записей
     */
    public function run()
    {
        foreach(User::all() as $user){
            for($i=0; $i<mt_rand(5, 10); $i++) {
                BalanceHistory::create([
                    'user_id' => $user->id,
                    'value' => mt_rand(100, 100000) / 100,
                    'balance' => mt_rand(100, 100000) / 100,
                ]);
            }
        }
    }
}
