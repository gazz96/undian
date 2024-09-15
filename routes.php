<?php

use App\Controllers\DrawingController;
use App\Controllers\ParticipantController;
use App\Controllers\PrizeController;
use App\Controllers\UserController;
use App\Controllers\WelcomeController;




$app->respond('GET', '/', [new WelcomeController, 'index']);

$app->respond('GET', '/users', [new UserController, 'index']);
$app->respond('GET', '/users/form/[:id]?', [new UserController, 'form']);
$app->respond('POST', '/users', [new UserController, 'save']);
$app->respond('GET', '/users/delete/[:id]', [new UserController, 'destroy']);

$app->respond('GET', '/drawings', [new DrawingController, 'index']);



$app->respond('GET', '/drawings/form/[:id]?', [new DrawingController, 'form']);
$app->respond('POST', '/drawings', [new DrawingController, 'save']);
$app->respond('GET', '/drawings/delete/[:id]', [new DrawingController, 'destroy']);

$app->respond('GET', '/participants', [new ParticipantController, 'index']);
$app->respond('GET', '/participants/form/[:id]?', [new ParticipantController, 'form']);
$app->respond('POST', '/participants', [new ParticipantController, 'save']);
$app->respond('GET', '/participants/delete/[:id]', [new ParticipantController, 'destroy']); 
$app->respond('GET', '/participants/winner/[:id]', [new ParticipantController, 'winner']);
$app->respond('GET', '/participants/download-winner/[:id]', [new ParticipantController, 'downloadWinner']);
$app->respond('GET', '/participants/reset-winner/[:id]', [new ParticipantController, 'resetWinner']);
$app->respond('GET', '/participants/truncate/[:id]', [new ParticipantController, 'truncateParticipant']);
$app->respond('POST', '/participants/import/[:id]', [new ParticipantController, 'importParticipant']);

$app->respond('GET', '/prizes', [new PrizeController, 'index']);
$app->respond('GET', '/prizes/form/[:id]?', [new PrizeController, 'form']);
$app->respond('POST', '/prizes', [new PrizeController, 'save']);
$app->respond('GET', '/prizes/delete/[:id]', [new PrizeController, 'destroy']);