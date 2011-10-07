<?php

namespace Vich\Sf2TweetsBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Configuration.
 *
 * @author Dustin Dobervich <ddobervich@gmail.com>
 */
class Configuration implements ConfigurationInterface
{
    /**
     * Gets the configuration tree builder for the extension.
     * 
     * @return TreeBuilder The configuration tree builder
     */
    public function getConfigTreeBuilder()
    {
        $tb = new TreeBuilder();
        $root = $tb->root('vich_sf2tweets');
        
        $root
            ->children()
                ->scalarNode('tweet_keepalive_days')->cannotBeEmpty()->defaultValue(2)->end()
            ->end()
        ;
        
        return $tb;
    }
}
