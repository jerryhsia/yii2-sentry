<?php
require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/../vendor/yiisoft/yii2/Yii.php';

use jerryhsia\sentry\Sentry;
use PHPUnit\Framework\TestCase;
use yii\base\ErrorException;

class SentryTest extends TestCase
{
    /**
     * @return Sentry
     */
    protected function getSentry()
    {
        $config = include __DIR__.'/config.php';
        $config['class'] = Sentry::className();

        /**
         * @var $sentry Sentry
         */
        $sentry = \Yii::createObject($config);

        return $sentry;
    }

    public function testMessage()
    {
        $message = sprintf('[%s] Hello Jerry', date('Y-m-d H:i:s'));
        $this->getSentry()->getClient()->captureMessage($message);
    }

    public function testException()
    {
        $message = sprintf('[%s] Exception from Jerry', date('Y-m-d H:i:s'));
        $exception = new ErrorException($message);
        $this->getSentry()->getClient()->captureException($exception);
    }
}
