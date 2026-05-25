<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\Type\Camera;

class CameraAimAssistCategory{

    /** 
     * @since v898
     * @var int[] $blockTags
     */
    public readonly array $blockTags;

    /**
     * @param list<CameraAimAssistCategoryEntityPriority> $entities
     * @param list<CameraAimAssistCategoryBlockPriority>  $blocks
     */
    public function __construct(
        public readonly string $name,
        public readonly array $entities,
        public readonly array $blocks,
        array $blockTags = [],
        public readonly ?int $defaultEntityPriority = null,
        public readonly ?int $defaultBlockPriority = null
    ){
        $this->blockTags = $blockTags;
    }
}