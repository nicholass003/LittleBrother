<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Data\Type\Camera;

final class CameraAimAssistPresetExclusionDefinition{

    /** @var list<string> */
    public readonly array $blocks;

    /** 
     * @since v898
     * @var list<string>
     */
    public readonly array $entities;

    /** 
     * @since v898
     * @var list<string>
     */
    public readonly array $blockTags;

    /** 
     * @since v924
     * @var list<string>
     */
    public readonly array $entityTypeFamilies;

    /**
     * @param list<string> $blocks
     * @param list<string> $entities
     * @param list<string> $blockTags
     * @param list<string> $entityTypeFamilies
     */
    public function __construct(
        array $blocks,
        array $entities = [],
        array $blockTags = [],
        array $entityTypeFamilies = []
    ){
        $this->blocks = $blocks;
        $this->entities = $entities;
        $this->blockTags = $blockTags;
        $this->entityTypeFamilies = $entityTypeFamilies;
    }
}