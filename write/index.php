<?php
use Phalcon\Exception as PhalconException;
use Write\Resources\Application;
use Write\Resources\DatabaseAdapter;
use Write\Resources\DependencyInjector;
use Write\Resources\Dispatcher;
use Write\Resources\Router;
use Write\Resources\SessionManager;
use Write\Resources\ViewManager;
use Write\Resources\VoltTemplateEngine;

require '../vendor/autoload.php';

try {
	$dependencyInjector = new DependencyInjector();

	$dependencyInjector->set( 'dispatcher', new Dispatcher( $dependencyInjector )       );
	$dependencyInjector->set( 'router',     new Router()                                );
	$dependencyInjector->set( 'session',    function() { return new SessionManager(); } );
	$viewManager = new ViewManager( $dependencyInjector );
	$dependencyInjector->set( 'view',       $viewManager, true                          );
	$volt = new VoltTemplateEngine( $viewManager, $dependencyInjector );
	$dependencyInjector->set( 'volt',       $volt, true                                 );
	$application = new Application( $dependencyInjector );
	$dependencyInjector->set( 'db',         new DatabaseAdapter()                       );

	echo $application->handle()->getContent();
} catch( PhalconException $e ) {
	die(
		'<pre>' .
		'Phalcon Exception: ' . $e->getMessage() . "\r\n" .
		'Trace: ' . $e->getTraceAsString() .
		'</pre>'
	);
}