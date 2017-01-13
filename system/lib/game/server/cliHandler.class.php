<?php

    namespace game\server;

    final class cliHandler {


        /** Contruct **/
            private $world;

            public function __construct(\game\server\world &$world) {
                $this->world = $world;
            }



        /** CLI Functions **/

            //Hello World
            public function cli_hello() {

                $load   = explode("load ", `uptime`, 2);
                $avg    = trim(str_replace("average:", null, $load[1]));
                $parts  = explode(", ", $load[0]);
                $time   = explode(' ', trim($parts[0]) .' '. trim($parts[1]), 2);

                return 
                    str_pad("Game World Name:", 40) . "{$this->world->name}\n".
                    str_pad("Game World Time: ", 40) . "{$this->world->days} Days {$this->world->time}\n".
                    str_pad("Game World Memory:", 40) . 
                        number_format((memory_get_usage(true) / 1024) / 1024, 2) . "MB / ".
                        number_format((memory_get_peak_usage(true) / 1024) / 1024, 2) . "MB\n".
                    str_pad("Server Load AVG: ", 40) . "{$avg}\n".
                    str_pad("Server Time: ", 40) . "{$time[0]}\n".
                    str_pad("Server Uptime: ", 40) . "{$time[1]}\n"
                ;
            }


            //Create World
            public function cli_generate_world() {
                $this->world->generateWorld();
                return "Started generating world of {$this->world->name}";
            }

            //Destroy World
            public function cli_i_know_i_am_about_to_truncate_my_world() {
                $this->world->truncate();
                return "World Destroyed";
            }

    }

?>