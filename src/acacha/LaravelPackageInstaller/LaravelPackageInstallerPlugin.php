<?php
/**
 * Created by Sergi Tur Badenas @2015
 * http://acacha.org/sergitur
 * http://acacha.org
 * Date: 25/05/15
 * Time: 16:56
 */

namespace Acacha\LaravelPackageInstaller;

use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;

class LaravelPackageInstallerPlugin implements PluginInterface
{
    public function activate(Composer $composer, IOInterface $io)
    {
        $installer = new LaravelPackageInstaller($io, $composer);
        $composer->getInstallationManager()->addInstaller($installer);
    }
}