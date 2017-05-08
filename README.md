# Php secure assymetric encryption

## Install the Application

### Composer
Run `composer require ariffazmi/secure-encrypt:"1.1"`

# How To Use

    require_once __DIR__."/vendor/autoload.php";
    
    use Secure\Encrypt;
    
    function myhash(){
    
       return (new Encrypt());
    }
    
    //Encrypt
    $encrypt_data = myhash()->encrypt("your data","mysecretkey");
    $decrypt_data = myhash()->decrypt($encrypt,"mysecretkey");
    
    //Encrypt (return value with base64)
    $encrypt_data = myhash()->encrypt("your data","mysecretkey",true);
    $decrypt_data = myhash()->decrypt($encrypt,"mysecretkey",true);
    
Or

You can skip the above by doing this:
    
    `composer create-project ariffazmi/secure-encrypt:"1.1"`
    
After successfull install, run this command : `composer run-script make-example`.
You will have example.php file in your project directory.
