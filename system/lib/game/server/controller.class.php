<?php

    namespace game\server;

    class controller {

        protected $server;
        protected $config;

        public function __construct(\extension\shell\server $server) {

            //Game Server Config
            $this->config   = new \data\json('./server/bin/argon.json');
            $this->rate     = $this->config->server->rate;


            //Server Overrides
            $this->server   = $server;
            $this->server->restTime($this->rate);


            //Hook Private/Self Tick Event
            hook('server_tick', function() {
                $this->tick();
            });


            //Create create_world_instance
             $this->world    = $this->create_world_instance();


            //Hook Tick Event to world
            hook('server_tick', function() {
                $this->world->handleEventTick();
            });


            //Raise World Started Event
            raise('game_server_started');
        }

        public function tick() {
            $this->server->console("World Time: {$this->world->days} Days {$this->world->time}");
        }

        protected function create_world_instance() : \game\server\world {
           return new \game\server\world($this->config->world, $this->server);
        }

    }

?>