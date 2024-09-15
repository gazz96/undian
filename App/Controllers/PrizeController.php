<?php 

namespace App\Controllers;

use App\Models\Prize;
use App\Models\Drawing;

use Rakit\Validation\Validator;

class PrizeController 
{
    public function index($request)
    {

        $prizes = Prize::orderBy('id', 'DESC')->paginate(20);

        return view('prize.index', [
            'prizes' => $prizes
        ]);
    }

    public function form($request, $response, $service, $app)
    {
        $prize = $request->id ? Prize::findOrFail($request->id) : new Prize;
        return view('prize.form', [
            'prize' => $prize,
            'drawings' => Drawing::orderBy('name', 'ASC')->get()
        ]);
    }

    public function save($request, $response, $service, $app)
    {
        $validator = new Validator;
        $validation = $validator->validate($_POST, [
            'id' => 'nullable',
            'drawing_id' => 'required',
            'name' => 'required',
            'jabatan' => 'required',
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
            $prize = Prize::findOrFail($validated['id']);
            $prize->update($validated);
            return $service->back();
        }
        
        Prize::create($validated);
        return $response->redirect(url('/prizes?drawing_id=' . $validated['drawing_id']));

    }


    public function destroy($request, $response, $service)
    {
        $prize = Prize::findOrFail($request->id);
        $prize->delete();
        return $service->back();
    }
}