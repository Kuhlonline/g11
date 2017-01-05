<?php

    namespace game\engine;

    class weather extends \game\engine\maintained {        

        public function __construct() {
            parent::__construct('weather', []);
        }

        public function rain($param) {

            $x1             = 1;
            $x2             = $param->world->size;
            $y1             = 1;
            $y2             = $param->world->size;

            $rX             = rand($x1, $x2);
            $rY             = rand($y1, $y2);

            $x1             = $rX - rand($param->min_diameter, $param->max_diameter);
            $x2             = $rX + rand($param->min_diameter, $param->max_diameter);
            $y1             = $rY - rand($param->min_diameter, $param->max_diameter);
            $y2             = $rY + rand($param->min_diameter, $param->max_diameter);

            $event          = [
                'name'      => $param->name,
                'called'    => 0,
                'max'       => $param->max_duration_hours,
                'location'  => [
                    'x1'    => $x1,
                    'x2'    => $x2,
                    'y1'    => $y1, 
                    'y2'    => $y2
                ],
                'handler'   => $param->handler,
                'routine'   => 'weather_rain'
            ];

            $param->world->add_event($event);
            return $event;
        }

        public function weather_rain() {
            
        }

    }