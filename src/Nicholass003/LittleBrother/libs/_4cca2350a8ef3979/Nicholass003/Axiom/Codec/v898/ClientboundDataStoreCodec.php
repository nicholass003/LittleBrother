<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\v898;

use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\v898\Trait\DataStoreSerializationTrait;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Enum\DataStoreType;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Packet\ClientboundDataStorePacket;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Packet\Packet;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\VarInt;

class ClientboundDataStoreCodec implements Codec{
    use DataStoreSerializationTrait;

    public function decode(ByteBufferReader $in, CodecType $codec) : ClientboundDataStorePacket{
        $pk = new ClientboundDataStorePacket();

        $count = VarInt::readUnsignedInt($in);
        for($i = 0; $i < $count; ++$i){
            $type = VarInt::readUnsignedInt($in);
            $pk->values[] = $this->readDataStore($in, DataStoreType::safe($type));
        }

        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof ClientboundDataStorePacket);

        VarInt::writeUnsignedInt($out, count($pk->values));
        foreach($pk->values as $value){
            VarInt::writeUnsignedInt($out, $this->getDataStoreType($value)->value);
            $this->writeDataStore($out, $value);
        }
    }
}