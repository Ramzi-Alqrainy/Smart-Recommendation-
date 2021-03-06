<?php

    /**
     * Wraps status information for an index.
     *
     * @package Elastica
     * @author Ray Ward <ray.ward@bigcommerce.com>
     * @link http://www.elasticsearch.org/guide/reference/api/admin-cluster-health.html
     */
    class Elastica_Cluster_Health_Index {
        /**
         * The name of the index.
         *
         * @var string
         */
        protected $_name;

        /**
         * The index health data.
         *
         * @var array
         */
        protected $_data;

        /**
         * @param string $name The name of the index.
         * @param array $data The index health data.
         */
        public function __construct($name, $data) {
            $this->_name = $name;
            $this->_data = $data;
        }

        /**
         * Gets the name of the index.
         *
         * @return string
         */
        public function getName() {
            return $this->_name;
        }

        /**
         * Gets the status of the index.
         *
         * @return string green, yellow or red.
         */
        public function getStatus() {
            return $this->_data['status'];
        }

        /**
         * Gets the number of nodes in the index.
         *
         * @return int
         */
        public function getNumberOfShards() {
            return $this->_data['number_of_shards'];
        }

        /**
         * Gets the number of data nodes in the index.
         *
         * @return int
         */
        public function getNumberOfReplicas() {
            return $this->_data['number_of_replicas'];
        }

        /**
         * Gets the number of active primary shards.
         *
         * @return int
         */
        public function getActivePrimaryShards() {
            return $this->_data['active_primary_shards'];
        }

        /**
         * Gets the number of active shards.
         *
         * @return int
         */
        public function getActiveShards() {
            return $this->_data['active_shards'];
        }

        /**
         * Gets the number of relocating shards.
         *
         * @return int
         */
        public function getRelocatingShards() {
            return $this->_data['relocating_shards'];
        }

        /**
         * Gets the number of initializing shards.
         *
         * @return int
         */
        public function getInitializingShards() {
            return $this->_data['initializing_shards'];
        }

        /**
         * Gets the number of unassigned shards.
         *
         * @return int
         */
        public function getUnassignedShards() {
            return $this->_data['unassigned_shards'];
        }

        /**
         * Gets the health of the shards in this index.
         *
         * @return array Array of Elastica_Cluster_Health_Shard objects.
         */
        public function getShards() {
            $shards = array();
            foreach ($this->_data['shards'] as $shardNumber => $shard) {
                $shards[] = new Elastica_Cluster_Health_Shard($shardNumber, $shard);
            }

            return $shards;
        }
    }
