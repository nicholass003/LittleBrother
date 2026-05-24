<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\v924;

use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\v924\Serializer\CameraAimAssistSerializer;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Packet\CameraAimAssistActorPriorityPacket;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Packet\Packet;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\VarInt;

class CameraAimAssistActorPriorityCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : CameraAimAssistActorPriorityPacket{
        $cameraAimAssist = $codec->cameraAimAssist();
        assert($cameraAimAssist instanceof CameraAimAssistSerializer);
        $pk = new CameraAimAssistActorPriorityPacket();
        for($i = 0, $count = VarInt::readUnsignedInt($in); $i < $count; ++$i){
            $pk->priorityData[] = $cameraAimAssist->actorPriority()->read($in);
        }
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof CameraAimAssistActorPriorityPacket);
        $cameraAimAssist = $codec->cameraAimAssist();
        assert($cameraAimAssist instanceof CameraAimAssistSerializer);
        VarInt::writeUnsignedInt($out, count($pk->priorityData));
        foreach($pk->priorityData as $data){
            $cameraAimAssist->actorPriority()->write($out, $data);
        }
    }
}