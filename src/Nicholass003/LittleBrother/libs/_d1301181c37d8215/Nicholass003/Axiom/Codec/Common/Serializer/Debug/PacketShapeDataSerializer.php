<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Codec\Common\Serializer\Debug;

use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Codec\Support\ForkableInterface;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Codec\Support\StatelessForkable;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Data\Type\Debug\PacketShapeData;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Enum\ScriptDebugShapeType;
use pmmp\encoding\Byte;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;
use pmmp\encoding\VarInt;

class PacketShapeDataSerializer implements ForkableInterface{
    use StatelessForkable;

    public function read(ByteBufferReader $in) : PacketShapeData{
        $networkId = VarInt::readUnsignedLong($in);
        $type = CodecHelper::readOptional($in, fn($in) => ScriptDebugShapeType::safe(Byte::readUnsigned($in)));
        $location = CodecHelper::readOptional($in, CodecHelper::readVec3(...));
        $scale = CodecHelper::readOptional($in, LE::readFloat(...));
        $rotation = CodecHelper::readOptional($in, CodecHelper::readVec3(...));
        $totalTimeLeft = CodecHelper::readOptional($in, LE::readFloat(...));
        $color = CodecHelper::readOptional($in, LE::readUnsignedInt(...));
        $text = CodecHelper::readOptional($in, CodecHelper::readString(...));
        $boxBound = CodecHelper::readOptional($in, CodecHelper::readVec3(...));
        $lineEndLocation = CodecHelper::readOptional($in, CodecHelper::readVec3(...));
        $arrowHeadLength = CodecHelper::readOptional($in, LE::readFloat(...));
        $arrowHeadRadius = CodecHelper::readOptional($in, LE::readFloat(...));
        $segments = CodecHelper::readOptional($in, Byte::readUnsigned(...));

        return new PacketShapeData(
            $networkId, $type, $location, $scale, $rotation, $totalTimeLeft,
            $color, $text, $boxBound, $lineEndLocation, $arrowHeadLength,
            $arrowHeadRadius, $segments
        );
    }

    public function write(ByteBufferWriter $out, PacketShapeData $shape) : void{
        VarInt::writeUnsignedLong($out, $shape->networkId);
        CodecHelper::writeOptional($out, $shape->type, fn($out, $v) => Byte::writeUnsigned($out, $v->value));
        CodecHelper::writeOptional($out, $shape->location, CodecHelper::writeVec3(...));
        CodecHelper::writeOptional($out, $shape->scale, LE::writeFloat(...));
        CodecHelper::writeOptional($out, $shape->rotation, CodecHelper::writeVec3(...));
        CodecHelper::writeOptional($out, $shape->totalTimeLeft, LE::writeFloat(...));
        CodecHelper::writeOptional($out, $shape->colorArgb, LE::writeUnsignedInt(...));
        CodecHelper::writeOptional($out, $shape->text, CodecHelper::writeString(...));
        CodecHelper::writeOptional($out, $shape->boxBound, CodecHelper::writeVec3(...));
        CodecHelper::writeOptional($out, $shape->lineEndLocation, CodecHelper::writeVec3(...));
        CodecHelper::writeOptional($out, $shape->arrowHeadLength, LE::writeFloat(...));
        CodecHelper::writeOptional($out, $shape->arrowHeadRadius, LE::writeFloat(...));
        CodecHelper::writeOptional($out, $shape->segments, Byte::writeUnsigned(...));
    }
}