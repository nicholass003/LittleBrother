<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\Common\Serializer\Map;

use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\Support\ForkableInterface;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\Support\StatelessForkable;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Data\Type\Map\MapInfoRequestPacketClientPixel;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;

class MapInfoRequestPacketClientPixelSerializer implements ForkableInterface{
    use StatelessForkable;

    private const Y_INDEX_MULTIPLIER = 128;

    public function read(ByteBufferReader $in) : MapInfoRequestPacketClientPixel{
        $color = LE::readUnsignedInt($in);
        $index = LE::readUnsignedShort($in);

        $x = $index % self::Y_INDEX_MULTIPLIER;
        $y = intdiv($index, self::Y_INDEX_MULTIPLIER);

        return new MapInfoRequestPacketClientPixel($color, $x, $y);
    }

    public function write(ByteBufferWriter $out, MapInfoRequestPacketClientPixel $pixel) : void{
        LE::writeUnsignedInt($out, $pixel->colorRgba);
        LE::writeUnsignedShort($out, $pixel->x + ($pixel->y * self::Y_INDEX_MULTIPLIER));
    }
}