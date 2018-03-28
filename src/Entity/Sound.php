<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SoundRepository")
 * @ORM\Table(name="sound")
 * @ORM\HasLifecycleCallbacks
 * @Vich\Uploadable
 */
class Sound
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $title;

    /**
     * @Vich\UploadableField(mapping="sound_thumbnail", fileNameProperty="thumbnailName", size="thumbnailSize")
     *
     * @var File
     */
    private $thumbnailFile;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    private $thumbnailName;

    /**
     * @ORM\Column(type="integer")
     *
     * @var integer
     */
    private $thumbnailSize;

    /**
     * @Vich\UploadableField(mapping="sound_sound", fileNameProperty="soundName", size="soundSize")
     *
     * @var File
     */
    private $soundFile;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    private $soundName;

    /**
     * @ORM\Column(type="integer")
     *
     * @var integer
     */
    private $soundSize;

    /**
     * @ORM\Column(type="datetime")
     *
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="datetime")
     *
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     */
    public function setCreatedAt(\DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     */
    public function setUpdatedAt(\DateTime $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     *
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function updatedTimestamps(): void
    {
        $this->setUpdatedAt(new \DateTime('now'));

        if ($this->getCreatedAt() === null) {
            $this->setCreatedAt(new \DateTime('now'));
        }
    }

    public function getThumbNailFile(): ?File
    {
        return $this->thumbnailFile;
    }

    /**
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $thumbnail
     */
    public function setThumbNailFile(?File $thumbnail = null): void
    {
        $this->thumbnailFile = $thumbnail;

        if (null !== $thumbnail) {
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getThumbNailName(): ?string
    {
        return $this->thumbnailName;
    }

    public function setThumbNailName(?string $thumbnailName): void
    {
        $this->thumbnailName = $thumbnailName;
    }

    public function getThumbNailSize(): ?int
    {
        return $this->thumbnailSize;
    }

    public function setThumbNailSize(?int $thumbnailSize): void
    {
        $this->thumbnailSize = $thumbnailSize;
    }

    public function getSoundFile(): ?File
    {
        return $this->soundFile;
    }

    /**
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $sound
     */
    public function setSoundFile(?File $sound = null): void
    {
        $this->soundFile = $sound;

        if (null !== $sound) {
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getSoundName(): ?string
    {
        return $this->soundName;
    }

    public function setSoundName(?string $soundName): void
    {
        $this->soundName = $soundName;
    }

    public function getSoundSize(): ?int
    {
        return $this->soundSize;
    }

    public function setSoundSize(?int $soundSize): void
    {
        $this->soundSize = $soundSize;
    }

    public function getId()
    {
        return $this->id;
    }
}
