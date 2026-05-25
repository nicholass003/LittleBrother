<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\Common\Serializer;

use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\Support\ForkableInterface;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\Support\StatelessForkable;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\Type\BlockPaletteEntry;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;

class BlockPaletteSerializer implements ForkableInterface{
    use StatelessForkable;

    /**
     * @return list<BlockPaletteEntry>
     */
    public function read(ByteBufferReader $in) : array{
        return CodecHelper::readList($in, function($in){
            $name = CodecHelper::readString($in);
            $nbt = CodecHelper::readNbt($in);
            return new BlockPaletteEntry($name, $nbt);
        });
    }

    /**
     * @param list<BlockPaletteEntry> $palettes
     */
    public function write(ByteBufferWriter $out, array $palettes) : void{
        CodecHelper::writeList($out, $palettes, function($out, $palette) : void{
            CodecHelper::writeString($out, $palette->name);
            CodecHelper::writeNbt($out, $palette->nbt);
        });
    }
}