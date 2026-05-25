<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Enum\LoadingScreenType;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Packet\Packet;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Packet\ServerboundLoadingScreenPacket;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;
use pmmp\encoding\VarInt;

class ServerboundLoadingScreenCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : ServerboundLoadingScreenPacket{
        $pk = new ServerboundLoadingScreenPacket();
        $pk->type = LoadingScreenType::safe(VarInt::readSignedInt($in));
        $pk->loadingScreenId = CodecHelper::readOptional($in, LE::readUnsignedInt(...));
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof ServerboundLoadingScreenPacket);
        VarInt::writeSignedInt($out, $pk->type->value);
        CodecHelper::writeOptional($out, $pk->loadingScreenId, LE::writeUnsignedInt(...));
    }
}