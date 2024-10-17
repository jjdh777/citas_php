<?php 
class Template
{   
    protected $layout = '';
    protected $sections = [];
    
    public function layout($param)
    {  
        $this->layout = $param; 
    }
    
    public function section($name, $default = '')
    {
        return $this->sections[$name] ?? $default;
    }
    
    public function start($name)
    {
        ob_start();
        $this->sections[$name] = '';
    }
    
    public function stop($name)
    {
        $this->sections[$name] = ob_get_clean();
    }
    
    public function render($template, $data = [])
    {   
        $this->view($template, $data); 
        $this->sections['content'] = $this->section('content'); 
        return $this->view($this->layout, $this->sections);
    }
    
    public function view($template, $data = [])
    {     
        $dir =  '../app/views/' . $template . '.php';  
        extract($data);
        require_once $dir;
    }  
}
