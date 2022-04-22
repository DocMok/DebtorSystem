<?php

namespace App\Http\Controllers;

use App\Http\Requests\DebtorStoreRequest;
use App\Http\Requests\DebtorUpdateRequest;
use App\Http\Traits\ApiResponsable;
use App\Models\Debtor;
use Illuminate\Support\Facades\Request;

class DebtorController extends Controller
{
    use ApiResponsable;

    public function index()
    {
        $debtors = Debtor::paginate(20);
        return view('dashboard', compact('debtors'));
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

    public function search(Request $request)
    {
        $debtors = Debtor::where('name', 'like', $request)->
        orWhere('iin', 'like', $request)->
        orWhere('bin', 'like', $request)->
        get();

        return $this->successResponse($debtors);
    }
}
