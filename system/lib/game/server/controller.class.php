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
            hook('server_tick', function(array $param = array()) {
                $this->tick($param);
            });


            //Create create_world_instance
             $this->world    = $this->create_world_instance();


            //Hook Tick Event to world
            hook('server_tick', function(array $param = array()) {
                $this->world->handleEventTick($param);
            });


            //Raise World Started Event
            raise('game_server_started');
        }

        public function tick(array $param = array()) {

            //debug
            //$this->server->console("World Time: {$this->world->days} Days {$this->world->time}");
            $ext    = $param['extension'] ?? null;

            //Checkfor and execute and external commands from CLI
            $this->execute_runtime_input($ext);


        }

        protected function create_world_instance() : \game\server\world {
           return new \game\server\world($this->config->world, $this->server);
        }

        protected function execute_runtime_input($extension = null) {
            
            $runtime    = "./server/runtime";
            $ls         = scandir($runtime);

            foreach ($ls as $item) {
                usleep(1);
                if ($item == '.' or $item == '..') continue;

                $location = "{$runtime}/{$item}";
                if (is_dir($location)) continue;

                $parts  = explode('.', $item);
                $ext    = $parts[count($parts)-1];
                if ($ext !== 'stdin') continue;

                $stdIn  = trim(file_get_contents($location));

                try {unlink($location);} catch (Exception $e) {}
                if (!$stdIn) continue;

                $stdOut     = '';
                $success    = $this->process_stdIn($stdIn, $stdOut, $extension);
                $location   = str_replace(".stdin", ".stdout", $location);

                $stdOut     = ($success) ? $stdOut : "ERROR: {$stdOut}";
                $bytes      = file_put_contents($location, $stdOut);
            }

        }

        protected function process_stdIn(string $stdIn, string &$stdOut = null, $extension = null) : bool {

            if (!$this->world) {
                $stdOut     = 'World does not exist';
                return false;
            }
        
            $parts  = explode(' ', $stdIn);
            $cmd    = 'cli_' . strtolower(trim($parts[0]));
            unset($parts[0]);

            switch ($cmd) {

                case 'cli_server_shutdown':
                case 'cli_server_quit':
                case 'cli_shutdown_server':
                    $extension->stop("CLI User requested shutdown");
                    $stdOut     = "Server is shutting down";
                    return true;
                break;

            }

            if (!method_exists($this->world, $cmd)) {
                $cmdName    = str_replace("cli_", null, $cmd);
                $stdOut     = "{$cmdName} Not available";
                return false;
            }

            $args   = (count($parts) > 0) ? array_values(array_filter($parts)) : [];
            $param  = [];

            foreach ($args as $index => $arg) {
                $parts          = explode('=', $arg, 2);
                $key            = (count($parts) > 1) ? $parts[0] : $index;
                $val            = (count($parts) > 1) ? $parts[1] : $arg;
                $param[$key]    = $val;
            }

            $result     = call_user_func_array([$this->world, $cmd], $param);

            if ($result === false) {
                $stdOut = "Error executing {$cmd}";
                return false;
            }

            if (is_object($result) or is_array($result)) $result = print_r($result, true);

            $stdOut     = "{$result}";
            return true;
        }

    }

?>