<?php

namespace Vich\Sf2TweetsBundle\Map;

use Vich\GeographicalBundle\Map\Map;

/**
 * TweetMap.
 *
 * @author Dustin Dobervich <ddobervich@gmail.com>
 */
class TweetMap extends Map
{
    /**
     * Constructs a new instance of TweetMap.
     */
    public function __construct()
    {
        parent::__construct();
        
        $this->setWidth('100%');
        $this->setHeight('100%');
        $this->setShowZoomControl(true);
        $this->setShowInfoWindowsForMarkers(true);
        $this->setVarName('tweetMap');
    }
}
