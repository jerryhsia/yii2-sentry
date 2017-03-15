<?php
namespace jerryhsia\sentry;

use yii\web\Application;

class ErrorHandler extends \yii\web\ErrorHandler
{
    public $sentryName = 'sentry';

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
        /**
         * @var $sentry Sentry
         */
        $sentry = \Yii::$app->get($this->sentryName);
        if ($sentry && $sentry instanceof Sentry) {
            $sentry->getClient()->captureException($exception);
        }
    }

    /**
     * @param \Exception $exception
     */
    protected function renderConsole($exception)
    {
        echo $exception->getMessage();
        echo "\n";
        echo $exception->getTraceAsString();
    }
}
