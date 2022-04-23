<?php

namespace App\Http\Controllers;

use App\Http\Requests\DebtorStoreRequest;
use App\Http\Requests\DebtorUpdateRequest;
use App\Http\Requests\ExportDebtorsRequest;
use App\Http\Traits\ApiResponsable;
use App\Models\Debtor;
use App\Models\File;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

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
        return view('debtor.show', compact('debtor', 'files'));
    }

    public function edit(Debtor $debtor)
    {

        $files = $debtor->files()->get();
        return view('debtor.edit', compact('debtor', 'files'));
    }


    public function create()
    {
        return view('debtor.create');
    }

    public function store(Request $request)
    {
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


    public function update(Request $request)
    {
        $debtor = Debtor::findOrFail($request->debtor_id);

        $debtor->update([
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
        return redirect(route('debtor.index'));
    }

    public function destroy(Debtor $debtor)
    {
        $debtor->delete();
        return redirect(route('index'));
    }

    public function search(Request $request)
    {

        $debtors = Debtor::where('name', 'like', "%$request->search%")->
        orWhere('iin', 'like', "%$request->search%")->
        orWhere('bin', 'like', "%$request->search%")->
        get();

        return view('debtor.index', compact('debtors'));
    }

    public function filter(Request $request)
    {
        $debtors = Debtor::whereBetween('start_date', [Carbon::parse($request->start_date)->startOfDay(),
            Carbon::parse($request->end_date)->endOfDay()])->get();
        dd($debtors);
    }

    public function export(ExportDebtorsRequest $request)
    {
        $debtor = Debtor::all();
        $headers = [
            'Menu_id', 'Shop_id', 'Partner_id','Partner type', 'Shop name', 'Partner name', 'Views October 21', 'Views November 21',
            'Views December 21', 'Views January 22', 'Views February 22', 'Views March 22', 'Views April 22'];

        $spreadsheet = new Spreadsheet();
        $data[] = $headers;
        foreach ($menus as $menu) {
            if (!$menu->shop_id) {
                continue;
            }
            if ($menu->shop->partner_id) {
                $partnerId = $menu->shop->partner_id;
                $partnerType = 'partner';
            } elseif ($menu->shop->master_id) {
                $partnerId = $menu->shop->master_id;
                $partnerType = 'master';
            } else {
                $partnerId = $menu->shop->slave_id;
                $partnerType = 'slave';
            }
            $statistics = [];
            foreach ($menu->visit_statistics as $statistic) {
                $statistics[] = $statistic;
            }
            $data[] = array_merge([$menu->id,
                $menu->shop_id,
                $partnerId,
                $partnerType,
                $menu->shop->name,
                $menu->shop->$partnerType->name,
            ], $statistics);
        }

        $this->table($headers, $data);

        $spreadsheet->getActiveSheet()->setTitle('Statistics')->fromArray($data);
        $resource = tmpfile();

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, "Xlsx");
        $writer->save($resource);
        return Storage::disk('public')->put("stat/stat-test.xlsx", $resource);
    }
}
