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
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\IOFactory;
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
        return view('debtor.index', compact('debtors'));
    }

    public function exportByRange(ExportDebtorsRequest $request)
    {
        $debtors = Debtor::query()
            ->whereBetween('created_at',
                [Carbon::parse($request->start_date)->startOfDay(),
                    Carbon::parse($request->end_date)->endOfDay()])->get();
        $headers = [
            'ФИО должника', 'ИИН должника', 'Адрес должника', 'Наименование органа (ЧСИ)',
            'БИН органа', 'Номер исполнительного производства', 'Дата вступления в силу',
            'Сумма задолженности', 'Наименование блокировки счета',
            'Арест в пользу'];

        $spreadsheet = new Spreadsheet();
        $data[] = $headers;
        foreach ($debtors as $debtor) {
            $data[] = [$debtor->name, $debtor->iin, $debtor->address, $debtor->chsi, $debtor->bin, $debtor->nip,
                $debtor->start_date, $debtor->debit_sum, $debtor->account_block_name, $debtor->arrest_to];
        }

        $spreadsheet->getActiveSheet()->setTitle('Должники')->fromArray($data);
        $resource = tmpfile();

        $writer = IOFactory::createWriter($spreadsheet, "Xlsx");
        $writer->save($resource);
        Storage::disk('public')->put("export/debtors.xlsx", $resource);
        return Storage::disk('public')->download("export/debtors.xlsx");
    }

    public function exportDebtor(Debtor $debtor)
    {
        $headers = [
            'ФИО должника', 'ИИН должника', 'Адрес должника', 'Наименование органа (ЧСИ)',
            'БИН органа', 'Номер исполнительного производства', 'Дата вступления в силу',
            'Сумма задолженности', 'Наименование блокировки счета',
            'Арест в пользу'];

        $spreadsheet = new Spreadsheet();
        $data[] = $headers;
        $data[] = [$debtor->name, $debtor->iin, $debtor->address, $debtor->chsi, $debtor->bin, $debtor->nip,
            $debtor->start_date, $debtor->debit_sum, $debtor->account_block_name, $debtor->arrest_to];

        $spreadsheet->getActiveSheet()->setTitle('Должники')->fromArray($data);
        $resource = tmpfile();

        $writer = IOFactory::createWriter($spreadsheet, "Xlsx");
        $writer->save($resource);
        Storage::disk('public')->put("export/debtor-$debtor->id.xlsx", $resource);
        return Storage::disk('public')->download("export/debtor-$debtor->id.xlsx");
    }
}
