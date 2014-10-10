<?php
/**
 * Performs commands for the impression engine.
 * @author : Ramzi Sh. Alqrainy - ramzi.alqrainy@gmail.com
 * @copyright Copyright (c) 2014
 * @version 2.3
 */
require '/var/www/html/smart-recommendation/vendor/autoload.php';
class ImpressorCommand extends CConsoleCommand {

	public function actionEs2solr(){
		print Yii::app()->collection1->_solr->ping();
		
		 $client = new Elasticsearch\Client();
		   $searchParams['index'] = '';
    $searchParams['type']  = '';
    $searchParams['body']['query']['match']['testField'] = '';
    $queryResponse = $client->search($searchParams);

    echo $queryResponse['hits']['hits'][0]['_id']; // Outputs 'abc'
	}

	public function actionIndex() {
		echo $this->getHelp();
	}
}