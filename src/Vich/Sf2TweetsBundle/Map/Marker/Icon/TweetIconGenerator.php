<?php

namespace Vich\Sf2TweetsBundle\Map\Marker\Icon;

use Vich\GeographicalBundle\Map\Marker\Icon\IconGeneratorInterface;

/**
 * TweetIconGenerator.
 *
 * @author Dustin Dobervich <ddobervich@gmail.com>
 */
class TweetIconGenerator implements IconGeneratorInterface
{
    /**
     * {@inheritDoc}
     */
    public function generateIcon($obj)
    {
        return '/bundles/vichsf2tweets/images/map-icon.png';
    }
}
