<?php

namespace App\Http\Controllers;

use App\Http\Requests\DebtorStoreRequest;
use App\Http\Requests\DebtorUpdateRequest;
use App\Models\Debtor;

class DebtorController extends Controller
{
    public function index()
    {
        $debtors = Debtor::paginate(20);
        return view('debtor.index', compact('debtors'));
    }

    public function create()
    {
        return view('debtor.create');
    }

    public function store(DebtorStoreRequest $request)
    {
        dd($request);
        Debtor::create([

        ]);
    }

    public function edit(Debtor $debtor)
    {
        return view('debtor.edit', compact('debtor'));
    }

    public function update(DebtorUpdateRequest $request)
    {
        dd($request);
    }

    public function destroy(Debtor $debtor)
    {
        $debtor->delete();
        return redirect(route('index'));
    }
}
