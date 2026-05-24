<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Codec\v944;

use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Packet\CommandBlockUpdatePacket;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Packet\Packet;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;
use pmmp\encoding\VarInt;

class CommandBlockUpdateCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : CommandBlockUpdatePacket{
        $pk = new CommandBlockUpdatePacket();
        $pk->isBlock = CodecHelper::readBool($in);
        if($pk->isBlock){
            $pk->blockPosition = CodecHelper::readSignedBlockPosition($in);
            $pk->commandBlockMode = VarInt::readUnsignedInt($in);
            $pk->isRedstoneMode = CodecHelper::readBool($in);
            $pk->isConditional = CodecHelper::readBool($in);
        }else{
            $pk->minecartActorRuntimeId = CodecHelper::readActorRuntimeId($in);
        }
        $pk->command = CodecHelper::readString($in);
        $pk->lastOutput = CodecHelper::readString($in);
        $pk->name = CodecHelper::readString($in);
        $pk->filteredName = CodecHelper::readString($in);
        $pk->shouldTrackOutput = CodecHelper::readBool($in);
        $pk->tickDelay = LE::readUnsignedInt($in);
        $pk->executeOnFirstTick = CodecHelper::readBool($in);
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof CommandBlockUpdatePacket);
        CodecHelper::writeBool($out, $pk->isBlock);
        if($pk->isBlock){
            CodecHelper::writeSignedBlockPosition($out, $pk->blockPosition);
            VarInt::writeUnsignedInt($out, $pk->commandBlockMode);
            CodecHelper::writeBool($out, $pk->isRedstoneMode);
            CodecHelper::writeBool($out, $pk->isConditional);
        }else{
            CodecHelper::writeActorRuntimeId($out, $pk->minecartActorRuntimeId);
        }
        CodecHelper::writeString($out, $pk->command);
        CodecHelper::writeString($out, $pk->lastOutput);
        CodecHelper::writeString($out, $pk->name);
        CodecHelper::writeString($out, $pk->filteredName);
        CodecHelper::writeBool($out, $pk->shouldTrackOutput);
        LE::writeUnsignedInt($out, $pk->tickDelay);
        CodecHelper::writeBool($out, $pk->executeOnFirstTick);
    }
}