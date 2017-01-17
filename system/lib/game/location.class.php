<?php

    namespace game;

    class location extends \game\engine\maintained {

        public $id;
        public $x;
        public $y;

        public function __construct(int $x, int $y, \extension\shell\server &$server) {
            $name       = "x{$x}-y{$y}";
            $this->name = $name;

            parent::__construct($name, []);
            $this->database->setTable('world');


            $this->x    = $x;
            $this->y    = $y;
            $coords     = "x" . str_pad($x, 3, 0, STR_PAD_LEFT) . " y" . str_pad($y, 3, 0, STR_PAD_LEFT);

            if ($this->exists() == false) {
                
                if ($this->create()) {
                    $server->console("Created new location {$this->x}x{$this->y}");
                } else {
                    $server->console("Failed to create new location {$this->x}x{$this->y}");
                }

            } else {
                $server->console("Loaded location {$this->x}x{$this->y}");
            }
        }

        private function exists() : bool {
            $tiles  = $this->database->query("SELECT `id` FROM `world` WHERE `x` = '{$this->x}' AND `y` = '{$this->y}' ORDER BY `id` DESC LIMIT 1");
            return (($tiles !== false) and count($tiles) >= 1);
        }

        private function create() : bool {
            $defaultRates   = $this->config->world->generator->tiles;

            $r  = (int) rand($defaultRates->rock * 0.5, $defaultRates->rock * 2);
            $s  = (int) rand($defaultRates->sand * 0.5, $defaultRates->sand * 2);
            $d  = (int) rand($defaultRates->dirt * 0.5, $defaultRates->dirt * 2);
            $w  = (int) rand($defaultRates->water * 0.5, $defaultRates->water * 2);

            $newLocation    = [
                'x'         => $this->x,
                'y'         => $this->y,
                'rock'      => $r,
                'sand'      => $s,
                'dirt'      => $d,
                'water'     => $w,
            ];

            return $this->database->commit($newLocation);
        }

        private function update() : bool {

        }

        private function get_record() {
            $tiles      = $this->database->select("`x` = '{$this->x}' AND `y` = '{$this->y}' ORDER BY `id` DESC LIMIT 1");
            if ($tiles === false) return null;

            $location   =  $tiles[0] ?? null;
            if (!$location) return null;

            $this->id   = $location->id;
            $this->dirt = $location->dirt;
            $this->rock = $location->rock;
            $this->sand = $location->sand;
            $this->water= $location->water;
        }

    }

?>