<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Enum\AgentActionType;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Packet\AgentActionEventPacket;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Packet\Packet;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;

class AgentActionEventCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : AgentActionEventPacket{
        $pk = new AgentActionEventPacket();
        $pk->requestId = CodecHelper::readString($in);
        $pk->action = AgentActionType::safe(LE::readUnsignedInt($in));
        $pk->responseJson = CodecHelper::readString($in);
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof AgentActionEventPacket);
        CodecHelper::writeString($out, $pk->requestId);
        LE::writeUnsignedInt($out, $pk->action->value);
        CodecHelper::writeString($out, $pk->responseJson);
    }
}