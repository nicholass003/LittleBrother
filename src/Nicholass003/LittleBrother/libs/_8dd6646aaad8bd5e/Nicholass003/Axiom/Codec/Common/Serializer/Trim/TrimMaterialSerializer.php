<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Codec\Common\Serializer\Trim;

use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Codec\Support\ForkableInterface;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Codec\Support\StatelessForkable;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Data\Type\Trim\TrimMaterial;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;

class TrimMaterialSerializer implements ForkableInterface{
    use StatelessForkable;

    public function read(ByteBufferReader $in) : TrimMaterial{
        $materialId = CodecHelper::readString($in);
        $color = CodecHelper::readString($in);
        $itemId = CodecHelper::readString($in);
        return new TrimMaterial($materialId, $color, $itemId);
    }

    public function write(ByteBufferWriter $out, TrimMaterial $material) : void{
        CodecHelper::writeString($out, $material->materialId);
        CodecHelper::writeString($out, $material->color);
        CodecHelper::writeString($out, $material->itemId);
    }
}