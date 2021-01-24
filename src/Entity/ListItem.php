<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * List items
 *
 * @ORM\Table(name="list_items")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="App\Repository\ListItemRepository")
 */
class ListItem
{
    public const TYPE = 'LIST_ITEM';

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private int $id;

    /**
     * @var string
     *
     * @ORM\Column(name="text", type="string", length=255, nullable=false)
     */
    private string $text = '';

    /**
     * @var int
     *
     * @ORM\Column(name="parent_id", type="bigint", nullable=false)
     */
    private int $parentId;

    /**
     * @var bool
     *
     * @ORM\Column(name="checked", type="boolean", nullable=true)
     */
    private bool $checked = false;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $updatedAt = 'CURRENT_TIMESTAMP';

	public function __construct()
	{
		$this->updatedAt = new \DateTime();
	}

	public function getId(): int
    {
        return $this->id;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getParentId(): int
    {
        return $this->parentId;
    }

    public function setParentId(int $parentId): self
    {
        $this->parentId = $parentId;

        return $this;
    }

    public function getChecked(): bool
    {
        return $this->checked;
    }

    public function setChecked(bool $checked): self
    {
        $this->checked = $checked;

        return $this;
    }

    public function getUpdatedAt(): \DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
