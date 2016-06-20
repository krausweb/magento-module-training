<?php

/**
 * Created by Alexandr Krivonos
 * Email: krausweb291985@gmail.com
 * Date: 3/28/16
 * Time: 5:29 PM
 */
class AKS_Training_ShellController
{
    protected $_args        = array();

    public function __construct()
    {
        $this->_parseArgs();
    }

    /**
     * Parse input arguments
     *
     * @return Mage_Shell_Abstract
     */
    protected function _parseArgs()
    {
        $current = null;
        foreach ($_SERVER['argv'] as $arg) {
            $match = array();
            if (preg_match('#^--([\w\d_-]{1,})$#', $arg, $match) || preg_match('#^-([\w\d_]{1,})$#', $arg, $match)) {
                $current = $match[1];
                $this->_args[$current] = true;
            } else {
                if ($current) {
                    $this->_args[$current] = $arg;
                } else if (preg_match('#^([\w\d_]{1,})$#', $arg, $match)) {
                    $this->_args[$match[1]] = true;
                }
            }
        }
        return $this;
    }

    /**
     * Retrieve argument value by name or false
     *
     * @param string $name the argument name
     * @return mixed
     */
    public function getArg($name)
    {
        if (isset($this->_args[$name])) {
            return $this->_args[$name];
        }
        return false;
    }

    /**
     * Run script
     *
     * for initialisation new shell methods - add new "elseif"
     */
    public function run()
    {
        $_SESSION = array();
        if ($this->getArg('info') or $this->getArg('help')) {
            echo $this->help();
        }elseif($this->getArg('infoParams')) {
            echo $this->infoParams();
        }else{
            echo $this->help();
        }
    }



    /** ************************* My Development Function ***********************************/



    public function help()
    {
        return <<<USAGE
Usage:  php YOU_PATH/ShellController.php [options]

  alex                      Show Test info
  info or help              Show all info

  <indexer>     Comma separated indexer codes or value "all" for all indexers

USAGE;
    }

    /**
     * Return all terminal command params (key --- 1/true OR key --- val)
     * @return string
     */
    public function infoParams()
    {
        foreach($this->_args as $arg_key=>$arg_val){
            echo <<<USAGE
    $arg_key --- $arg_val

USAGE;
        }
    }
}

$shell = new AKS_Training_ShellController();
$shell->run();