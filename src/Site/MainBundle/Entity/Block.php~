<?php

namespace Site\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Block
 *
 * @ORM\Table(name="blocks")
 * @ORM\Entity(repositoryClass="Site\MainBundle\Entity\Repository\BlockRepository")
 */
class Block
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=100, nullable=false)
     */
    private $title;

    /**
     * @Gedmo\Slug(fields={"title"})
     * @ORM\Column(length=128, unique=true)
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="text_top", type="text", nullable=true)
     */
    private $textTop;

    /**
     * @var string
     *
     * @ORM\Column(name="text_bottom", type="text", nullable=true)
     */
    private $textBottom;

    /**
     * @var integer
     * @Gedmo\SortablePosition
     * @ORM\Column(name="position", type="integer", nullable=true)
     */
    private $position = 0;

    /**
     * @ORM\OneToMany(targetEntity="Element", cascade={"persist", "remove"}, mappedBy="block")
     */
    private $elements;

    /**
     * @ORM\ManyToOne(targetEntity="Products")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     */
    private $product;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->elements = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * @return Block
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
     * Set slug
     *
     * @param string $slug
     * @return Block
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set textTop
     *
     * @param string $textTop
     * @return Block
     */
    public function setTextTop($textTop)
    {
        $this->textTop = $textTop;

        return $this;
    }

    /**
     * Get textTop
     *
     * @return string 
     */
    public function getTextTop()
    {
        return $this->textTop;
    }

    /**
     * Set textBottom
     *
     * @param string $textBottom
     * @return Block
     */
    public function setTextBottom($textBottom)
    {
        $this->textBottom = $textBottom;

        return $this;
    }

    /**
     * Get textBottom
     *
     * @return string 
     */
    public function getTextBottom()
    {
        return $this->textBottom;
    }

    /**
     * Set position
     *
     * @param integer $position
     * @return Block
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return integer 
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Add elements
     *
     * @param \Site\MainBundle\Entity\Element $elements
     * @return Block
     */
    public function addElement(\Site\MainBundle\Entity\Element $elements)
    {
        $this->elements[] = $elements;

        return $this;
    }

    /**
     * Remove elements
     *
     * @param \Site\MainBundle\Entity\Element $elements
     */
    public function removeElement(\Site\MainBundle\Entity\Element $elements)
    {
        $this->elements->removeElement($elements);
    }

    /**
     * Get elements
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getElements()
    {
        return $this->elements;
    }

    /**
     * Set product
     *
     * @param \Site\MainBundle\Entity\Products $product
     * @return Block
     */
    public function setProduct(\Site\MainBundle\Entity\Products $product = null)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \Site\MainBundle\Entity\Products 
     */
    public function getProduct()
    {
        return $this->product;
    }

    public function __toString(){
        return $this->title;
    }
}
