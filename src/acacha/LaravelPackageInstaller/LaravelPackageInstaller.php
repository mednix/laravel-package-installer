<?php
/**
 * Created by Sergi Tur Badenas @2015
 * http://acacha.org/sergitur
 * http://acacha.org
 * Date: 25/05/15
 * Time: 16:59
 */

namespace Acacha\LaravelPackageInstaller;

use Composer\Installer\LibraryInstaller;
use Composer\Package\PackageInterface;
use Composer\Repository\InstalledRepositoryInterface;


class LaravelPackageInstaller extends LibraryInstaller
{

    /**
     * {@inheritDoc}
     */
    public function install(InstalledRepositoryInterface $repo, PackageInterface $package)
    {
        $this->io->write('Installing Laravel Package ###########');

    }

    /**
     * {@inheritDoc}
     */
    public function supports($packageType)
    {
        return 'laravel-package' === $packageType;
    }
}