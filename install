#!/usr/bin/env php

<?php

$dir = __DIR__;

system("touch example.php");

$handle = fopen($dir."/example.php" , 'w+');
$data =
"<?php
	
	require_once __DIR__.'/vendor/autoload.php';

	use Secure\Encrypt;

	function hashing()
	{
		return (new Encrypt());
	}


	//Example
	
	$encrypt = hashing()->encrypt('Test Encrypt','mysecretkey');
	$decrypt = hashing()->decrypt($encrypt,'mysecretkey');
	
	echo '===================================='.PHP_EOL;
	echo 'Hash: '.$encrypt.PHP_EOL;
	echo 'Original Data: '.$decrypt.PHP_EOL;
	echo '===================================='.PHP_EOL;

	//Example for base64 output

	$encrypt = hashing()->encrypt('Test Encrypt','mysecretkey',true);
	$decrypt = hashing()->decrypt($encrypt,'mysecretkey',true);
	
	echo '===================================='.PHP_EOL;
	echo 'Hash: '.$encrypt.PHP_EOL;
	echo 'Original Data: '.$decrypt.PHP_EOL;
	echo '===================================='.PHP_EOL;

?>";

fwrite($handle, $data);
fclose($handle);

echo "\033[33m successfully generate example files\n";
