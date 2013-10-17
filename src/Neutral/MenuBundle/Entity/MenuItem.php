<?php

namespace Neutral\MenuBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MenuItem
 */
class MenuItem
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $url;

    /**
     * @var integer
     */
    private $ordinate;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return MenuItem
     */
    public function setTitle($title)
    {
        $this->title = $title;
    
        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set url
     *
     * @param string $url
     * @return MenuItem
     */
    public function setUrl($url)
    {
        $this->url = $url;
    
        return $this;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set ordinate
     *
     * @param integer $ordinate
     * @return MenuItem
     */
    public function setOrdinate($ordinate)
    {
        $this->ordinate = $ordinate;
    
        return $this;
    }

    /**
     * Get ordinate
     *
     * @return integer 
     */
    public function getOrdinate()
    {
        return $this->ordinate;
    }
    /**
     * @var boolean
     */
    private $active;


    /**
     * Set active
     *
     * @param boolean $active
     * @return MenuItem
     */
    public function setActive($active)
    {
        $this->active = $active;
    
        return $this;
    }

    /**
     * Get active
     *
     * @return boolean 
     */
    public function getActive()
    {
        return $this->active;
    }
    /**
     * @var \Neutral\MenuBundle\Entity\Menu
     */
    private $menu;


    /**
     * Set menu
     *
     * @param \Neutral\MenuBundle\Entity\Menu $menu
     * @return MenuItem
     */
    public function setMenu(\Neutral\MenuBundle\Entity\Menu $menu = null)
    {
        $this->menu = $menu;
    
        return $this;
    }

    /**
     * Get menu
     *
     * @return \Neutral\MenuBundle\Entity\Menu 
     */
    public function getMenu()
    {
        return $this->menu;
    }
}