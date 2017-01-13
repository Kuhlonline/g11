<?php

    namespace extension\shell;

    final class cli {

        private $running    = false;

        public function __construct() {
            $this->running  = true;
            $this->init();
        }

        private function init() {

            $this->send("Hello!");
            $quitList   = [
                'quit',
                'exit',
                'done'
            ];

            while ($this->running) {
                $stdIn  = readline($this->prompt(true));
                $cmd    = trim(strtolower($stdIn));
                
                if (in_array($cmd, $quitList)) {
                    $this->running  = false;
                    continue;
                }

                //$this->send("Sending request to server. Please Wait.");
                $this->send(str_repeat("-", 60));
                $response   = $this->execute_command($cmd);
                $this->send($response);
                $this->send(str_repeat("-", 60));

            }

            $this->send("Goodbye!");

        }

        private function exit() {
            $this->running  = false;
        }

        private function send(string $msg, bool $skipNewline = false) {
            print "{$msg}";
            if (!$skipNewline) print "\n";
        }

        private function prompt(bool $returnOnly = false) {
            global $config;

            $title      = $config->application->title;
            $ver        = $config->application->shellVersion;

            $prompt     = "({$title} v{$ver}) $ ";

            if (!$returnOnly) print ($prompt);

            return $prompt;
        }

        private function execute_command(string $stdIn) {
            $folder     = "./server/runtime";
            $uid        = md5(uniqid(time()));
            $location   = "{$folder}/{$uid}.stdin";

            $bytes      = file_put_contents($location, $stdIn);
            $timeout    = 5000;
            $running    = true;
            $i          = 0;
            $resp       = '';

            while ($running) {
                usleep(1000);
                $i++;
                //$this->send('.', true);

                if ($i >= $timeout) {
                    $running = false;
                    $this->send("Done Waiting. Revoking request.");

                    try {
                        if (file_exists($location)) unlink($location);
                    } catch (Exception $e) {}

                    continue;
                }

                $rFile  = "{$folder}/{$uid}.stdout";
                if (!file_exists($rFile)) continue;

                $resp   = trim(file_get_contents($rFile));

                try {
                    if (file_exists($rFile)) unlink($rFile); 
                } catch (Exception $e) {}
                

                if (!$resp) {
                    $running = false;
                    continue;
                }

                return $resp;
            }

            return "No Response";
        }

    }

?>