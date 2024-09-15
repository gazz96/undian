<?php 

namespace App\Controllers;

use App\Models\User;

use Rakit\Validation\Validator;

class UserController 
{
    public function index($request)
    {

        $users = User::orderBy('id', 'DESC')->paginate(20);

        return view('user.index', [
            'users' => $users
        ]);
    }

    public function form($request, $response, $service, $app)
    {

        $user = $request->id ? User::findOrFail($request->id) : new User;
        return view('user.form', [
            'user' => $user
        ]);
    }

    public function save($request, $response, $service, $app)
    {
        $validator = new Validator;

        $rules = [
            'id' => 'nullable',
            'name' => 'required',
            'username' => 'required',
            'password' => 'required',
            'status' => 'required'
        ];

        if($_POST['truth_action'] == "update")
        {
            $rules['password'] = 'nullable';
        }

        $validation = $validator->validate($_POST + $_FILES, $rules);

    
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
            $user = User::findOrFail($validated['id']);

            if(empty($validated['password']))
            {
                unset($validated['password']);
            }

            if($validated['password'] ?? '')
            {
                $validated['password'] = md5($validated['password']);
            }

            $user->update($validated);
            return $service->back();
        }

        $validated['password'] = md5($validated['password']);
        
        User::create($validated);

        return $response->redirect(url('/users'));

    }


    public function destroy($request, $response, $service)
    {
        $user = User::findOrFail($request->id);
        $user->delete();
        return $service->back();
    }
}