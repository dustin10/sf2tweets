<?php

namespace Vich\Sf2TweetsBundle\Model;

use Vich\Sf2TweetsBundle\Entity\Tweet;

/**
 * TweetManagerInterface.
 *
 * @author Dustin Dobervich <ddobervich@gmail.com>
 */
interface TweetManagerInterface
{
    /**
     * Finds the tweets to display.
     * 
     * @return Collection The tweets.
     */
    function findCurrentTweets();
    
    /**
     * Finds tweets ready to be removed.
     * 
     * @return Collection The old tweets.
     */
    function findOldTweets();
    
    /**
     * Updates a tweet.
     * 
     * @param Tweet $tweet The tweet.
     * @param boolean $andFlush True if the EntityManager should be flushed.
     */
    function updateTweet(Tweet $tweet, $andFlush = true);
}
