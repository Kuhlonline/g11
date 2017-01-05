<?php

    namespace engine\world;
    use engine\world\region as region;

    class location {

        public $region;
        public $x;
        public $y;

        private $table;

        public function __construct(region $parentRegion, int $x, int $y) {
            $this->region   = $region;
            $this->x        = $x;
            $this->y        = $y;

            $this->table    = new \data\table("vsn_location");
        }

    }

?>