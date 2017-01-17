<?php

    namespace game;

    class player {

        protected $character    = null;

        private function new(string $email, string $password, string $jobName = '') : int {

            $worldSize  = $this->config->world->size;
            $rndX       = rand(1, $worldSize);
            $rndY       = rand(1, $worldSize);
            $job        = $this->job($jobName);

            if ($job) $job = $this->job('fighter');

            $email      = trim(strtolower($email));
            $token      = hash('md5', sha1($email) . sha1($password));

            $newChar    = [
                'name'      => $this->characterName,
                'email'     => $email,
                'token'     => $token,                      
                'x'         => $rndX,
                'y'         => $rndY,
                'max_hp'    => $job->hp,
                'cur_hp'    => $job->hp,
                'max_ap'    => $job->ap,
                'cur_ap'    => $job->ap,
                'xp'        => 0,
                'level'     => 1,
                'job'       => $job->id,
                'stats'     => json_encode([
                    'str'   => $job->str,
                    'end'   => $job->end,
                    'agi'   => $job->agi,
                    'int'   => $job->int
                ]),
                'skills'    => json_encode([
                    'melee'     => $job->skills->melee,
                    'magic'     => $job->skills->magic,
                    'ranged'    => $job->skills->ranged,
                    'healing'   => $job->skills->healing
                ]),
                'inventory' => json_encode([
                    'tools'     => [
                        'left'  => '',
                        'right' => ''
                    ],
                    'backpack'  => [
                    ],
                    'armor'     => [
                        'head'  => '',
                        'feet'  => '',
                        'arms'  => '',
                        'legs'  => '',
                        'chest' => ''
                    ]
                ])
            ];

            return $this->database->commit($newChar);
        }

        private function job(string $jobName) {
            return $this->config->job->$jobName ?? false;
        }

        public function api_createNewPlayer() {

        }


    }