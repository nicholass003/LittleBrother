<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\v1001;

use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Data\Type\Inventory\InventoryTransactionChangedSlotsHack;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Packet\InventoryTransactionPacket;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Packet\Packet;
use pmmp\encoding\Byte;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\VarInt;

class InventoryTransactionCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : InventoryTransactionPacket{
        $pk = new InventoryTransactionPacket();
        $pk->requestId = VarInt::readSignedInt($in);
        $pk->requestChangedSlots = [];
        $pk->hasLegacySetSlots = CodecHelper::readBool($in);
        if($pk->hasLegacySetSlots){
            if($pk->requestId !== 0){
                $pk->requestChangedSlots = CodecHelper::readList($in, function(ByteBufferReader $in) : InventoryTransactionChangedSlotsHack{
                    return new InventoryTransactionChangedSlotsHack(
                        Byte::readUnsigned($in),
                        CodecHelper::readList($in, fn($in) => Byte::readUnsigned($in))
                    );
                });
            }
        }

        $pk->hasTransactionData = CodecHelper::readBool($in);

        $pk->trData = $codec->inventory()->transaction()->read($in, $codec);

        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof InventoryTransactionPacket);
        VarInt::writeSignedInt($out, $pk->requestId);
        if($pk->requestId !== 0){
            CodecHelper::writeBool($out, true);
            CodecHelper::writeList($out, $pk->requestChangedSlots, function(ByteBufferWriter $out, InventoryTransactionChangedSlotsHack $changed) : void{
                Byte::writeUnsigned($out, $changed->containerId);
                CodecHelper::writeList($out, $changed->changedSlotIndexes, fn($out, $index) => Byte::writeUnsigned($out, $index));
            });
        }else{
            CodecHelper::writeBool($out, false);
        }

        CodecHelper::writeBool($out, true);

        $codec->inventory()->transaction()->write($out, $pk->trData, $codec);
    }
}