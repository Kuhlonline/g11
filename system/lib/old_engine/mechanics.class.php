<?php

    namespace engine;

    class mechanics extends \core\stdObject {

        /** Construct **/

            public $worldName;

            protected $settings;

            public function __construct(string $worldName, \data\json $config) {
                parent::__construct('mechanics');

                $this->worldName    = $worldName;
                $this->settings     = $config->settings;
            }



        /** Evaluations **/

            public function region_needs(\engine\world\region &$region) {
                return [
                    'create_location' => $this->region_needs_locations($region)
                ];
            }

            public function location_needs(\engine\world\location &$location) {
                return [

                ];
            }



        /** Providers **/

            protected function region_needs_locations(\engine\world\region &$region) {
                return true;
            }

    }

?>