<?php 

namespace App\Controllers;

use App\Models\Drawing;

use Rakit\Validation\Validator;

class DrawingController 
{
    public function index($request)
    {
        $drawings = Drawing::orderBy('id', 'DESC')->paginate(20);
        return view('drawing.index', [
            'drawings' => $drawings
        ]);
    }

    public function form($request, $response, $service, $app)
    {
        $drawing = $request->id ? Drawing::findOrFail($request->id) : new Drawing;
        return view('drawing.form', [
            'drawing' => $drawing
        ]);
    }

    public function save($request, $response, $service, $app)
    {
        $validator = new Validator;
        $validation = $validator->validate($_POST, [
            'id' => 'nullable',
            'name' => 'required',
            'duration' => 'required',
        ]);

        $validation->validate();

        if($validation->fails())
        {   
            $_SESSION['errors'] = $validation->errors()->firstOfAll();
            $_SESSION['oldInputs'] = $_POST;
            return $service->back();
        }

        $validated = $validation->getValidData();
        
        $target_dir = "assets/images/";
        $target_file = $target_dir . basename($_FILES["file"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        
        $check = getimagesize($_FILES["file"]["tmp_name"]);
        if($check !== false) 
        {
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) 
            {
                $validated['background'] = $target_dir . $_FILES['file']['name'];
            }
        } 

        if($validated['id'] ?? null)
        {
            $drawing = Drawing::findOrFail($validated['id']);
            $drawing->update($validated);
            return $service->back();
        }
        
        Drawing::create($validated);
        return $response->redirect(url('/drawings'));

    }


    public function destroy($request, $response, $service)
    {
        $drawing = Drawing::findOrFail($request->id);
        $drawing->delete();
        return $service->back();
    }
}