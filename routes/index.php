<?php
namespace App\Routes;

use App\Controllers\LikesController;
use App\Controllers\PublishController;
use Slim\Factory\AppFactory;
use Slim\Routing\RouteCollectorProxy;

$app = AppFactory::create();


$app->group('/publish', function (RouteCollectorProxy $group) {
    $group->post('', PublishController::class.':creatPublish');
    $group->delete('/[{idPublicacao}]',PublishController::class.':deletedPublish');
    $group->put('/[{idPublicacao}]',PublishController::class.':updatePublish');    
    $group->get('', PublishController::class.':getPublishs');
    $group->get('/[{idPublicacao}]',PublishController::class.':getPublish');
    $group->post('/liked/[{idPublicacao}]',LikesController::class.':likePublish');
    $group->delete('/deslike/[{idPublicacao}]',LikesController::class.':deslikePublish');
});




$app->run();