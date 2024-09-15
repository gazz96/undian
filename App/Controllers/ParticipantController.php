<?php 

namespace App\Controllers;

use App\Models\Participant;
use App\Models\Drawing;

use Rakit\Validation\Validator;

class ParticipantController 
{
    public function index($request)
    {

        $participants = Participant::orderBy('id', 'DESC')
            ->where('drawing_id', $_GET['drawing_id'] ?? null)
            ->paginate(20);

        return view('participant.index', [
            'participants' => $participants
        ]);
    }

    public function form($request, $response, $service, $app)
    {
        $participant = $request->id ? Participant::findOrFail($request->id) : new Participant;
        return view('participant.form', [
            'participant' => $participant,
            'drawings' => Drawing::orderBy('name', 'ASC')->get()
        ]);
    }

    public function save($request, $response, $service, $app)
    {
        $validator = new Validator;
        $validation = $validator->validate($_POST, [
            'id' => 'nullable',
            'drawing_id' => 'required',
            'nipp' => 'required',
            'name' => 'required',
            'subarea' => 'required',
        ]);

        $validation->validate();

        if($validation->fails())
        {   
            $errors = $validation->errors()->firstOfAll();
            $_SESSION['errors'] = $errors;
            $_SESSION['oldInputs'] = $_POST;
            return $service->back();
        }

        $validated = $validation->getValidData();

        if($validated['id'] ?? null)
        {
            $participant = Participant::findOrFail($validated['id']);
            $participant->update($validated);
            return $service->back();
        }
        
        Participant::create($validated);
        return $response->redirect(url('/participants?drawing_id=' . $validated['drawing_id']));

    }


    public function destroy($request, $response, $service)
    {
        $participant = Participant::findOrFail($request->id);
        $participant->delete();
        return $service->back();
    }

    public function winner($request, $response, $service)
    {
        
        $participant = Participant::findOrFail($request->id);
        $latestParticipant = Participant::orderBy('winner', 'DESC')
            ->where('drawing_id', $participant->drawing_id)
            ->take(1)
            ->first();
            
        $participant->update([
            'winner' => $latestParticipant->winner + 1
        ]);

        return $participant;
    }
    
    public function downloadWinner($request, $response)
    {
            
        $participants = Participant::select(['nipp', 'name', 'subarea', 'winner'])
            ->where('winner', '>', 0)
            ->where('drawing_id', $request->id)
            ->orderBy('winner', 'ASC')
            ->get();
            
        
        $filename = "pemenang" .date('Ymd') . ".xls";     
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=\"$filename\"");
        
        $heading = false;
        foreach($participants->toArray() as $row) 
        {
            if(!$heading) 
            {
                // display field/column names as a first row
                echo implode("\t", array_keys($row)) . "\n";
                $heading = true;
            } 
            echo implode("\t", array_values($row)) . "\n";
        }
        exit;
    }
     
    public function resetWinner($request, $response, $service)
    {
        $participants = Participant::where('drawing_id', $request->id)
            ->update([
                'winner' => 0
            ]);
            
        return $service->back();
    }
    
    public function truncateParticipant($request, $response, $service)
    {
        $participants = Participant::where('drawing_id', $request->id)->delete();
        return $service->back();
    }
    
    public function importParticipant($request, $response, $service)
    {
        
        $validator = new Validator;
        $validation = $validator->validate($_POST + $_FILES, [
            'file' => 'required|uploaded_file:0,2000K,xlsx'
        ]);

        $validation->validate();

        if($validation->fails())
        {   
            $errors = $validation->errors()->firstOfAll();
            $_SESSION['errors'] = $errors;
            $_SESSION['oldInputs'] = $_POST;
            return $service->back();
        }
    
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($_FILES['file']['tmp_name']);    
        
        $worksheet = $spreadsheet->getActiveSheet();

        $fields = ['nipp', 'name', 'subarea'];
        foreach ($worksheet->getRowIterator() as $row) {
            PHP_EOL;
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(FALSE); 
            $temp = [];
            $index = 0;
            foreach ($cellIterator as $cell) 
            {
                $value = $cell->getValue();
                if($value)
                {
                    $temp[$fields[$index++]] = $cell->getValue();
                    PHP_EOL;
                }
            }
            
            if(count($temp))
            {
                $create = Participant::create($temp + [
                    'drawing_id' => $request->id
                ]);   
            }
            
            PHP_EOL;
        }
        PHP_EOL;
        
        return $service->back();

    }
}