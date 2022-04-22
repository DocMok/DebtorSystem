<?php

namespace App\Http\Controllers;

use App\Http\Requests\DebtorStoreRequest;
use App\Http\Requests\DebtorUpdateRequest;
use App\Http\Traits\ApiResponsable;
use App\Models\Debtor;
use App\Models\File;
use Illuminate\Http\Request;

class DebtorController extends Controller
{
    use ApiResponsable;

    public function index()
    {
        $debtors = Debtor::paginate(20);
        return view('debtor.index', compact('debtors'));
    }

    public function show(Debtor $debtor)
    {

        $files = $debtor->files()->get();
        return view('debtor.show', compact('debtor','files'));
    }

    public function create()
    {
        return view('debtor.create');
    }

    public function store(Request $request)
    {
        //dd($request, $request->files);
        $debtor = Debtor::create([
            'name' => $request->name,
            'iin' => $request->iin,
            'address' => $request->address,
            'chsi' => $request->chsi,
            'nip' => $request->nip,
            'start_date' => $request->start_date,
            'debit_sum' => $request->debit_sum,
            'account_block_name' => $request->account_block_name,
            'arrest_to' => $request->arrest_to,
            'bin' => $request->bin,
        ]);

        if ($request->file('documents')) {
            foreach ($request->file('documents') as $document) {
                $documentPath = $document->store($debtor->id, ['disk' => 'public']);
                if ($documentPath) {
                    File::create([
                        'path' => $documentPath,
                        'debtor_id' => $debtor->id,
                    ]);
                }

            }
        }
        return redirect(route('index'));
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
