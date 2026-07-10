<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Codec\v898;

use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\Type\Debug\DebugMarkerData;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Enum\ClientboundDebugRendererType;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Packet\ClientboundDebugRendererPacket;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Packet\Packet;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;

class ClientboundDebugRendererCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : ClientboundDebugRendererPacket{
        $pk = new ClientboundDebugRendererPacket();
        $rawType = CodecHelper::readString($in);
        $pk->type = ClientboundDebugRendererType::fromString($rawType);
        $pk->data = CodecHelper::readOptional($in, $this->readData(...));
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof ClientboundDebugRendererPacket);
        CodecHelper::writeString($out, $pk->type->toString());
        CodecHelper::writeOptional($out, $pk->data, $this->writeData(...));
    }

    protected function readData(ByteBufferReader $in) : DebugMarkerData{
        $text = CodecHelper::readString($in);
        $position = CodecHelper::readVec3($in);
        $color = LE::readUnsignedInt($in);
        $durationMillis = LE::readUnsignedLong($in);
        return new DebugMarkerData($text, $position, $color, $durationMillis);
    }

    protected function writeData(ByteBufferWriter $out, DebugMarkerData $data) : void{
        CodecHelper::writeString($out, $data->text);
        CodecHelper::writeVec3($out, $data->position);
        LE::writeUnsignedInt($out, $data->color);
        LE::writeUnsignedLong($out, $data->durationMillis);
    }
}