<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Console Application',

	// preloading 'log' component
	'preload'=>array('log','importelastica'),
    'import'=>array(
		'application.extensions.solr.*',
        'application.lib.Elastica.*',
),

	// application components
	'components'=>array(
			
			
			
			'collection1'=>array(
			
					'class'=>'CSolrComponent',
			
					'host'=>'ec2-54-198-189-209.compute-1.amazonaws.com',
			
					'port'=>8983,
			
					'indexPath'=>'/solr/collection1'
			
			),
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		// uncomment the following to use a MySQL database
		/*
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=testdrive',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
		),
		*/
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
			),
		),
	),
	'params'=>array(
	'elastica' => array(
				
			'servers' => array(
						
					array('host' => 'ec2-54-198-189-209.compute-1.amazonaws.com', 'port' => 9200)
						
			)),
	),
);