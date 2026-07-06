<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\Common\Serializer;

use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\Common\Serializer\Trim\TrimMaterialSerializer;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\Common\Serializer\Trim\TrimPatternSerializer;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\Support\CloneWithProperty;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\Support\Forkable;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\Support\ForkableInterface;

class TrimSerializer implements ForkableInterface{
    use Forkable;
    use CloneWithProperty;

    public function __construct(
        private TrimPatternSerializer $patternSerializer,
        private TrimMaterialSerializer $materialSerializer
    ){}

    public function pattern() : TrimPatternSerializer{ return $this->patternSerializer; }
    public function material() : TrimMaterialSerializer{ return $this->materialSerializer; }

    public function withPattern(TrimPatternSerializer $v) : self{ return $this->with('patternSerializer', $v); }
    public function withMaterial(TrimMaterialSerializer $v) : self{ return $this->with('materialSerializer', $v); }
}