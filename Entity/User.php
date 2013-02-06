<?php

namespace Ner0tic\FoursquareBundle\Entity;

use Ner0tic\FoursquareBundle\Entity\fsList,
    Ner0tic\FoursquareBundle\Entity\Tip,
    Ner0tic\FoursquareBundle\Entity\Photo;

class User 
{

    protected 
        $id,
        $firstName,
        $lastName,
        
        $relationship = 'self',
        $friends = array(),
        
        $type = "user",
        $lists = array();
    
    /**
     * Get Id
     * 
     * @return string
     */
    public function getId() 
    { 
        return $this->id; 
    }
  
    /**
     * Set Id
     * 
     * @param type $id
     * @return \Ner0tic\FoursquareBundle\Entity\User
     */
    public function setId( $id ) 
    {
        $this->id = $id;
    
        return $this;
    }

    /**
     * Get User's First Name
     * 
     * @return string
     */
    public function getFirstName() 
    { 
        return $this->firstName; 
    }
  
    /**
     * Set User's First Name
     * 
     * @param string $firstName
     * 
     * @return \Ner0tic\FoursquareBundle\Entity\User
     */
    public function setFirstName( $firstName ) 
    {
        $this->firstName = $firstName;
    
        return $this;
    }
  
    /**
     * Get Last Name
     * 
     * @return string
     */
    public function getLastName() 
    { 
        return $this->lastName; 
    }
  
    /**
     * Set Last Name
     * 
     * @param string $lastName
     * 
     * @return \Ner0tic\FoursquareBundle\Entity\User
     */
    public function setLastName( $lastName )
    {
        $this->lastName = $lastName;
    
        return $this;
    }
  
    /**
     * Get Relationship
     * 
     * @return string
     */
    public function getRelationship() 
    { 
        return $this->relationship; 
    }
  
    /**
     * Set Relationship
     * 
     * @param string $relationship
     * 
     * @return \Ner0tic\FoursquareBundle\Entity\User
     */
    public function setRelationship( $relationship ) 
    {
        $this->relationship = $relationship;
    
        return $this;
    }
  
    /**
     * Get Friends
     * 
     * @return array
     */
    public function getFriends() 
    { 
        return $this->friends; 
    }
  
    /**
     * Set Friends
     * 
     * @param array $friends
     * 
     * @return \Ner0tic\FoursquareBundle\Entity\User
     */
    public function setFriends( $friends ) 
    {
        $this->friends = $friends;
    
        return $this;
    }
  
    /**
     * Get Type
     * 
     * @return string
     */
    public function getType() 
    { 
        return $this->type; 
    }
  
    /**
     * Set Type
     * 
     * @param string $type
     * 
     * @return \Ner0tic\FoursquareBundle\Entity\User
     */
    public function setType( $type ) 
    {
        $this->type = $type;
    
        return $this;
    }
  
    /**
     * Get Lists
     * @return array
     */
    public function getLists() 
    { 
        return $this->lists; 
    }
  
    /**
     * Set Lists
     * 
     * @param array $lists
     * @return \Ner0tic\FoursquareBundle\Entity\User
     */
    public function setLists( array $lists = array() ) 
    {
        $this->lists = $lists;
        
        return $this;
    }
    
    /**
     * Get Lists
     * @return array
     */
    public function getList() 
    {
        foreach( $lists as $list ) 
        {
            if( $list->getPrimary() )
            {
                return $list;
            }
        }
    
        return $this->lists;
    }
    
    public function addList( fsList $list ) 
    {   
        if( !in_array( $list, $this->lists ) )
        {
            $this->lists[] = $list;
        }
      
        return $this;
    }
    
    elseif(is_array($list)) {
      $c = new \Self();
      $c->fromArray($list);
      return $this;
    }
    else  throw new FoursquareException('List should be an array or a single entity of type Ner0tic\FoursquareBundle\Entity\List');
  }    
  
  protected $tips = array();
  public function getTips() { return $this->tips; }
  public function setTips($tips) {
    if($categories instanceof fsTip) $this->tips = array($tips);
    elseif(is_array($tips)) {
      $this->tips = $tips;
    }
    else  throw new FoursquareException('Tip should be an array of Tip Entities or a single entity of type Ner0tic\FoursquareBundle\Entity\Tip');
    return $this;
  }
  public function getTip() {
    foreach($tip as $tips) {
      if($tip->getPrimary()) return $tip;
    }
    return $this->tips[0];
  }
  public function addTip($tip) {   
    if($tip instanceof fsTip) {
      $this->tips[] = $tip;
      return $this;
    }
    elseif(is_array($tip)) {
      $t = new fsTip();
      $t->fromArray($tip);
      $this->tips[] = $tip;
      return $this;
    }
    else  throw new FoursquareException('Tip should be an array or a single entity of type Ner0tic\FoursquareBundle\Entity\Tip');
  } 
  
  protected $gender = 'unisex';
  public function getGender() { return $this->gender; }
  public function setGender($sex) {
    $this->gender = $sex;
    return $this;
  }
  
  protected $homeCity = 'Margaritaville';
  public function getHomeCity() { return $this->homeCity; }
  public function setHomeCity($city) {
    $this->homeCity = $city;
    return $this;
  }
  
  protected $bio;
  public function getBio() { return $this->bio; }
  public function setBio($bio) {
    $this->bio = $bio;
    return $this;
  }
  
  protected $contact = array();
  public function getContact() { return $this->contact; }
  public function setContact($contact) {
    $this->contact = array_merge($this->contact, $contact);
    return $this;
  }
  
  protected $pings = false;
  public function getPings() { return $this->pings; }
  public function setPings($pings) {
    $this->pings = $pings;
    return $this;
  }
  
  protected $badges = array();
  public function getBadges() { return $this->badges; }
  public function setBadges($badges) {
    $this->badges = $badges;
    return $this;
  }
  
  protected $mayorships = array();
  public function getMayorships() { return $this->mayorships; }
  public function setMayorships($mayorships) {
    $this->mayorships = $mayorships;
    return $this;
  }
  
  protected $checkins = array();
  public function getCheckins() { return $This->checkins; }
  public function setCheckins($checkins) {
    $this->checkins = $checkins;
    return $this;
  }
  
  protected $following = array();
  public function getFollowing() { return $This->following; }
  public function setFollowing($follow) {
    $this->following = $follow;
    return $this;
  }
  
  protected $requests;
  public function getRequests() { return $this->requests; }
  public function setRequests($r) { 
    $this->requests = $r;
    return $this;
  }
  
  /**
   *
   * @var array $photos
   */
  protected $photos = array();
  public function getPhotos() { return $this->photos; }
  public function setPhotos($photos) {
    if($photos instanceof fsPhoto) $this->photos = array($photos);
    elseif(is_array($photos)) {
      $this->photos = $photos;
    }
    else  throw new FoursquareException('Photo should be an array of Photo Entities or a single entity of  type Ner0tic\FoursquareBundle\Entity\Photo');
    return $this;
  }
  
  
  protected $scores = array();
  public function getScores() { return $this->scores; }
  public function setScores($scores) { 
    $this->scores = $score;
    return $this;
  }
  
  protected $referralId;
  public function getReferralId() { return $this->referralId; }
  public function setReferralId($id) {
    $this->referralId = $id;
    return $this;
  }  
  
}

?>