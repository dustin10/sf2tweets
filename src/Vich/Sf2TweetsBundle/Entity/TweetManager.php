<?php

namespace Vich\Sf2TweetsBundle\Entity;

use Vich\Sf2TweetsBundle\Model\TweetManagerInterface;
use Vich\Sf2TweetsBundle\Entity\Tweet;
use Doctrine\ORM\EntityManager;

/**
 * TweetManager.
 *
 * @author Dustin Dobervich <ddobervich@gmail.com>
 */
class TweetManager implements TweetManagerInterface
{
    /**
     * @var EntityManager $em
     */
    protected $em;
    
    /**
     * @var integer $keepAliveDays
     */
    protected $keepAliveDays;
    
    /**
     * Constructs a new instance of TweetManager.
     * 
     * @param EntityManager $em The entity manager.
     * @param integer $keepAliveDays The number of days to keep tweets alive.
     */
    public function __construct(EntityManager $em, $keepAliveDays)
    {
        $this->em = $em;
        $this->keepAliveDays = $keepAliveDays;
    }
    
    /**
     * {@inheritDoc}
     */
    public function findCurrentTweets()
    {
        $qb = $this->em->createQueryBuilder()
                ->select('t')
                ->from('VichSf2TweetsBundle:Tweet', 't')
                ->orderBy('t.createdAt', 'DESC');
        
        return $qb->getQuery()->getResult();
    }
    
    /**
     * {@inheritDoc}
     */
    public function findOldTweets()
    {
        $qb = $this->em->createQueryBuilder()
                ->select('t')
                ->from('VichSf2TweetsBundle:Tweet', 't')
                ->where('t.createdAt < :date');
        
        $date = new \DateTime(sprintf('-%s days', $this->keepAliveDays));
        
        $qb->setParameter('date', $date);
        
        return $qb->getQuery()->getResult();
    }
    
    /**
     * {@inheritDoc}
     */
    public function removeOldTweets()
    {
        $counter = 0;
        $batchSize = 50;
        
        $tweets = $this->findOldTweets();
        foreach ($tweets as $tweet) {
            $this->em->remove($tweet);
            
            if ($counter > 0 && $counter % $batchSize == 0) {
                $this->em->flush();
                $this->em->clear();
            }
            
            $counter++;
        }
        
        $this->em->flush();
    }
    
    /**
     * {@inheritDoc}
     */
    public function updateTweet(Tweet $tweet, $andFlush = true)
    {
        $this->em->persist($tweet);
        if ($andFlush) {
            $this->em->flush();
        }
    }
}
