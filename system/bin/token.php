<?php

	$email 	= $_SERVER['argv'][1] ?? false;
	$pass 	= $_SERVER['argv'][2] ?? false;
	if (!$email) exit("No Email\n");

	$token 	= hash('md5', "{$email}{$pass}");

	print "Token for {$email}:\n";
	print $token;
	print "\n";


?>
