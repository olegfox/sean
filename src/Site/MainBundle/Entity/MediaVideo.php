<?php

namespace Site\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Site\MainBundle\Entity\MediaVideo
 *
 * @ORM\Table(name="media_video")
 * @ORM\Entity(repositoryClass="Site\MainBundle\Entity\Repository\MediaVideoRepository")
 */
class MediaVideo
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
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="link", type="text", nullable=false)
     */
    private $link;

    /**
     * @var string
     *
     * @ORM\Column(name="html", type="text", nullable=false)
     */
    private $html;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $preview_image_url = "";

    /**
     * @ORM\OneToOne(targetEntity="Media", inversedBy="video")
     * @ORM\JoinColumn(name="media_id", referencedColumnName="id")
     **/
    private $media;


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
     * Set link
     *
     * @param string $link
     * @return MediaVideo
     */
    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * Get link
     *
     * @return string 
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Set media
     *
     * @param \Site\MainBundle\Entity\Media $media
     * @return MediaVideo
     */
    public function setMedia(\Site\MainBundle\Entity\Media $media = null)
    {
        $this->media = $media;

        return $this;
    }

    /**
     * Get media
     *
     * @return \Site\MainBundle\Entity\Media 
     */
    public function getMedia()
    {
        return $this->media;
    }

    /**
     * Set html
     *
     * @param string $html
     * @return MediaVideo
     */
    public function setHtml($html)
    {
        $this->html = $html;

        return $this;
    }

    /**
     * Get html
     *
     * @return string 
     */
    public function getHtml()
    {
        return $this->html;
    }

    /**
     * Set preview_image_url
     *
     * @param string $previewImageUrl
     * @return MediaVideo
     */
    public function setPreviewImageUrl($previewImageUrl)
    {
        $this->preview_image_url = $previewImageUrl;

        return $this;
    }

    /**
     * Get preview_image_url
     *
     * @return string 
     */
    public function getPreviewImageUrl()
    {
        return $this->preview_image_url;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return MediaVideo
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
}
