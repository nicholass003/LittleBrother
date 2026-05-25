<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\Common\Serializer;

use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\Support\StatelessForkable;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\Type\AttributeModifier;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;

class AttributeSerializer{
    use StatelessForkable;

    public function read(ByteBufferReader $in) : AttributeModifier{
        return new AttributeModifier(
            CodecHelper::readString($in),
            CodecHelper::readString($in),
            LE::readFloat($in),
            LE::readSignedInt($in),
            LE::readSignedInt($in),
            CodecHelper::readBool($in)
        );
    }

    public function write(ByteBufferWriter $out, AttributeModifier $mod) : void{
        CodecHelper::writeString($out, $mod->id);
        CodecHelper::writeString($out, $mod->name);
        LE::writeFloat($out, $mod->amount);
        LE::writeSignedInt($out, $mod->operation);
        LE::writeSignedInt($out, $mod->operand);
        CodecHelper::writeBool($out, $mod->serializable);
    }
}