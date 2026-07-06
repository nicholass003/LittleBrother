<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\v924;

use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\v859\Serializer\Camera\CameraInstructionSerializer;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Data\Type\Camera\CameraSplineDefinition;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Packet\CameraSplinePacket;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Packet\Packet;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\VarInt;

class CameraSplineCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : CameraSplinePacket{
        $cameraInstruction = $codec->cameraInstruction();
        assert($cameraInstruction instanceof CameraInstructionSerializer);
        $pk = new CameraSplinePacket();
        for($i = 0, $splineCount = VarInt::readUnsignedInt($in); $i < $splineCount; ++$i){
            $name = CodecHelper::readString($in);
            $instruction = $cameraInstruction->spline()->read($in);
            $pk->splines[] = new CameraSplineDefinition($name, $instruction);
        }
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof CameraSplinePacket);
        $cameraInstruction = $codec->cameraInstruction();
        assert($cameraInstruction instanceof CameraInstructionSerializer);
        foreach($pk->splines as $spline){
            CodecHelper::writeString($out, $spline->name);
            $cameraInstruction->spline()->write($out, $spline->instruction);
        }
    }
}