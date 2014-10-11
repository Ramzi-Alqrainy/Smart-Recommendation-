<?php
/**
 * Performs commands for the impression engine.
 * @author : Ramzi Sh. Alqrainy - ramzi.alqrainy@gmail.com
 * @copyright Copyright (c) 2014
 * @version 2.3
 */
require '/var/www/html/Smart-Recommendation-/smart-recommendation/vendor/autoload.php';
class ImpressorCommand extends CConsoleCommand {

	public function actionEs2solr(){
		$client = new Elasticsearch\Client();
		if(Yii::app()->collection1->_solr->ping()){
			print "Solr is running";
		}
		$offset = 0;
		while (true) {
			// Getting all results
			$results = Yii::app()->collection1->get("*:*", $offset*50, 50, array('fl'=>'id'));
			if(!$results->response->numFound)break;
			foreach ($results->response->docs as $doc) {
				$params['body']['query']['match']['message'] = $doc->id;
                $queryResponse = $client->search($searchParams);
                if($queryResponse['hits']['total']){
                	$document = array();
                	$document['id']=$doc->id;
                	$document['views']=$queryResponse['hits']['total'];
                	Yii::app()->collection1->updateOneWithoutCommit($document);
                }
                
			}
			$offset=$offset++;
			Yii::app()->collection1->solrCommitWithOptimize();
				
		}
		echo "Done \n";
	}

	public function actionIndex() {
		echo $this->getHelp();
	}
}
