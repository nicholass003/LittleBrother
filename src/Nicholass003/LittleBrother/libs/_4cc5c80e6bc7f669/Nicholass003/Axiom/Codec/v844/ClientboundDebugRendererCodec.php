<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Enum\ClientboundDebugRendererType;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Packet\ClientboundDebugRendererPacket;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Packet\Packet;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;

class ClientboundDebugRendererCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : ClientboundDebugRendererPacket{
        $pk = new ClientboundDebugRendererPacket();
        $pk->type = ClientboundDebugRendererType::safe(LE::readUnsignedInt($in));
        if($pk->type === ClientboundDebugRendererType::ADD_CUBE){
            $pk->text = CodecHelper::readString($in);
            $pk->position = CodecHelper::readVec3($in);
            $pk->red = LE::readFloat($in);
            $pk->green = LE::readFloat($in);
            $pk->blue = LE::readFloat($in);
            $pk->alpha = LE::readFloat($in);
            $pk->durationMillis = LE::readUnsignedLong($in);
        }
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof ClientboundDebugRendererPacket);
        LE::writeUnsignedInt($out, $pk->type->value);
        if($pk->type === ClientboundDebugRendererType::ADD_CUBE){
            CodecHelper::writeString($out, $pk->text);
            CodecHelper::writeVec3($out, $pk->position);
            LE::writeFloat($out, $pk->red);
            LE::writeFloat($out, $pk->green);
            LE::writeFloat($out, $pk->blue);
            LE::writeFloat($out, $pk->alpha);
            LE::writeUnsignedLong($out, $pk->durationMillis);
        }
    }
}