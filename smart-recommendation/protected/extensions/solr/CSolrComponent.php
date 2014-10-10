<?php

/**
 * SolrClient class file.
 *
 * @version 3.0
 * @auther Ramzi Sh. Alqrainy
 * ramzi.alqrainy@gmail.com
 *
 * Copyright (C) 2014 .
 *
 */
/**
 * Include the the Solr php client class.
 */
require_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'phpSolrClient' . DIRECTORY_SEPARATOR . 'Service.php');

class CSolrComponent extends CApplicationComponent {

    /**
     * Host name
     *
     * @var strinf
     */
    public $host = 'localhost';

    /**
     * The port of the solr server
     *
     * @var int
     */
    public $port = '8983';

    /**
     * The Solr index (core)
     *
     * @var string (the url path)
     */
    public $indexPath = '/solr';
    public $_solr;

    public function init() {
        parent::init();
        if (!$this->host || !$this->indexPath)
            throw new CException('No server or index selected.');
        else
            $this->_solr = new Apache_Solr_Service($this->host, $this->port, $this->indexPath);
    }

    /**
     * This function add or update one entry on solr index
     *
     * @param array $document Example: array('id'=>1,'title'=>'the title of the article')
     */
    public function updateOne($document = array()) {
        if (!is_array($document)) {
            throw new CException('Document must be an array.');
        }

        try {
            $this->_solr->addDocuments($document);
            $this->_solr->commit();
            $this->_solr->optimize();
            return true;
        } catch (Exception $e) {
            throw new CException('Solr error: ' . $e->getMessage());
        }
        return false;
    }

    /**
     * This function add or update one entry on solr index without commit and optimize .
     *
     * @param array $document Example: array('id'=>1,'title'=>'the title of the article')
     */
    public function updateOneWithoutCommit($document = array()) {
        if (!is_array($document)) {
            throw new CException('Document must be an array.');
        }
        try {

            $this->_solr->addDocuments($document);
            return true;
        } catch (Exception $e) {
            throw new CException('Solr error: ' . $e->getMessage());
        }
        return false;
    }

    public function updateFieldsWithoutCommit($document = array()) {
        if (!is_array($document)) {
            throw new CException('Document must be an array.');
        }
        try {
            $this->_solr->updateFields($document);
            return true;
        } catch (Exception $e) {
            throw new CException('Solr error: ' . $e->getMessage());
        }
        return false;
    }

    /**
     * Commit Indexed Data
     */
    public function solrCommitWithOptimize() {
        $this->_solr->commit();
        $this->_solr->optimize();
        return true;
    }

    /**
     * Commit Indexed Data
     */
    public function solrCommit() {
        $this->_solr->commit();
        return true;
    }

    /**
     * Optimzie Indexed Data
     */
    public function solrOptimize() {
        $this->_solr->optimize();
        return true;
    }

    /**
     * This function add or update one entry on solr index
     *
     * @param array $document Example:
     * array('0'=>array('id'=>1,'title'=>'the title of the article 2'),
     *       '1'=>array('id'=>2,'title'=>'the title of the article 2')
     *       );
     */
    public function updateMany($documents = array()) {
        if (!is_array($documents)) {
            throw new CException('Documents must be an array.');
        }
        foreach ($documents as $item => $document) {
            $part = new Apache_Solr_Document();
            foreach ($document as $key => $value) {
                $part->$key = $value;
            }
            $docs[] = $part;
        }

        try {
            $this->_solr->addDocuments($docs);
            $this->_solr->commit();
            $this->_solr->optimize();
            return true;
        } catch (Exception $e) {
            throw new CException('Solr error: ' . $e->getMessage());
        }
        return false;
    }

    /**
     * Return resutls for a query
     *
     * @param mixed $query
     * @param mixed $offset
     * @param mixed $limit
     * @param mixed $additionalParameters
     *
     * Example: $additionalParameters = array('facet' => 'true',
     *                               'facet.field' => 'links',
     *                               'sort'=> 'id desc'
     *                                );
     * 
     * @return Apache_Solr_Response 
     * 
     * 
     */
    public function get($query, $offset = 0, $limit = 30, $additionalParameters = array()) {
        try {
            $response = $this->_solr->search($query, $offset, $limit, $additionalParameters);
            return($response);
        } catch (Exception $e) {
            throw new CException('Solr error: ' . $e->getMessage());
        }
    }

    /**
     * Remove document by id or ids
     *
     * @param mixed $ids
     * 
     * @return null 
     * 
     * 
     */
    public function rmByIds($ids) {
        try {
            //foreach($ids as $id){
            $this->_solr->deleteByMultipleIds($ids);
            //}
            $this->_solr->commit();
            $this->_solr->optimize();
            return NULL;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    /**
     * Remove document by query
     *
     * @param mixed $ids
     * 
     * @return null 
     * 
     * 
     */
    public function rm($query = "*:*") {
        try {
            $this->_solr->deleteByQuery($query);
            $this->_solr->commit();
            $this->_solr->optimize();
            return NULL;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Remove document by query and without commit
     *
     * @param mixed $ids
     * 
     * @return null 
     * 
     * 
     */
    public function rmWithoutCommit($query = "*:*") {
        try {
            $this->_solr->deleteByQuery("id:" . $query);
            return NULL;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

}

?>
