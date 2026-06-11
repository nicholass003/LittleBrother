<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Packet\NetworkChunkPublisherUpdatePacket;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Packet\Packet;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;
use pmmp\encoding\VarInt;

class NetworkChunkPublisherUpdateCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : NetworkChunkPublisherUpdatePacket{
        $pk = new NetworkChunkPublisherUpdatePacket();
        $pk->blockPosition = CodecHelper::readSignedBlockPosition($in);
        $pk->radius = VarInt::readUnsignedInt($in);

        $count = LE::readUnsignedInt($in);
        if($count > NetworkChunkPublisherUpdatePacket::MAX_SAVED_CHUNKS){
            throw new \RuntimeException("Expected at most " . NetworkChunkPublisherUpdatePacket::MAX_SAVED_CHUNKS . " saved chunks, got " . $count);
        }
		for($i = 0, $pk->savedChunks = []; $i < $count; $i++){
			$pk->savedChunks[] = CodecHelper::readChunkPosition($in);
		}
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof NetworkChunkPublisherUpdatePacket);
		CodecHelper::writeSignedBlockPosition($out, $pk->blockPosition);
		VarInt::writeUnsignedInt($out, $pk->radius);

		LE::writeUnsignedInt($out, count($pk->savedChunks));
		foreach($pk->savedChunks as $chunk){
			CodecHelper::writeChunkPosition($out, $chunk);
		}
    }
}