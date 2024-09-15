<?php 

use Rakit\Validation\Validator;


$app->respond(function($request, $response, $service, $app) {
    $service->startSession();
    $_SESSION['oldInputs'] = [];
    $_SESSION['errors'] = [];   
});

