<?php

    /**
     * Array query
     * Pure php array query. Can be used to create any not existing type of query.
     *
     * @uses Elastica_Query_Abstract
     * @category Xodoa
     * @package Elastica
     * @author Nicolas Ruflin <spam@ruflin.com>
     */
    class Elastica_Query_Array extends Elastica_Query_Abstract {
        /**
         * Query
         *
         * @var array Query
         */
        protected $_query = array();

        /**
         * Constructs a query based on an array
         *
         * @param array $query Query array
         */
        public function __construct(array $query) {
            $this->setQuery($query);
        }

        /**
         * Sets new query array
         *
         * @param  array $query Query array
         * @return Elastica_Query_Array Current object
         */
        public function setQuery(array $query) {
            $this->_query = $query;

            return $this;
        }

        /**
         * Converts query to array
         *
         * @return array Query array
         * @see Elastica_Query_Abstract::toArray()
         */
        public function toArray() {
            return $this->_query;
        }
    }
