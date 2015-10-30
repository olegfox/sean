<?php

namespace Site\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Site\MainBundle\Entity\Elements
 *
 * @ORM\Table(name="elements")
 * @ORM\Entity(repositoryClass="Site\MainBundle\Entity\Repository\ElementsRepository")
 */
class Element
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=100, nullable=true)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="meta_title", type="string", length=100, nullable=true)
     */
    private $metaTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="meta_description", type="string", length=500, nullable=true)
     */
    private $metaDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="meta_keywords", type="string", length=500, nullable=true)
     */
    private $metaKeywords;

    /**
     * @Gedmo\Slug(fields={"title"})
     * @ORM\Column(length=128, unique=true)
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="text", type="text", nullable=true)
     */
    private $text;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $img;

    /**
     * @Assert\File()
     */
    private $file;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $position = 0;

    /**
     * @ORM\ManyToOne(targetEntity="Block")
     * @ORM\JoinColumn(name="block_id", referencedColumnName="id")
     */
    private $block;

    /**
     * @ORM\OneToMany(targetEntity="Slider", mappedBy="element", cascade={"persist", "remove"})
     **/
    private $slider;

    /**
     * Список фото из формы
     **/
    private $sliderGallery;

    public function getAbsolutePath()
    {
        return null === $this->img
            ? null
            : $this->getUploadRootDir().'/'.$this->img;
    }

    public function getWebPath()
    {
        return null === $this->img
            ? null
            : $this->getUploadDir().'/'.$this->img;
    }

    protected function getUploadRootDir()
    {
        return __DIR__.'/../../../../../'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        return 'uploads/elements';
    }

    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;

        $this->upload();
    }

    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }

    public function upload()
    {
        if (null === $this->getFile()) {
            return;
        }

        if (isset($this->img)) {
            if(file_exists($this->getUploadDir().'/'.$this->img)){
                unlink($this->getUploadDir().'/'.$this->img);
            }
            $this->img = null;
        }

        $this->img = uniqid() . '.' . $this->getFile()->getClientOriginalExtension();

        $this->getFile()->move(
            $this->getUploadDir(),
            $this->img
        );

        $this->file = null;
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
     * @return Element
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
     * @return Element
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
     * Set text
     *
     * @param string $text
     * @return Element
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string 
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set img
     *
     * @param string $img
     * @return Element
     */
    public function setImg($img)
    {
        $this->img = $img;

        return $this;
    }

    /**
     * Get img
     *
     * @return string 
     */
    public function getImg()
    {
        return $this->img;
    }

    /**
     * Set position
     *
     * @param integer $position
     * @return Element
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
     * Set block
     *
     * @param \Site\MainBundle\Entity\Block $block
     * @return Element
     */
    public function setBlock(\Site\MainBundle\Entity\Block $block = null)
    {
        $this->block = $block;

        return $this;
    }

    /**
     * Get block
     *
     * @return \Site\MainBundle\Entity\Block 
     */
    public function getBlock()
    {
        return $this->block;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->slider = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add slider
     *
     * @param \Site\MainBundle\Entity\Slider $slider
     * @return Element
     */
    public function addSlider(\Site\MainBundle\Entity\Slider $slider)
    {
        $this->slider[] = $slider;

        return $this;
    }

    /**
     * Remove slider
     *
     * @param \Site\MainBundle\Entity\Slider $slider
     */
    public function removeSlider(\Site\MainBundle\Entity\Slider $slider)
    {
        $this->slider->removeElement($slider);
    }

    /**
     * Get slider
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSlider()
    {
        return $this->slider;
    }

    public function getSliderGallery()
    {
        return $this->sliderGallery;
    }

    public function setSliderGallery($sliderGallery)
    {
        $this->sliderGallery = $sliderGallery;

        return $this;
    }

    /**
     * @ORM\PreRemove
     */
    public function deleteAllSlider()
    {
        $sliders = $this->getSlider();

        foreach ($sliders as $slider) {
            if(file_exists($slider->getImg())){
                unlink($slider->getImg());
            }
        }
    }

    /**
     * Set metaTitle
     *
     * @param string $metaTitle
     * @return Element
     */
    public function setMetaTitle($metaTitle)
    {
        $this->metaTitle = $metaTitle;

        return $this;
    }

    /**
     * Get metaTitle
     *
     * @return string 
     */
    public function getMetaTitle()
    {
        return $this->metaTitle;
    }

    /**
     * Set metaDescription
     *
     * @param string $metaDescription
     * @return Element
     */
    public function setMetaDescription($metaDescription)
    {
        $this->metaDescription = $metaDescription;

        return $this;
    }

    /**
     * Get metaDescription
     *
     * @return string 
     */
    public function getMetaDescription()
    {
        return $this->metaDescription;
    }

    /**
     * Set metaKeywords
     *
     * @param string $metaKeywords
     * @return Element
     */
    public function setMetaKeywords($metaKeywords)
    {
        $this->metaKeywords = $metaKeywords;

        return $this;
    }

    /**
     * Get metaKeywords
     *
     * @return string 
     */
    public function getMetaKeywords()
    {
        return $this->metaKeywords;
    }
}
