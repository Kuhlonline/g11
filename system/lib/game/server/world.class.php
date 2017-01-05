<?php

    namespace game\server;

    class world extends \game\engine\maintained {


        /** Construct **/
            public $time;
            public $days;        

            protected $server;
            protected $events       = [];

            //Main
            public function __construct($options, \extension\shell\server &$server) {
                parent::__construct('game\\server\\world', $options);
                $this->database->setTable('world');

                //Set Server (ByRef)
                $this->server           = $server;

                //Send Loading Message
                $this->server->console("Loading World");

                //Construct World
                $this->buildWorld();

                //Send Done Message
                $this->server->console("World Loaded");

                //Reset Time
                //@todo Load time from ./server/tod
                $this->time_second      = 0;
                $this->time_minute      = 0;
                $this->time_hour        = 0;
                $this->days             = 0;
            }


        /** World Generation **/
            protected function buildWorld() {
                $totalLocs  = ($this->size * $this->size);

                for ($y = 1; $y <= $this->size; $y++) {
                    $perc   = number_format(($y / $this->size) * 100, 1);
                    $locs   = floor($y * $this->size);

                    for ($x = 1; $x <= $this->size; $x++) {
                        $loc    = new \game\location($x, $y, $this->server);
                        usleep(1);                        
                    }

                    $mb     = number_format((memory_get_usage(true) / 1024) / 1024, 2) . " MB";
                    $this->server->console("Loaded {$locs}/{$totalLocs} Locations  | {$perc}% | {$mb}");
                }
            }



        



        /** Server Events **/
            //Server Events
            public function add_event(array $event) {
                $id                 = uniqid();
                $this->events[$id]  = $event;
                return $id;
            }

            public function remove_event($id) {
                if (!isset($this->events[$id])) return;
                unset($this->events[$id]);
                return;
            }

            public function event_tick() {
                $this->calc_server_time();

                $this->ongoing_events();

                $this->automatic_events();
            }

            private function ongoing_events() {

            }

            private function automatic_events() {
                $eventList  = $this->config->world->automatic_events;

                foreach ($eventList as $eventName => $meta) {
                    $handler    = $meta->handler;
                    $function   = $meta->routine;

                    $threshold  = ($meta->chance * 100);
                    $rnd        = rand(0, 100);

                    if ($rnd > $threshold) continue;

                    try {
                        $meta->world    = $this;
                        $obj            = new $handler();

                        $obj->$function($meta);
                    } catch (Exception $e) {
                        $this->server->logItem("Error calling {$eventName}: " . $e->getMessage());
                    }
                }

            }







        private function calc_server_time() {
            if ($this->time_second < 60) {
                $this->time_second += $this->tick;
            }

            if ($this->time_second == 60) {
                $this->time_second = 0;
                $this->time_minute++;
            }
            
            if ($this->time_minute == 60) {
                $this->time_minute  = 0;
                $this->time_hour++;
            }

            if ($this->time_hour == 24) {
                $this->time_hour    = 0;
                $this->days++;
            }

            $hh             = str_pad($this->time_hour, 2, "0", STR_PAD_LEFT);
            $mm             = str_pad($this->time_minute, 2, "0", STR_PAD_LEFT);
            $ss             = str_pad($this->time_second, 2, "0", STR_PAD_LEFT);

            $this->time     = "{$hh}:{$mm}:{$ss}";
            $pack           = json_encode([
                'time_of_day'   => $this->time,
                'days_passed'   => $this->days,
                'hour'          => $hh,
                'minute'        => $mm,
                'second'        => $ss
            ]);

            file_put_contents("./server/tod", $pack);
        }
        
    }

?>