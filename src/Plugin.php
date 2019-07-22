<?php
declare(strict_types=1);

namespace ErickSkrauch\Composer\ExclusiveInstall;

use Composer\Composer;
use Composer\EventDispatcher\EventSubscriberInterface;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;
use Composer\Script\ScriptEvents;

class Plugin implements PluginInterface, EventSubscriberInterface {

    public function activate(Composer $composer, IOInterface $io): void {
        // Leave empty
        // TODO: add ability to ignore exclusive option
    }

    /**
     * Returns an array of event names this subscriber wants to listen to.
     *
     * The array keys are event names and the value can be:
     *
     * * The method name to call (priority defaults to 0)
     * * An array composed of the method name to call and the priority
     * * An array of arrays composed of the method names to call and respective
     *   priorities, or 0 if unset
     *
     * For instance:
     *
     * * array('eventName' => 'methodName')
     * * array('eventName' => array('methodName', $priority))
     * * array('eventName' => array(array('methodName1', $priority), array('methodName2'))
     *
     * @return array The event names to listen to
     */
    public static function getSubscribedEvents(): array {
        return [
            ScriptEvents::PRE_INSTALL_CMD => 'onPreInstall',
            ScriptEvents::PRE_UPDATE_CMD => 'onPreInstall',
        ];
    }

    public function onPreInstall($event) {

    }

}
