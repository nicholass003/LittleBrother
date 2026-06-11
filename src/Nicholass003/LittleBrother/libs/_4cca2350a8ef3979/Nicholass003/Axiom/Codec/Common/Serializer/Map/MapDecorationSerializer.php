<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\Common\Serializer\Map;

use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\Support\ForkableInterface;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\Support\StatelessForkable;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Data\Type\Map\MapDecoration;
use pmmp\encoding\Byte;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\VarInt;
use pocketmine\utils\Binary;

class MapDecorationSerializer implements ForkableInterface{
    use StatelessForkable;

    public function read(ByteBufferReader $in) : MapDecoration{
        return new MapDecoration(
            Byte::readUnsigned($in),
            Byte::readUnsigned($in),
            Byte::readUnsigned($in),
            Byte::readUnsigned($in),
            CodecHelper::readString($in),
            Binary::flipIntEndianness(VarInt::readUnsignedInt($in))
        );
    }

    public function write(ByteBufferWriter $out, MapDecoration $decoration) : void{
        Byte::writeUnsigned($out, $decoration->icon);
        Byte::writeUnsigned($out, $decoration->rotation);
        Byte::writeUnsigned($out, $decoration->xOffset);
        Byte::writeUnsigned($out, $decoration->yOffset);
        CodecHelper::writeString($out, $decoration->label);
        VarInt::writeUnsignedInt($out, Binary::flipIntEndianness($decoration->colorRgba));
    }
}