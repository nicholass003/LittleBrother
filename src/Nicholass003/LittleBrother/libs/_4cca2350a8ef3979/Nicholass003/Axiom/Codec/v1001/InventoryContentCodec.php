<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\v1001;

use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Data\Type\ItemStackWrapper;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Packet\InventoryContentPacket;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Packet\Packet;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\VarInt;

class InventoryContentCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : InventoryContentPacket{
        $pk = new InventoryContentPacket();
        $pk->windowId = VarInt::readUnsignedInt($in);
        $pk->items = $this->readItemStackWrappers($in);
        $pk->containerName = $codec->inventory()->container()->read($in);
        $pk->storage = CodecHelper::readNetworkItemStackDescriptor($in);
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof InventoryContentPacket);
        VarInt::writeUnsignedInt($out, $pk->windowId);
        $this->writeItemStackWrappers($out, $pk->items);
        $codec->inventory()->container()->write($out, $pk->containerName);
        CodecHelper::writeNetworkItemStackDescriptor($out, $pk->storage);
    }

    /**
     * @return list<ItemStackWrapper>
     */
    protected function readItemStackWrappers(ByteBufferReader $in) : array{
        return CodecHelper::readList($in, CodecHelper::readNetworkItemStackDescriptor(...));
    }

    /**
     * @param list<ItemStackWrapper> $items
     */
    protected function writeItemStackWrappers(ByteBufferWriter $out, array $items) : void{
        CodecHelper::writeList($out, $items, CodecHelper::writeNetworkItemStackDescriptor(...));
    }
}