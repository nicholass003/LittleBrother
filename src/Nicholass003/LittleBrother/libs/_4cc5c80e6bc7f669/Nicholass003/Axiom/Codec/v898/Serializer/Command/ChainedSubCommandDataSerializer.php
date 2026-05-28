<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\v898\Serializer\Command;

use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\Common\Serializer\Command\ChainedSubCommandDataSerializer as BaseChainedSubCommandDataSerializer;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Data\Type\Command\ChainedSubCommandRawData;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Data\Type\Command\ChainedSubCommandValueRawData;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\VarInt;

class ChainedSubCommandDataSerializer extends BaseChainedSubCommandDataSerializer{

    /**
     * @return list<ChainedSubCommandRawData>
     */
    public function readList(ByteBufferReader $in) : array{
        return CodecHelper::readList($in, function($in) : ChainedSubCommandRawData{
            $name = CodecHelper::readString($in);
            $values = CodecHelper::readList($in, function($in) : ChainedSubCommandValueRawData{
                return new ChainedSubCommandValueRawData(
                    VarInt::readUnsignedInt($in),
                    VarInt::readUnsignedInt($in)
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
                VarInt::writeUnsignedInt($out, $v->nameIndex);
                VarInt::writeUnsignedInt($out, $v->type);
            });
        });
    }
}