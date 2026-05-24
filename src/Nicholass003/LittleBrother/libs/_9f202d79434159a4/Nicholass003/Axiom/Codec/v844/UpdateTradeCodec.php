<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Enum\WindowTypes;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Packet\Packet;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Packet\UpdateTradePacket;
use pmmp\encoding\Byte;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\VarInt;

class UpdateTradeCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : UpdateTradePacket{
        $pk = new UpdateTradePacket();
        $pk->windowId = Byte::readUnsigned($in);
        $pk->windowType = WindowTypes::safe(Byte::readUnsigned($in));
        $pk->windowSlotCount = VarInt::readSignedInt($in);
        $pk->tradeTier = VarInt::readSignedInt($in);
        $pk->traderActorUniqueId = CodecHelper::readActorUniqueId($in);
        $pk->playerActorUniqueId = CodecHelper::readActorUniqueId($in);
        $pk->displayName = CodecHelper::readString($in);
        $pk->isV2Trading = CodecHelper::readBool($in);
        $pk->isEconomyTrading = CodecHelper::readBool($in);
        $pk->offers = CodecHelper::readNbt($in);
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof UpdateTradePacket);
        Byte::writeUnsigned($out, $pk->windowId);
        Byte::writeUnsigned($out, $pk->windowType->value);
        VarInt::writeSignedInt($out, $pk->windowSlotCount);
        VarInt::writeSignedInt($out, $pk->tradeTier);
        CodecHelper::writeActorUniqueId($out, $pk->traderActorUniqueId);
        CodecHelper::writeActorUniqueId($out, $pk->playerActorUniqueId);
        CodecHelper::writeString($out, $pk->displayName);
        CodecHelper::writeBool($out, $pk->isV2Trading);
        CodecHelper::writeBool($out, $pk->isEconomyTrading);
        CodecHelper::writeNbt($out, $pk->offers);
    }
}