<?php

namespace App\Models;

use http\Client\Curl\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Balance extends Model
{
    public function deposit(float $value) : array
    {
        $amountBefore = $this->amount ? $this->amount: 0;
        $this->amount += number_format($value, 2, '.', '');

        DB::beginTransaction();

        $historic = auth()->user()->historics()->create([
            'type' => 'I',
            'amount' => $value,
            'total_before' => $amountBefore,
            'total_after' => $this->amount,
            'date' => date('Ymd'),
        ]);

        if($historic && $this->save()){
            DB::commit();
            return [
                'success' => true,
                'message' => 'Depósito efetuado com sucesso'
            ];
        }

        DB::rollback();
        return [
            'success' => false,
            'message' => 'Falha ao efetuar o depósito'
        ];
    }

    public function withdraw(float $value) : array
    {
        $amountBefore = $this->amount ? $this->amount: 0;
        $this->amount -= number_format($value, 2, '.', '');

        DB::beginTransaction();

        $historic = auth()->user()->historics()->create([
            'type' => 'o',
            'amount' => $value,
            'total_before' => $amountBefore,
            'total_after' => $this->amount,
            'date' => date('Ymd'),
        ]);

        if($historic && $this->save()){
            DB::commit();
            return [
                'success' => true,
                'message' => 'Saque efetuado com sucesso'
            ];
        }

        DB::rollback();
        return [
            'success' => false,
            'message' => 'Falha ao efetuar o saque'
        ];
    }

    public function transfer(float $value,  $sender) : array
    {
        $amountBefore = $this->amount ? $this->amount: 0;
        $this->amount -= number_format($value, 2, '.', '');

        $balanceSender              = $sender->balance()->firstOrCreate([]);
        $amountBeforeSender         = $balanceSender->amount ? $balanceSender->amount: 0;
        $balanceSender->amount     += number_format($value, 2, '.', '');

        DB::beginTransaction();

        $historic = auth()->user()->historics()->create([
            'type' => 'T',
            'amount' => $value,
            'total_before' => $amountBefore,
            'total_after' => $this->amount,
            'date' => date('Ymd'),
            'user_id_transaction' => $sender->id,
        ]);

        $historicSender = $sender->historics()->create([
            'type' => 'I',
            'amount' => $value,
            'total_before' => $amountBeforeSender,
            'total_after' => $balanceSender->amount,
            'date' => date('Ymd'),
            'user_id_transaction' => auth()->user()->id,
        ]);

        if($historic && $this->save() && $historicSender && $balanceSender->save()){
            DB::commit();
            return [
                'success' => true,
                'message' => 'Transferencia efetuada com sucesso'
            ];
        }

        DB::rollback();
        return [
            'success' => false,
            'message' => 'Falha ao efetuar a transferencia'
        ];
    }
}
