<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Packet\ContainerRegistryCleanupPacket;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Packet\Packet;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\VarInt;

class ContainerRegistryCleanupCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : ContainerRegistryCleanupPacket{
        $pk = new ContainerRegistryCleanupPacket();
        $count = VarInt::readUnsignedInt($in);
        for($i = 0; $i < $count; ++$i){
            $pk->removedContainers[] = $codec->inventory()->container()->read($in);
        }
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof ContainerRegistryCleanupPacket);
        VarInt::writeUnsignedInt($out, count($pk->removedContainers));
        foreach($pk->removedContainers as $container){
            $codec->inventory()->container()->write($out, $container);
        }
    }
}