<?php

    namespace engine\world;

    class instance {

        /** Construct **/
            public $worldName;

            protected $config;
            protected $mechanics;
            protected $regions;

            public function __construct(string $worldName) {

                $this->worldName    = $worldName;
                $this->config       = new \data\json("./config/{$this->worldName}.json");
                $this->mechanics    = new \engine\mechanics($this->worldName, $this->config);

                $this->initRegions();
            }

        /** Regions **/

            private function initRegions() {
                $this->regions      = [];

                foreach ($this->config->world->regions as $region => $obj) {
                    $this->regions[$region] = new \engine\world\region($region, $obj);
                }

                return;
            }

            private function fullfillRegionNeeds(\engine\world\region $region, array $needs) {

                foreach ($needs as $need => $needed) {
                    if (!$needed) continue;
                    $region->$need();
                }

            }

            public function regions() {
                return $this->regions;
            }

            public function checkRegions() {

                foreach ($this->regions as $region) {
                    $needs  = $this->mechanics->region_needs($region);

                    $this->fullfillRegionNeeds($region, $needs);
                }

            }


        /** Locations **/

    }

?>