<?php
namespace acacha\composer\laravelpackageinstaller;
use Composer\Plugin\PluginInterface;
use Composer\IO\IOInterface;
use Composer\Composer;
class ComposerLaravelPackageInstallerPlugin implements PluginInterface {

    public function activate(Composer $composer, IOInterface $io) {
        $io->write('111 Activating ComposerLaravelPackageInstallerPlugin ###########');
        $installer = new ComposerLaravelPackageInstaller($io, $composer);
        $composer->getInstallationManager()->addInstaller($installer);
    }
}