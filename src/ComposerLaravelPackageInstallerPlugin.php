<?php
namespace acacha\composer\laravelpackageinstaller;
use Composer\Plugin\PluginInterface;
use Composer\IO\IOInterface;
use Composer\Composer;
class ComposerLaravelPackageInstallerPlugin implements PluginInterface {

    public function activate(Composer $composer, IOInterface $io) {
        $installer = new ComposerLaravelPackageInstaller($io, $composer);
        $composer->getInstallationManager()->addInstaller($installer);
    }
}