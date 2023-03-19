<?php
 
require_once 'vendor/autoload.php';

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

$containerBuilder = new ContainerBuilder();

$containerBuilder
->register('request', '\App\Request')
->addArgument($_SERVER['REQUEST_URI'])
->addArgument($_POST);
$requestService = $containerBuilder->get('request');
 
$containerBuilder
->register('model', '\App\Model')
->addArgument($_ENV)
->addArgument(new Reference('request'));
$modelService = $containerBuilder->get('model');

$containerBuilder
->register('controller', '\App\Controller')
->addArgument(new Reference('request'))
->addArgument(new Reference('model'));
$controllerService = $containerBuilder->get('controller');