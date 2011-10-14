<?php

namespace Vich\Sf2TweetsBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * CleanupTweetsCommand.
 *
 * @author Dustin Dobervich <ddobervich@gmail.com>
 */
class CleanupTweetsCommand extends ContainerAwareCommand
{
    /**
     * {@inheritDoc}
     */
    protected function configure()
    {
        $this
            ->setName('sf2tweets:cleanup')
            ->setDescription('Cleans up old tweets.')
            ->setHelp(<<<EOT
The <info>sf2t:tweets:cleanup</info> command removes old tweets from the database:

  <info>php app/console sf2tweets:cleanup</info>

EOT
            );
    }
    
    /**
     * {@inheritDoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $manager = $this->getContainer()->get('vich_sf2tweets.tweet_manager');
        $manager->removeOldTweets();
        
        $output->writeln('Cleaned up tweets...');
    }

}
