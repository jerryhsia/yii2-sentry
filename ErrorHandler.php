<?php
namespace jerryhsia\sentry;

use yii\web\Application;

class ErrorHandler extends \yii\web\ErrorHandler
{
    public $sentryName = 'sentry';
    public $enable = true;

    public function renderException($exception)
    {
        $this->send($exception);
        if (\Yii::$app instanceof Application) {
            parent::renderException($exception);
        } else {
            $this->renderConsole($exception);
        }
    }

    protected function send($exception)
    {
        if (!$this->enable) {
            return false;
        }

        /**
         * @var $sentry Sentry
         */
        $sentry = \Yii::$app->get($this->sentryName);
        if ($sentry && $sentry instanceof Sentry) {
            $sentry->getClient()->captureException($exception);
        }

        return true;
    }

    /**
     * @param \Exception $exception
     */
    protected function renderConsole($exception)
    {
        echo get_class($exception).':'.$exception->getMessage();
        echo "\n\n";
        echo $exception->getTraceAsString();
    }
}
