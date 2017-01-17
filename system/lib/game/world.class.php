<?php

    namespace game;

    class world extends \game\engine\maintained {



        /** Construct **/

            //Main
            public function __construct() {
                parent::__construct("\\game\\world", []);
                $this->database->setTable('world');
            }



        /** API **/


            //time of day
            public function api_time_of_day($param = array()) {
                $json           = file_get_contents("./server/runtime/tod");
                if (!$json)     return false;

                $data           = json_decode($json, true);
                if (!$data)     return false;

                return $data;
            }

            //View
            public function api_view($param = array()) {

                $area   = function(array $param, &$x1 = 0, &$x2 = 0, &$y1 = 0, &$y2 = 0) {
                    $size   = $param['size'] ?? 2;

                    $x1     = $param['x'] - $size;
                    $x2     = $param['x'] + $size;
                    $y1     = $param['y'] - $size;
                    $y2     = $param['y'] + $size;
                };

                $where  = function(callable $area, array $param) {

                    $area($param, $x1, $x2, $y1, $y2);

                    return 
                        "(`x` >= '{$x1}' AND `x` <= '{$x2}') ".
                        "AND ".
                        "(`y` >= '{$y1}' AND `y` <= '{$y2}') ".
                        "ORDER BY `id` ASC"
                    ;
                };

                $tiles  = $this->database->select($where($area, $param));

                foreach ($tiles as $index => $tile) {

                    $mats                   = [
                        'water' => $tile->water,
                        'rock'  => $tile->rock,
                        'sand'  => $tile->sand,
                        'dirt'  => $tile->dirt
                    ];

                    $tiles[$index]->mode    = array_search(max($mats), $mats);                    
                }
                
                return $tiles;
            }

    }