<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Codec\Common\Serializer;

use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Codec\Common\Serializer\Structure\StructureEditorDataSerializer;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Codec\Common\Serializer\Structure\StructureSettingsSerializer;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Codec\Support\CloneWithProperty;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Codec\Support\Forkable;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Codec\Support\ForkableInterface;

class StructureSerializer implements ForkableInterface{
    use Forkable;
    use CloneWithProperty;

    public function __construct(
        private StructureSettingsSerializer $settingsSerializer,
        private StructureEditorDataSerializer $editorDataSerializer
    ){}

    public function settings() : StructureSettingsSerializer{ return $this->settingsSerializer; }
    public function editorData() : StructureEditorDataSerializer{ return $this->editorDataSerializer; }

    public function withSettings(StructureSettingsSerializer $v) : self{ return $this->with('settingsSerializer', $v); }
    public function withEditorData(StructureEditorDataSerializer $v) : self{ return $this->with('editorDataSerializer', $v); }
}