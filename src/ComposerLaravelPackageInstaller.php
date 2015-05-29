<?php
namespace acacha\composer\laravelpackageinstaller;

use Composer\Composer;
use Composer\IO\IOInterface;

use Composer\Installer\LibraryInstaller;
use Composer\Package\PackageInterface;
use Composer\Repository\InstalledRepositoryInterface;
use Composer\Util\Filesystem as ComposerFilesystem;

use Illuminate\Filesystem\Filesystem as IlluminateFilesystem;

/**
 * Class ComposerLaravelPackageInstaller
 * @package acacha\composer\laravelpackageinstaller
 */
class ComposerLaravelPackageInstaller extends LibraryInstaller
{

    /**
     * @var ConfigUpdater
     */
    private $config;


    /**
     * {@inheritDoc}
     */
    public function __construct(IOInterface $io, Composer $composer, $type = 'library', ComposerFilesystem $filesystem = null)
    {
        parent::__construct($io,$composer,$type, $filesystem);

        $this->configFile = $this->$basePath . '/config/app.php';
        File does not exist at path /config/app.php
        $this->config = new ConfigUpdater(new IlluminateFilesystem, __DIR__ . "../../../..");
    }


    /**
     * {@inheritDoc}
     */
    public function install(InstalledRepositoryInterface $repo, PackageInterface $package)
    {
        $this->io->write('Executing parent install method:');
        //Install package as default
        parent::install($repo,$package);
        $this->io->write('End Executing parent install method.');

        //$this->io->write('Package: ' . var_export($package));

        //Init custom install steps
        $extra = $package->getExtra();

        $this->io->write('Name: ' . $package->getName());
        $this->io->write('Pretty Name: ' . $package->getPrettyName());

        /*$this->io->write('Packages: ');
        foreach($repo->getPackages() as $package1){
            $this->io->write('#### Pretty Name: ' . $package1->getPrettyName());
            $thisExtra = $package1->getExtra();
            $this->io->write('extra for ' . $package1->getPrettyName() . ' : ' . var_export($extra));
        }*/

        $this->io->write('extra: ' . var_export($extra));

        /*foreach($extra as $extra_value){
            $this->io->write('Extra value: ' . $extra_value);
        }*/

        if (!empty($extra['laravel-providers'])) {
            // Add laravel providers to config/app.php providers vector
            $laravel_providers = $extra['laravel-providers'];
            $this->io->write('extra laravel-providers exists:');
            $this->io->write($laravel_providers);

            if (is_array($laravel_providers)) {
                $this->io->write('laravel-providers is array');
                foreach($laravel_providers as $provider){
                    $this->io->write('Provider: ' . $provider);
                    $this->config->addProvider($provider);
                }
            } elseif (is_string($laravel_providers)) {
                $this->io->write('laravel-providers is string');
                $this->config->addProvider($laravel_providers);
            }
        } else {
            //Install all package providers <-- TODO: Reflection?
            $this->io->write('NO laravel-providers found in extra');
        }

        if (!empty($extra['laravel-aliases'])) {
            // Add laravel providers to config/app.php aliases vector
            $laravel_aliases = $extra['laravel-aliases'];
            $this->io->write('extra laravel-aliases exists');
            if (is_array($laravel_aliases)) {
                $this->io->write('laravel-aliases is array');
                foreach($laravel_aliases as $alias){
                    $this->io->write('Alias: ' . $alias);
                    $this->config->addAlias(class_basename($alias), $alias);
                }
            }
            if (is_string($laravel_aliases)) {
                $this->io->write('laravel-providers is string');
                $this->config->addAlias(class_basename($laravel_aliases), $laravel_aliases);
            }

        } else {
            //Install all package aliases <-- TODO: Reflection?
            $this->io->write('NO laravel-aliases found in extra');
        }

        $this->io->write('Installing Laravel Package ###########');
    }


    /**
     * {@inheritDoc}
     */
    public function update(InstalledRepositoryInterface $repo, PackageInterface $initial, PackageInterface $target)
    {
        $this->io->write('NEW VERSION !################ Executing parent UPDATEEEEEEEE method:');
        //Install package as default
        parent::update($repo,$initial,$target);
        $this->io->write('End Executing parent UPDATEEEEEEEE method.');

        $this->io->write('################ UPDATEEEEEEEE Laravel Package ###########');
    }


    /**
     * {@inheritDoc}
     */
    public function supports($packageType)
    {
        return 'laravel-package' === $packageType;
    }
}