<?php

namespace Vich\Sf2TweetsBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\Event\FilterDataEvent;

/**
 * TweetType.
 *
 * @author Dustin Dobervich <ddobervich@gmail.com>
 */
class TweetType extends AbstractType
{
    /**
     * Gets the name of the form.
     * 
     * @return string The form name.
     */
    public function getName()
    {
        return 'tweet';
    }
    
    /**
     * Builds the form.
     * 
     * @param FormBuilder $builder The form builder.
     * @param array $options The options.
     */
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('twitterId')
            ->add('twitterUserScreenName')
            ->add('twitterUserAvatarUrl')
            ->add('message')
            ->add('messageEntities')
            ->add('twitterUserLocation')
        ;
        
        $builder->addEventListener(FormEvents::BIND_CLIENT_DATA, function(FilterDataEvent $e) {
            $data = $e->getData();
            if (!empty($data['messageEntities'])) {
                $json = json_encode($data['messageEntities']);
                $data['messageEntities'] = $json;
                
                $e->setData($data);
            }
        });
    }
    
    /**
     * Gets the default options for the form.
     * 
     * @param array $options The options.
     * @return array The default options.
     */
    public function getDefaultOptions(array $options = null)
    {
        return array(
            'data_class' => 'Vich\Sf2TweetsBundle\Entity\Tweet',
            'csrf_protection' => false
        );
    }
}
