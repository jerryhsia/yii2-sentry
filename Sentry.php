<?php
namespace jerryhsia\sentry;
use yii\base\Component;
use yii\base\InvalidConfigException;

class Sentry extends Component
{
    public $dsn;
    public $options = [];

    protected $_client = false;

    /**
     * @return \Raven_Client
     */
    public function getClient()
    {
        if (empty($this->dsn)) {
            throw new InvalidConfigException("dsn invalid");
        }

        if ($this->_client === false) {
            $this->_client = new \Raven_Client($this->dsn, $this->options);
        }

        return $this->_client;
    }
}
