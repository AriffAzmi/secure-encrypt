<?php

namespace Secure;

/**
*  Simple Asymmetric Encryption Class
*  @author  Ariff Azmi <ariff.azmi16@gmail.com>
*  @version 1.0
*/
class Encrypt
{
	const METHOD = 'aes-256-ctr';
    protected $iv;
    public $output;

    function __construct()
    {
        $this->setIv(mcrypt_create_iv(16, MCRYPT_RAND));
    }

    /**
     * 
     * @param string $data - plaintext data
     * @param string $key - encryption key (raw binary expected)
     * @param boolean $encode - set to TRUE to return a base64-encoded 
     * @return string (raw binary)
     */
    public static function encrypt($data, $key, $encode = false)
    {
        $iv = mcrypt_create_iv(16, MCRYPT_RAND);
        $encryptedText = openssl_encrypt($data,self::METHOD,$key, 0, $this->getIv());

        if ($encode) {
            return base64_encode($encryptedText);
        }

        $this->setOutput($encryptedText);

        return $this->getOutput();
    }
    
    /**
     * 
     * @param string $data - ciphertext data
     * @param string $key - encryption key (raw binary expected)
     * @param boolean $encoded - are we expecting an encoded string?
     * @return string
     */
    public static function decrypt($data, $key, $encoded = false)
    {
        if ($encoded) {
            $data = base64_decode($data, true);
            if ($data === false) {
                throw new Exception('Encryption failure');
            }
        }

        $decryptedText = openssl_decrypt($data, self::METHOD, $key, 0, $this->getIv());

        $this->setOutput($decryptedText);

        return $this->getOutput();
    }
	
	public static function makeExample(){
	
		echo "\n==================================\n";
		echo "GENERATE EXAMPLE FILE (example.php)\n\n";
		echo "Check the example.php file on your project directory";
		echo "\n==================================\n\n";

		if (file_exists(realpath(dirname(__FILE__)."../")."example.php")) {

		    echo "File example.php already exist in your project directory\n";
		}
		else{

		    $handle = fopen(realpath(dirname(__FILE__)."../")."example.php" , 'w+');
		    $data =
		    "<?php

			require_once __DIR__.'/vendor/autoload.php';
			use Secure\Encrypt;

			function hashing()
			{
			    return (new Encrypt());
			}

			//Basic Example
			echo '===================================='.PHP_EOL;
			echo hashing()->encrypt('Test Encrypt','mysecretkey').PHP_EOL;
			echo hashing()->decrypt(hashing()->encrypt('Test Encrypt','mysecretkey'),'mysecretkey').PHP_EOL;
			echo '===================================='.PHP_EOL;

			//Example for base64 output
			echo '===================================='.PHP_EOL;
			echo hashing()->encrypt('Test Encrypt','mysecretkey',true).PHP_EOL;
			echo hashing()->decrypt(hashing()->encrypt('Test Encrypt','mysecretkey',true),'mysecretkey',true).PHP_EOL;
			echo '===================================='.PHP_EOL;
		    ?>";
		    fwrite($handle, $data);
		    fclose($handle);
		    echo "Successfully generate example files\n";
		}
    	}

    /**
     * Gets the value of iv.
     *
     * @return mixed
     */
    public function getIv()
    {
        return $this->iv;
    }

    /**
     * Sets the value of iv.
     *
     * @param mixed $iv the iv
     *
     * @return self
     */
    protected function setIv($iv)
    {
        $this->iv = $iv;

        return $this;
    }

    /**
     * Gets the value of output.
     *
     * @return mixed
     */
    public function getOutput()
    {
        return $this->output;
    }

    /**
     * Sets the value of output.
     *
     * @param mixed $output the output
     *
     * @return self
     */
    public function setOutput($output)
    {
        $this->output = $output;

        return $this;
    }
}
