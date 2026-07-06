<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\v944;

use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Packet\Packet;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Packet\StructureBlockUpdatePacket;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;

class StructureBlockUpdateCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : StructureBlockUpdatePacket{
        $pk = new StructureBlockUpdatePacket();
        $pk->blockPosition = CodecHelper::readSignedBlockPosition($in);
        $pk->structureEditorData = $codec->structure()->editorData()->read($in);
        $pk->isPowered = CodecHelper::readBool($in);
        $pk->waterlogged = CodecHelper::readBool($in);
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof StructureBlockUpdatePacket);
        CodecHelper::writeSignedBlockPosition($out, $pk->blockPosition);
        $codec->structure()->editorData()->write($out, $pk->structureEditorData);
        CodecHelper::writeBool($out, $pk->isPowered);
        CodecHelper::writeBool($out, $pk->waterlogged);
    }
}