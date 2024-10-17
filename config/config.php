<?php 
define('URL',  'http://localhost/php/citas_php/public/'); 
  
define('ROOT', 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);

 
define('VIEW', str_replace('/public', '', ROOT).'app/views/');
 
function back() {
    return new class {
        public function with($key, $value) {
            setcookie($key, $value, time() + 5, "/");
            return $this; 
        }
        public function redirect() {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        }
    };
}

