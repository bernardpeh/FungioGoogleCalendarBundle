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
            if (isset($config['application_name'])) {
                $definition
                    ->addMethodCall('setApplicationName', [$config['application_name']]);
            }
            if (isset($config['credentials_path'])) {
                $definition
                    ->addMethodCall('setCredentialsPath', [$config['credentials_path']]);
            }
            if (isset($config['google_calendar']['client_secret_path'])) {
                $definition
                    ->addMethodCall('setClientSecretPath', [$config['client_secret_path']]);
            }
        }

    }
}
