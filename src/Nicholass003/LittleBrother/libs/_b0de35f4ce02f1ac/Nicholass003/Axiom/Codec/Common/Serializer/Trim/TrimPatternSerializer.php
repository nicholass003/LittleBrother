<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Codec\Common\Serializer\Trim;

use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Codec\Support\ForkableInterface;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Codec\Support\StatelessForkable;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Data\Type\Trim\TrimPattern;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;

class TrimPatternSerializer implements ForkableInterface{
    use StatelessForkable;

    public function read(ByteBufferReader $in) : TrimPattern{
        $itemId = CodecHelper::readString($in);
        $patternId = CodecHelper::readString($in);
        return new TrimPattern($itemId, $patternId);
    }

    public function write(ByteBufferWriter $out, TrimPattern $pattern) : void{
        CodecHelper::writeString($out, $pattern->itemId);
        CodecHelper::writeString($out, $pattern->patternId);
    }
}