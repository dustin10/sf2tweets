<?php

namespace Vich\Sf2TweetsBundle\EventListener;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Vich\TweetFormatterBundle\Formatter\TweetFormatterInterface;
use Vich\Sf2TweetsBundle\Entity\Tweet;

/**
 * TweetListener.
 *
 * @author Dustin Dobervich <ddobervich@gmail.com>
 */
class TweetListener implements EventSubscriber
{
    /**
     * @var TweetFormatterInterface $formatter
     */
    protected $formatter;
    
    /**
     * Constructs a new instnace of TweetListener.
     * 
     * @param TweetFormatterInterface $formatter The tweet formatter.
     */
    public function __construct(TweetFormatterInterface $formatter)
    {
        $this->formatter = $formatter;
    }
    
    /**
     * The events the listener is subscribed to.
     * 
     * @return array An array
     */
    public function getSubscribedEvents()
    {
        return array(
            'prePersist'
        );
    }
    
    /**
     * Formats the tweet before it is saved to the datastore.
     * 
     * @param LifecycleEventArgs $e The event args.
     */
    public function prePersist(LifecycleEventArgs $e)
    {
        $entity = $e->getEntity();
        if ($entity instanceof Tweet) {
            $formattedMsg = $this->formatter->format($entity->getMessage());
            $entity->setFormattedMessage($formattedMsg);
        }
    }
}
