<?php 

namespace App\Controllers;

use App\Models\Participant;
use App\Models\Drawing;

class WelcomeController 
{

    public function index($request, $response, $service, $app)
    {
        if(!$_GET['drawing_id'] ?? null)
        {
            return $response->redirect(url('/drawings'));
        }
        
        $participants = Participant::where('drawing_id', $_GET['drawing_id'] ?? null)
            ->where('winner', 0)
            ->get();
        
        $winners = Participant::where('drawing_id', $_GET['drawing_id'] ?? null)
            ->where('winner', '>', 0)
            ->orderBy('winner', 'ASC')
            ->get();
            
        return view('home', [
            'drawing' => Drawing::find($_GET['drawing_id'] ?? null),
            'participants' => $participants,
            'winners' => $winners
        ]);
    }

}