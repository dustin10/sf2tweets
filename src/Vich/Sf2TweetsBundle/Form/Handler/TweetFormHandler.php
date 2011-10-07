<?php

namespace Vich\Sf2TweetsBundle\Form\Handler;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Form;
use Vich\Sf2TweetsBundle\Entity\TweetManager;

/**
 * TweetFormHandler.
 *
 * @author Dustin Dobervich <ddobervich@gmail.com>
 */
class TweetFormHandler
{
    /**
     * @var Request $request
     */
    protected $request;
    
    /**
     * @var TweetManager $manager
     */
    protected $manager;
    
    /**
     * @var Form $form
     */
    protected $form;
    
    /**
     * Constructs a new instance of TweetFormHandler.
     * 
     * @param Request $request The request.
     */
    public function __construct(Request $request, TweetManager $manager, Form $form)
    {
        $this->request = $request;
        $this->manager = $manager;
        $this->form = $form;
    }
    
    /**
     * Processes the form.
     * 
     * @return boolean True if processed successfully, false otherwise.
     */
    public function handle()
    {
        if ('POST' === $this->request->getMethod()) {
            $this->form->bindRequest($this->request);
            if ($this->form->isValid()) {
                $tweet = $this->form->getData();
                $this->manager->updateTweet($tweet);
                
                return true;
            }
        }
        
        return false;
    }
}
