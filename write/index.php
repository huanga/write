<?php
use Phalcon\Exception as PhalconException;
use Write\Resources\Application;
use Write\Resources\DependencyInjector;
use Write\Resources\Dispatcher;
use Write\Resources\Router;
use Write\Resources\SessionManager;
use Write\Resources\ViewManager;

require '../vendor/autoload.php';

try {
	$dependencyInjector = new DependencyInjector();

	$dependencyInjector->set( 'dispatcher', new Dispatcher( $dependencyInjector )       );
	$dependencyInjector->set( 'router',     new Router()                                );
	$dependencyInjector->set( 'session',    function() { return new SessionManager(); } );
	$dependencyInjector->set( 'view',       new ViewManager()                           );

	$application = new Application( $dependencyInjector );

	echo $application->handle()->getContent();
} catch( PhalconException $e ) {
	die(
		'<pre>' .
		'Phalcon Exception: ' . $e->getMessage() . "\r\n" .
		'Trace: ' . $e->getTraceAsString() .
		'</pre>'
	);
}