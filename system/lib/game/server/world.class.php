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

                //Reset Time
                //@todo Load time from ./server/tod
                $this->time_second      = 0;
                $this->time_minute      = 0;
                $this->time_hour        = 0;
                $this->days             = 0;
            }



        /** World Generation **/

            //Truncate the table and remove all locations
            public function truncate() {
                $sql        = "TRUNCATE `world`;";
                $result     = $this->database->query($sql, true);
                return;
            }


            public function generateWorld() {

                $ticks      = ($this->size * $this->size);

                $handler    = function($param = array()) {
                    
                    $event  = $this->events[$param['id']];
                    $size   = $param['size'];
                    $i      = $event['iterations'];
                    $d      = $event['duration'];

                    $results    = $event['results'][$i] ?? [];

                    if (!$results) {
                        $curX   = 1;
                        $curY   = 1;
                    } else {
                        $curX   = $results['last_x'] ?? -1;
                        $curY   = $results['last_y'] ?? -1;

                        if ($curY == -1 or $curX == -1) return;

                        if ($curX < $size) {
                            $curX++;
                        } else {
                            $curX = 1;
                            $curY++;
                        }

                        if ($curY > $size) {
                            $this->stopTimedEvent($param['id']);
                            return "Completed {$param['name']}";
                        }
                    }
                    
                    $perc   = number_format(($i/$d) * 100, 1);
                    $loc    = new \game\location($curX, $curY, $this->server);
                    
                    return [
                        'last_x'    => $curX,
                        'last_y'    => $curY
                    ];
                };

                $payload    = [
                    'name'  => $this->name,
                    'size'  => $this->size
                ];

                $eventId    = $this->startTimedEvent(
                    'generate_world', 
                    $ticks,
                    $handler,
                    $payload,
                    true,
                    12,                    
                    4096
                );

                return "Started Event generate_world with Id #{$eventId}";
            }






        /** Server Events **/

            //Create a Server Event
            public function startTimedEvent(string $eventName, int $eventTicks = 0, callable $handler, array $param = array(), bool $eventCaching = false, int $cacheSize = 0, int $step = 1) {
                $id                 = uniqid();
                $disabled           = $this->disabled_events;
                if (in_array($eventName, $disabled)) return false;

                $this->events[$id]  = [
                    'id'        => $id,
                    'name'      => $eventName,
                    'duration'  => $eventTicks,
                    'iterations'=> 0,
                    'start_time'=> 0,
                    'param'     => $param,
                    'handler'   => $handler,
                    'results'   => [],
                    'cache'     => $eventCaching,
                    'cache_size'=> $cacheSize,
                    'step'      => $step
                ];

                return $id;
            }

            //Stop a Server Event
            public function stopTimedEvent($id) {
                unset($this->events[$id]);
            }

            //List running events by name
            public function runningEvents() {
                $buffer     = [];

                foreach ($this->events as $id => $event) {
                    $name               = $event['name'];

                    if (!isset($buffer[$name])) $buffer[$name] = [];
                    $buffer[$name][]    = $event;
                }

                return $buffer;
            }

            //Disable Event to prevent it from running
            public function disableEvent(string $eventName) : bool {
                $eventList                              = $this->config->world->disabled_events;
                $eventList[]                            = $eventName;

                $this->config->readonly(false);
                $this->config->autosave(true);
                $this->config->world->disabled_events   = $eventList;
                $this->config->readonly(true);

                return true;
            }

            //Re-enable Event to allow it to run
            public function enableEvent(string $eventName) : bool {
                $eventList                              = $this->config->world->disabled_events;
                if (!in_array($eventName, $eventList)) return false;

                foreach ($eventList as $index => $event) {
                    if ($eventName != $event) continue;

                    unset($eventList[$index]);

                    $this->config->readonly(false);
                    $this->config->autosave(true);
                    $this->config->world->disabled_events   = $eventList;
                    $this->config->readonly(true);

                    return true;
                }

                return false;
            }

            //List disabled events by name
            public function disabledEvents() : array {
                return $this->disabled->events;
            }



        /** Built-in Server Functions **/

            //Serve timed events in memory
            private function serve_timed_events() {
                if (!$this->events) return;

                foreach ($this->events as $id => $event) {
                    $d      = $event['duration']    ?? false;
                    $i      = $event['iterations']  ?? 0;
                    $step   = $event['step']        ?? 1;

                    if ($i == 0) $event['start_time'] = time();
                    if ($d == false) continue;

                    for ($s = 1; $s <= $step; $s++) {

                        //CPU Rest
                        usleep(100);
                        $i      = $event['iterations']  ?? 0;

                        if ($i >= $d) {
                            $this->stopTimedEvent($id);
                            continue;
                        } else {
                            $event['iterations']    = ($i + 1);
                        }

                        $func                       = $event['handler'];
                        $event['param']['id']       = $id;
                        $result                     = $func($event['param']);

                        if ($event['cache'] and $result) {
                            $event['results'][$i+1] = $result;
                        }

                        if ($event['cache_size'] != 0) {
                            if (count($event['results']) > $event['cache_size']) {
                                $keys       = array_keys($event['results']);
                                $firstKey   = $keys[0];
                                unset($event['results'][$firstKey]);
                            }
                        }

                        $this->events[$id]      = $event;
                    }

                }

            }

            //Generate Random Events
            private function generate_random_events() {

                $events     = $this->random_events ?? false;
                if (!$events) return;

                foreach ($events as $title => $event) {

                    $running    = array_key_exists($title, $this->runningEvents());
                    if ($running and ($event['threaded'] == false)) continue;

                    $rnd        = rand(0, 10000);
                    $threshold  = (int) $event['chance'];
                    if ($rnd > $threshold) continue;

                    $duration   = rand($event['duration_min'], $event['duration_max']);
                    $callback   = function(array $param = array()) {
                        $event          = $param['event'] ?? [];
                        if (!$event) return "No Event";

                        $cName          = $event['controller'];
                        $fName          = $event['handler'];

                        if (class_exists($cName) == false) return "Doesn't Exist";
                        try {
                            $controller     = new $cName();
                        } catch (Exception $e) {
                            return $e->getMessage();
                        }

                        if (method_exists($controller, $fName) == false) return "{$cName} can't use {$fName}";
                        try {
                            $result         = $controller->$fName($param);
                        } catch (Exception $e) {
                            return $e->getMessage();
                        }
                        
                        return $result;
                    };

                    $event['title'] = $title;
                    $arguments      = ['event' => $event, 'world' => $this];
                    $this->startTimedEvent($title, $duration, $callback, $arguments, true);
                };

            }

            //Generate timed Events
            private function generate_timed_events() {

                $events     = $this->timed_events;
                if (!$events) return false;

                foreach ($events as $title => $event) {

                    $running    = array_key_exists($title, $this->runningEvents());
                    if ($running and ($event['threaded'] == false)) continue;

                    if (strtotime($this->time) <= strtotime($event['start_time'])) continue;

                    $ticks      = ($event['duration_secs']  / $this->tick);
                    $callback   = function(array $param = array()) {
                        $event          = $param['event'] ?? [];
                        if (!$event) return;

                        $cName          = $event['controller'];
                        $fName          = $event['handler'];

                        try {
                            $controller     = new $cName();
                            $result         = $controller->$fName($param);
                        } catch (Exception $e) {
                            return $e->getMessage();
                        }
                        
                        return $result;
                    };

                    $event['title'] = $title;
                    $arguments      = ['event' => $event, 'world' => $this];
                    $this->startTimedEvent($title, $ticks, $callback, $arguments, true);
                }

            }

            //Calculate the world's time
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

                $h              = (int) (($hh == 0) ? $hh = 12 : (($hh > 12) ? $hh - 12 : $hh));
                $ampm           = ($hh > 12) ? "pm" : "am";

                $this->time     = "{$hh}:{$mm}:{$ss}";
                $pack           = json_encode([
                    'date_time'     => "Day {$this->days} {$h}:{$mm} {$ampm}",
                    'time_of_day'   => $this->time,
                    'days_passed'   => $this->days,
                    '24_hour'       => $hh,
                    'hour'          => $h,
                    'minute'        => $mm,
                    'second'        => $ss,
                    'ampm'          => $ampm
                ]);

                file_put_contents("./server/runtime/tod", $pack);
            }



        /** Event Handlers **/

            //SERVER_TICK
            //Server Event Handler for server_tick event
            public function handleEventTick() {

                //Calculate the server world time
                $this->calc_server_time();                

                //Run registered world events
                $this->serve_timed_events();

                //Generate Random Events
                //$this->generate_random_events();

                //Produce timed events
                //$this->generate_timed_events();
            }

            
    }

?>