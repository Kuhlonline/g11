<?php

    namespace extension\shell;

    class server {

        const PATH          = "./server/runtime/server.run";

        protected $log              = null;
        protected $running          = false;
        protected $restingLength    = 1000000;

        public $startTime           = 0;
        public $stopTime            = 0;
        public $lastRuntime         = 0;
        public $lastIteration       = 0;
        public $runtimeCorrection   = 0;
        public $estIterations       = 0;
        public $actIterations       = 0;
        public $runTime             = 0;
        public $id;

        public function __construct() {
            global $is_server;
            $is_server  = true;

            $this->id   = uniqid();
            $ext        = new \core\extension('extension\logger', 'server');
            $this->log  = $ext->object();

            $this->start();
        }

        public function start() {
            $this->running      = true;
            $this->startTime    = microtime(true);

            if (!file_put_contents($this::PATH, $this->startTime)) {
                $this->logItem("Error: Could not start server at " . $this::PATH);
                return;
            }

            return $this->init();
        }

        public function stop(string $reason) {
            $this->console("Stopping Server. User provided reason: {$reason}");
            $this->running      = false;
            $this->stopTime     = microtime(true);
            $this->runTime      = ($this->stopTime - $this->startTime);
        }

        public function restTime(int $restTime = 0) : int {
            if ($restTime !== 0) {
                $this->restingLength    = $restTime;
            }

            return $this->restingLength;
        }

        public function logItem(string $msg) : bool {            
            return $this->log->record($msg);
        }

        public function console(string $msg, $skipLog = true) {
            print "{$msg}\n";

            if ($skipLog == false) $this->logItem($msg);
        }

        private function init() : bool {
            global $config;

            //Server Bootscript
            $this->console("Booting Server...");
            $bootScript     = include("./server/bin/boot.php");
            

            //Raise Start Event
            $this->console("Server Started");
            raise('server_started');


            //Start Runtime
            while ($this->running) {

                //Runtime Iteration Correction
                //Precise to 10/100 of 1 second
                $this->runtimeCorrection    = ($this->lastRuntime > 0) 
                    ? (($this->lastIteration - 1) * 1)
                    : 0
                ;

                //Let the CPU rest
                $downTime   = ($this->restingLength - $this->runtimeCorrection);
                if (!$downTime or ($downTime < 1)) $downTime = $this->restingLength;
                usleep($downTime);


                //Calculate runtime stats
                $tmp                        = $this->lastRuntime;
                $this->lastRuntime          = microtime(true);
                $this->lastIteration        = ($this->lastRuntime - $tmp);
                $this->runTime              = ($this->lastRuntime - $this->startTime);
                $this->estIterations        = round($this->runTime);
                $this->actIterations++;


                //If terminated while asleep, exit before processing anything
                if ($this->running == false) break;


                //Raise the Server Tick Event
                raise('server_tick', ['extension'=>$this]);
            }

            $this->console("Server Stopped");
            raise('server_stopped');
            return $this->deinit();
        }

        private function deinit() : bool {
            return unlink($this::PATH);
        }

    }

?>