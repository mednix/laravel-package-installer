<?php
namespace acacha\composer\laravelpackageinstaller;

use Composer\Installer\LibraryInstaller;
use Composer\Package\PackageInterface;
use Composer\Repository\InstalledRepositoryInterface;

use Acacha\LaravelUtils\ConfigUpdater;

class ComposerLaravelPackageInstaller extends LibraryInstaller
{
    /**
     * Object that patches configs.
     *
     * @var ConfigUpdater
     */
    private $config;

    /**
     * @param Client           $packagist
     * @param SpecialsResolver $resolver
     * @param ConfigUpdater    $config
     */

    public function __construct()
    {
        //$this->config = $config;
    }


    /**
     * {@inheritDoc}
     */
    public function install(InstalledRepositoryInterface $repo, PackageInterface $package)
    {
        $extra = $package->getExtra();

        if (!empty($extra['laravel-providers'])) {
            // Add laravel providers to config/app.php providers vector
            $laravel_providers = $extra['laravel-providers'];
            $this->io->write('extra laravel-providers exists:');
            $this->io->write($laravel_providers);

            if (is_array($laravel_providers)) {
                $this->io->write('laravel-providers is array');
            }
            if (is_string($laravel_providers)) {
                $this->io->write('laravel-providers is string');
            }
        } else {
            //Install all package providers <-- TODO: Reflection?
            $this->io->write('NO laravel-providers found in extra');
        }

        if (!empty($extra['laravel-aliases'])) {
            // Add laravel providers to config/app.php aliases vector
            $this->io->write('extra laravel-aliases exists');

        } else {
            //Install all package aliases <-- TODO: Reflection?
            $this->io->write('NO laravel-aliases found in extra');
        }

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