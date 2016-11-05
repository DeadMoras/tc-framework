<?php

namespace framework\view;

trait View
{
    /**
     *
     * @var array
     */
    private $forView;

    /**
     *
     * @var string
     */
    private $errors;

    /**
     *
     * @var string
     */
    private $dir = 'view/';

    /**
     *
     * @var object
     */
    private $smarty;

    public function view($name, $object = false)
    {
        if ($object != false) {
            $this->forView = $object;
        }
        if (strpos($name, '.') !== false) {
            $name = str_replace('.', '/', $name);
            $this->loadMany($name);
        } else {
            $this->loadOne($name);
        }
    }

    public function loadMany($name)
    {
        if ($this->fileThere($name) == true) {
            $this->getExtract();
            $this->smarty()->display($this->dir . $name . '.tpl');
        } else {
            echo $this->errors;
        }
    }

    public function loadOne($name)
    {
        if ($this->fileThere($name) == true) {
            $this->getExtract();
            $this->smarty()->display($this->dir . $name . '.tpl');
        } else {
            echo $this->errors;
        }
    }

    public function fileThere($name)
    {
        if (file_exists($this->dir . $name . '.tpl')) {
            return true;
        } else {
            $this->errors = 'Файл ' . $name . '.tpl не найден';
        }
    }

    private function smarty()
    {
        if ($this->smarty == null) {
            $this->smarty = new \Smarty();
        }
        return $this->smarty;
    }

    private function getExtract()
    {
        if (!empty($this->forView) && \is_array($this->forView)) {
            return $this->smarty()->assign(implode(array_keys($this->forView)), implode(array_values($this->forView)));
        } else {
            return false;
        }
    }
}
