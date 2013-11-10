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

define( 'APPPATH', __DIR__ );

require './vendor/autoload.php';

try {

	$dependencyInjector = new DependencyInjector();
	$dispatcher         = new Dispatcher( $dependencyInjector );
	$viewManager        = new ViewManager( $dependencyInjector );
	$voltTemplateEngine = new VoltTemplateEngine( $viewManager, $dependencyInjector );

	$dependencyInjector->set( 'dispatcher', $dispatcher                         );
	$dependencyInjector->set( 'router',     'Write\\Resources\\Router'          );
	$dependencyInjector->set( 'session',    'Write\\Resources\\SessionManager'  );
	$dependencyInjector->set( 'view',       $viewManager, true                  );
	$dependencyInjector->set( 'volt',       $voltTemplateEngine, true           );
	$dependencyInjector->set( 'db',         'Write\\Resources\\DatabaseAdapter' );

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