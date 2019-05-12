<?php

namespace App\Http\Controllers\Admin;

use App\Models\Balance;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;

class BalanceController extends Controller
{
    public function index()
    {
        $balance = auth()->user()->balance;
        $amount = $balance ? $balance->amount : 0;

        return view('admin.balance.index', compact('amount'));
    }

    public function deposit()
    {
        return view('admin.balance.deposit');
    }

    public function depositStore(Requests\MoneyValidationFormRequest $request)
    {
        $balance = auth()->user()->balance()->firstOrCreate([]);
        $response = $balance->deposit($request->value);

        if($response['success'])
            return redirect()->route('admin.balance')->with('success', $response['message']);

        return redirect()->back()->with('error', $response['message']);
    }


    public function withdraw()
    {
        return view('admin.balance.withdraw');
    }

    public function withdrawStore(Requests\MoneyValidationFormRequest $request)
    {
        $balance = auth()->user()->balance()->firstOrCreate([]);
        $response = $balance->withdraw($request->value);

        if($response['success'])
            return redirect()->route('admin.balance')->with('success', $response['message']);

        return redirect()->back()->with('error', $response['message']);
    }

    public function transfer()
    {
        return view('admin.balance.transfer');
    }

    public function confirmTransfer(Requests\TransferValidationFormRequest $request)
    {
        $sender = auth()->user()->getSender($request->sender);
        if(!$sender)
            return redirect()->back()->with('error', 'Usuario não encontrado');

        return view('admin.balance.transfer-confirm', compact('sender'));
    }

    public function transferStore(Request $request, User $user)
    {
        $sender = $user->find($request->sender_id);
        if(!$sender)
            return redirect()->route('balance.transfer')->with('error', 'Usuario não encontrado');

        $balance = auth()->user()->balance()->firstOrCreate([]);
        $response = $balance->transfer($request->value, $sender);

        if($response['success'])
            return redirect()->route('admin.balance')->with('success', $response['message']);

        return redirect()->route('balance.transfer')->with('error', $response['message']);
    }

    public function historic()
    {
        $historics = auth()->user()->historics()->with(['userSender'])->get();

        return view('admin.balance.historics', compact('historics'));
    }
}
