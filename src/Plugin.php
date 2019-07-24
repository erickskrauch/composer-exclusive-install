<?php
declare(strict_types=1);

namespace ErickSkrauch\Composer\ExclusiveInstall;

use Composer\Composer;
use Composer\EventDispatcher\EventSubscriberInterface;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;
use Composer\Script\Event;
use Composer\Script\ScriptEvents;
use Composer\Util\Filesystem;
use Symfony\Component\Lock\Factory;
use Symfony\Component\Lock\LockInterface;
use Symfony\Component\Lock\Store\FlockStore;

class Plugin implements PluginInterface, EventSubscriberInterface {

    /**
     * @var string
     */
    private $lockDir;

    public static function getSubscribedEvents(): array {
        return [
            ScriptEvents::PRE_INSTALL_CMD => 'onPreInstall',
            ScriptEvents::PRE_UPDATE_CMD => 'onPreInstall',
        ];
    }

    public function activate(Composer $composer, IOInterface $io): void {
        $this->lockDir = $composer->getConfig()->get('vendor-dir');

        $filesystem = new Filesystem();
        $filesystem->ensureDirectoryExists($this->lockDir);
    }

    public function onPreInstall(Event $event): void {
        $lock = $this->createLock();
        $hasBeenAcquired = $lock->acquire();
        if (!$hasBeenAcquired) {
            $event->getIO()->write("<comment>Lock is already acquired by another process. Waiting until it'll be released.</comment>");
            $lock->acquire(true);
        }
    }

    private function createLock(): LockInterface {
        $store = new FlockStore($this->lockDir);
        $factory = new Factory($store);

        return $factory->createLock('composer-exclusive-lock');
    }

}
