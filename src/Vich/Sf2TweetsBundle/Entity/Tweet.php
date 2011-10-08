<?php

namespace Vich\Sf2TweetsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Vich\GeographicalBundle\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\TweetFormatterBundle\Model\TweetInterface;

/**
 * Tweet.
 *
 * @author Dustin Dobervich <ddobervich@gmail.com>
 * 
 * @ORM\Entity
 * @ORM\Table(name="sf2t_tweet")
 * @Vich\Geographical
 */
class Tweet implements TweetInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * 
     * @var integer $id
     */
    protected $id;
    
    /**
     * @ORM\Column(type="string", length="255", name="twitter_id")
     * 
     * @Assert\NotBlank(message="The twitter id is required.", groups={"CreateTweet"})
     * @Assert\MaxLength(limit="255", message="The twitter id is too long.", groups={"CreateTweet"})
     * 
     * @var integer $twitterId
     */
    protected $twitterId;
    
    /**
     * @ORM\Column(type="string", length="255", name="twitter_user_screen_name")
     * 
     * @Assert\NotBlank(message="The twitter user screen name is required.", groups={"CreateTweet"})
     * @Assert\MaxLength(limit="255", message="The user screen name is too long.", groups={"CreateTweet"})
     * 
     * @var string $twitterUserScreenName
     */
    protected $twitterUserScreenName;
    
    /**
     * @ORM\Column(type="string", length="255", name="twitter_user_avatar_url")
     * 
     * @Assert\NotBlank(message="The twitter user avatar url is required.", groups={"CreateTweet"})
     * @Assert\Url(message="The twitter user avatar url is invalid.", groups={"CreateTweet"})
     * @Assert\MaxLength(limit="255", message="The user avatar url is too long.", groups={"CreateTweet"})
     * 
     * @var string $twitterUserAvatarUrl
     */
    protected $twitterUserAvatarUrl;
    
    /**
     * @ORM\Column(type="string", length="255", name="twitter_user_location")
     * 
     * @Assert\MaxLength(limit="255", message="The user location is too long.", groups={"CreateTweet"})
     * 
     * @var string $twitterUserLocation
     */
    protected $twitterUserLocation;
    
    /**
     * @ORM\Column(type="text")
     * 
     * @Assert\NotBlank(message="The message is required.", groups={"CreateTweet"})
     * 
     * @var string $message
     */
    protected $message;
    
    /**
     * @ORM\Column(type="text", name="message_entities")
     * 
     * @var string $messageEntities
     */
    protected $messageEntities;
    
    /**
     * @ORM\Column(type="text", name="formatted_message")
     * 
     * @var string $formattedMessage
     */
    protected $formattedMessage;
    
    /**
     * @ORM\Column(type="decimal", scale="7")
     * 
     * @var double $latitude
     */
    protected $latitude;
    
    /**
     * @ORM\Column(type="decimal", scale="7")
     * 
     * @var double $longitude
     */
    protected $longitude;
    
    /**
     * @ORM\Column(type="datetime", name="created_at")
     * 
     * @var \DateTime $createdAt
     */
    protected $createdAt;
    
    /**
     * Gets the id.
     * 
     * @return integer The id.
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * Gets the twitter id.
     * 
     * @return string The twitter id.
     */
    public function getTwitterId()
    {
        return $this->twitterId;
    }
    
    /**
     * Sets the twitter id.
     * 
     * @param string $twitterId The twitter id
     */
    public function setTwitterId($twitterId)
    {
        $this->twitterId = $twitterId;
    }
    
    /**
     * Gets the twitter user screen name.
     * 
     * @return string The twitter user screen name.
     */
    public function getTwitterUserScreenName()
    {
        return $this->twitterUserScreenName;
    }
    
    /**
     * Sets the twitter user screen name.
     * 
     * @param string $twitterUserScreenName The twitter user.
     */
    public function setTwitterUserScreenName($twitterUserScreenName)
    {
        $this->twitterUserScreenName = $twitterUserScreenName;
    }
    
    /**
     * Gets the twitter user avatar url.
     * 
     * @return string The twitter user avatar url.
     */
    public function getTwitterUserAvatarUrl()
    {
        return $this->twitterUserAvatarUrl;
    }
    
    /**
     * Sets the twitter user avatar url.
     * 
     * @param string $twitterUserAvatarUrl The twitter user avatar url.
     */
    public function setTwitterUserAvatarUrl($twitterUserAvatarUrl)
    {
        $this->twitterUserAvatarUrl = $twitterUserAvatarUrl;
    }
    
    /**
     * Gets the message.
     * 
     * @return string The message.
     */
    public function getMessage()
    {
        return $this->message;
    }
    
    /**
     * Sets the message.
     * 
     * @param string $message The message.
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }
    
    /**
     * Sets the message entities JSON string.
     * 
     * @return string The message entities.
     */
    public function getMessageEntities()
    {
        return $this->messageEntities;
    }
    
    /**
     * Sets the message entities JSON string.
     * 
     * @param string $messageEntities The message entities.
     */
    public function setMessageEntities($messageEntities)
    {
        $this->messageEntities = $messageEntities;
    }
    
    /**
     * Gets the formatted message.
     * 
     * @return string The formatted message.
     */
    public function getFormattedMessage()
    {
        return $this->formattedMessage;
    }
    
    /**
     * Sets the formatted message.
     * 
     * @param string $formattedMessage The formatted message.
     */
    public function setFormattedMessage($formattedMessage)
    {
        $this->formattedMessage = $formattedMessage;
    }
    
    /**
     * Gets the twitter user location.
     * 
     * @return string The twitter user location.
     * 
     * @Vich\GeographicalQuery
     */
    public function getTwitterUserLocation()
    {
        return $this->twitterUserLocation;
    }
    
    /**
     * Sets the twitter user location.
     * 
     * @param type $twitterUserLocation The location.
     */
    public function setTwitterUserLocation($twitterUserLocation)
    {
        $this->twitterUserLocation = $twitterUserLocation;
    }
    
    /**
     * Gets the latitude.
     * 
     * @return double The latitude.
     */
    public function getLatitude()
    {
        return $this->latitude;
    }
    
    /**
     * Sets the latitude.
     * 
     * @param double $latitude The latitude.
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
    }
    
    /**
     * Gets the longitude.
     * 
     * @return double The longitude.
     */
    public function getLongitude()
    {
        return $this->longitude;
    }
    
    /**
     * Sets the longitude.
     * 
     * @param double $longitude The longitude.
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
    }
    
    /**
     * Gets the created at date.
     * 
     * @return \DateTime The created at date.
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
    
    /**
     * Sets the created at date.
     * 
     * @param \DateTime $createdAt The created at date.
     */
    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
    }
    
    /**
     * Constructs a new instance of Tweet.
     */
    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }
    
    /**
     * Returns a string representation of the object.
     * 
     * @return string The string representation.
     */
    public function __toString()
    {
        return $this->getMessage();
    }
}
