<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Data\Type\Entity\UpdateAttribute;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Packet\Packet;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Packet\UpdateAttributesPacket;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;
use pmmp\encoding\VarInt;

class UpdateAttributesCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : UpdateAttributesPacket{
        $pk = new UpdateAttributesPacket();

        $pk->actorRuntimeId = CodecHelper::readActorRuntimeId($in);

        $count = VarInt::readUnsignedInt($in);
        for($i = 0; $i < $count; ++$i){
            $pk->entries[] = $this->readAttribute($in, $codec);
        }

        $pk->tick = VarInt::readUnsignedLong($in);

        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof UpdateAttributesPacket);

        CodecHelper::writeActorRuntimeId($out, $pk->actorRuntimeId);

        VarInt::writeUnsignedInt($out, count($pk->entries));
        foreach($pk->entries as $entry){
            $this->writeAttribute($out, $entry, $codec);
        }

        VarInt::writeUnsignedLong($out, $pk->tick);
    }

    protected function readAttribute(ByteBufferReader $in, CodecType $codec) : UpdateAttribute{
        $min = LE::readFloat($in);
        $max = LE::readFloat($in);
        $current = LE::readFloat($in);
        $defaultMin = LE::readFloat($in);
        $defaultMax = LE::readFloat($in);
        $default = LE::readFloat($in);
        $id = CodecHelper::readString($in);

        $modifiers = [];
        $count = VarInt::readUnsignedInt($in);
        for($i = 0; $i < $count; ++$i){
            $modifiers[] = $codec->attribute()->read($in);
        }

        return new UpdateAttribute(
            $id,
            $min,
            $max,
            $current,
            $defaultMin,
            $defaultMax,
            $default,
            $modifiers
        );
    }

    protected function writeAttribute(ByteBufferWriter $out, UpdateAttribute $attr, CodecType $codec) : void{
        LE::writeFloat($out, $attr->min);
        LE::writeFloat($out, $attr->max);
        LE::writeFloat($out, $attr->current);
        LE::writeFloat($out, $attr->defaultMin);
        LE::writeFloat($out, $attr->defaultMax);
        LE::writeFloat($out, $attr->default);
        CodecHelper::writeString($out, $attr->id);

        VarInt::writeUnsignedInt($out, count($attr->modifiers));
        foreach($attr->modifiers as $modifier){
            $codec->attribute()->write($out, $modifier);
        }
    }
}