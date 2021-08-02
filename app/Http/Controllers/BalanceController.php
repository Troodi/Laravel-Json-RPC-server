<?php
namespace App\Http\Controllers;
use App\Models\BalanceHistory;

class BalanceController extends Controller
{
    /*
     * Получение баланса пользователя
     */
    public function userBalance(array $params)
    {
        //TODO можно добавить проверку на существование пользователя, по умолчанию вернёт null если нет пользователя
        $data = BalanceHistory::with('user')->where('user_id', $params['user_id'])->latest()->first()?->balance;
        return $data;
    }

    public function history(array $params)
    {
        //TODO можно добавить проверки, но в случае ошибки вернет null в текущий момент
        $data = BalanceHistory::with('user')->limit($params['limit'])->latest()->get();
        return $data;
    }
}
