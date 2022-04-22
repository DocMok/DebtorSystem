<?php

namespace App\Http\Controllers;

use App\Http\Requests\DebtorStoreRequest;
use App\Http\Requests\DebtorUpdateRequest;
use App\Http\Traits\ApiResponsable;
use App\Models\Debtor;

class DebtorController extends Controller
{
    use ApiResponsable;

    public function index()
    {
        $debtors = Debtor::paginate(20);
        return view('index', compact('debtors'));
    }

    public function store(DebtorStoreRequest $request)
    {
        dd($request);
        Debtor::create([

        ]);
    }

    public function edit(Debtor $debtor)
    {
        return $this->successResponse($debtor);
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
