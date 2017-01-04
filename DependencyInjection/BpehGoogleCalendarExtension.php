<?php
namespace Bpeh\GoogleCalendarBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

/**
 * Class BpehGoogleCalendarExtension
 * @package Bpeh\GoogleCalendarBundle\DependencyInjection
 */
class BpehGoogleCalendarExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $config = $this->processConfiguration(new Configuration(), $configs);
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');

        if ($container->hasDefinition('bpeh.google_calendar')) {
            $definition = $container->getDefinition('bpeh.google_calendar');
            if (isset($config['google_calendar']['application_name'])) {
                $definition
                    ->addMethodCall('setApplicationName', [$config['google_calendar']['application_name']]);
            }
            if (isset($config['google_calendar']['credentials_path'])) {
                $definition
                    ->addMethodCall('setCredentialsPath', [$config['google_calendar']['credentials_path']]);
            }
            if (isset($config['google_calendar']['client_secret_path'])) {
                $definition
                    ->addMethodCall('setClientSecretPath', [$config['google_calendar']['client_secret_path']]);
            }
        }

    }
}
