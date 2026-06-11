<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\Common\Serializer\Command;

use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\Support\ForkableInterface;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\Support\StatelessForkable;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Data\Type\Command\ChainedSubCommandRawData;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Data\Type\Command\ChainedSubCommandValueRawData;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;

class ChainedSubCommandDataSerializer implements ForkableInterface{
    use StatelessForkable;

    /**
     * @return list<ChainedSubCommandRawData>
     */
    public function readList(ByteBufferReader $in) : array{
        return CodecHelper::readList($in, function($in) : ChainedSubCommandRawData{
            $name = CodecHelper::readString($in);
            $values = CodecHelper::readList($in, function($in) : ChainedSubCommandValueRawData{
                return new ChainedSubCommandValueRawData(
                    LE::readUnsignedShort($in),
                    LE::readUnsignedShort($in)
                );
            });
            return new ChainedSubCommandRawData($name, $values);
        });
    }

    /**
     * @param list<ChainedSubCommandRawData> $data
     */
    public function writeList(ByteBufferWriter $out, array $data) : void{
        CodecHelper::writeList($out, $data, function($out, $d) : void{
            CodecHelper::writeString($out, $d->name);
            CodecHelper::writeList($out, $d->valueData, function($out, $v) : void{
                LE::writeUnsignedShort($out, $v->nameIndex);
                LE::writeUnsignedShort($out, $v->type);
            });
        });
    }
}