<?php

namespace Vich\Sf2TweetsBundle\DependencyInjection;

use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\Config\FileLocator;
use Vich\Sf2TweetsBundle\DependencyInjection\Configuration;

/**
 * VichSf2TweetsExtension.
 *
 * @author Dustin Dobervich <ddobervich@gmail.com>
 */
class VichSf2TweetsExtension extends Extension
{
    /**
     * Loads the extension.
     * 
     * @param array $configs The configuration
     * @param ContainerBuilder $container The container builder
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        
        $config = $this->processConfiguration($configuration, $configs);
        
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        
        $toLoad = array('map.xml', 'tweet.xml', 'form.xml', 'listener.xml');
        foreach ($toLoad as $file) {
            $loader->load($file);
        }
        
        $container->setParameter('vich_sf2tweets.tweet_keepalive_days', $config['tweet_keepalive_days']);
    }
}
