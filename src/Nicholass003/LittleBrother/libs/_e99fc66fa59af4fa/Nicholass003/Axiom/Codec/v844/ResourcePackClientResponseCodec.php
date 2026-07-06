<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Enum\ResourcePackClientResponseStatus;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Packet\Packet;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Packet\ResourcePackClientResponsePacket;
use pmmp\encoding\Byte;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;
use function count;

class ResourcePackClientResponseCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : ResourcePackClientResponsePacket{
        $pk = new ResourcePackClientResponsePacket();
        $pk->status = ResourcePackClientResponseStatus::safe(Byte::readUnsigned($in));
        $count = LE::readUnsignedShort($in);
        for($i = 0; $i < $count; $i++){
            $pk->packIds[] = CodecHelper::readString($in);
        }
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof ResourcePackClientResponsePacket);
        Byte::writeUnsigned($out, $pk->status->value);
        LE::writeUnsignedShort($out, count($pk->packIds));
        foreach($pk->packIds as $id){
            CodecHelper::writeString($out, $id);
        }
    }
}