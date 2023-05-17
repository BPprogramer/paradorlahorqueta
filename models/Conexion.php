

<?php 

  


   class Conexion{
        public static function conectarDB(){
            if(!isset($_ENV)){
		
                require __DIR__.'../vendor/autoload.php';
                $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
                $dotenv->safeLoad();
             
                $link = new PDO('mysql:host='.$_ENV['DB_HOST'].';dbname='.$_ENV['DB_BD'].'', $_ENV['DB_USER'], $_ENV['DB_PASS']);
                $link->exec("set names utf8");
                return $link;
                
            }else if(empty($_ENV)){
                if(file_exists('../vendor/autoload.php')){
                    require_once '../vendor/autoload.php';
                    $dotenv = Dotenv\Dotenv::createImmutable('../');
                    $dotenv->safeLoad();
                    
                    $link = new PDO('mysql:host='.$_ENV['DB_HOST'].';dbname='.$_ENV['DB_BD'].'', $_ENV['DB_USER'], $_ENV['DB_PASS']);
                    $link->exec("set names utf8");
                    return $link;
                }
                if(file_exists('../../vendor/autoload.php')){
                    require_once '../../vendor/autoload.php';
                    $dotenv = Dotenv\Dotenv::createImmutable('../../');
                    $dotenv->safeLoad();
                    
                    $link = new PDO('mysql:host='.$_ENV['DB_HOST'].';dbname='.$_ENV['DB_BD'].'', $_ENV['DB_USER'], $_ENV['DB_PASS']);
                    $link->exec("set names utf8");
                    return $link;
                }
                if(file_exists('../../../vendor/autoload.php')){
                    require_once '../../../vendor/autoload.php';
                    $dotenv = Dotenv\Dotenv::createImmutable('../../../');
                    $dotenv->safeLoad();
                    
                    $link = new PDO('mysql:host='.$_ENV['DB_HOST'].';dbname='.$_ENV['DB_BD'].'', $_ENV['DB_USER'], $_ENV['DB_PASS']);
                    $link->exec("set names utf8");
                    return $link;
                }


            
               

              
            }else{
              
                $link = new PDO('mysql:host='.$_ENV['DB_HOST'].';dbname='.$_ENV['DB_BD'].'', $_ENV['DB_USER'], $_ENV['DB_PASS']);
                $link->exec("set names utf8");
                return $link;
       
            }
     /* 
            $link = new PDO('mysql:host=localhost;dbname=horqueta', 'root', '');
            $link->exec("set names utf8");
            return $link; */
  
        }
   }