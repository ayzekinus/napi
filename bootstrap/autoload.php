<?php

/*
 * @name    mubu - a simple php framework
 *
 * @author  izni burak demirtas <izniburak@gmail.com>
 *          murat koker <muratkoker@live.com>
 * 
 * @version 2.0
 */

class AutoLoad {

    private static $instance;
    private $config, $load;

    private function __construct() {
        global $config;
        $this->config = $config;
        $this->load = Load::getInstance();
        $this->helper();
        $this->library();
        $this->model();
    }

    public static function getInstance() {
        if (empty(self::$instance)) {
            self::$instance = new AutoLoad();
        }
        return self::$instance;
    }

    private function helper() {
        if (isset($this->config['autoload']['helper']))
            foreach ($this->config['autoload']['helper'] as $helper)
                $this->load->helper($helper);
    }

    private function library() {
        if (isset($this->config['autoload']['library']))
            foreach ($this->config['autoload']['library'] as $key => $library) {
                if (is_array($library))
                    $this->load->library[$key] = $this->load->library($key, $library);
                else
                if (!is_int($key))
                    $this->load->library[$key] = $this->load->library($key, $library);
                else
                    $this->load->library[$library] = $this->load->library($library);
            }
    }

    private function model() {
        if (isset($this->config['autoload']['model']))
            foreach ($this->config['autoload']['model'] as $model)
                $this->load->model[$model] = $this->load->model($model);
    }

    public function __destruct() {
        self::$instance = null;
        $this->config = $this->load = null;
    }

}
