<?php

namespace Vich\Sf2TweetsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations\View;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Vich\Sf2TweetsBundle\Entity\Tweet;

/**
 * TweetController.
 *
 * @author Dustin Dobervich <ddobervich@gmail.com>
 */
class TweetController extends Controller
{
    /**
     * The get tweets action.
     * 
     * @View
     */
    public function getTweetsAction()
    {
        $manager = $this->get('vich_sf2tweets.tweet_manager');
        $tweets = $manager->findCurrentTweets();
 
        return array('tweets' => $tweets);
    }
    
    /**
     * The post tweets action.
     * 
     * @View
     * @Secure(roles="ROLE_USER")
     */
    public function postTweetsAction()
    {
        $handler = $this->get('vich_sf2tweets.form.handler.tweet');
        
        $success = $handler->handle();
        if ($success) {
            return array('tweet' => $handler->getTweet());
        }
        
        return array('form' => $handler->getForm());
    }
}