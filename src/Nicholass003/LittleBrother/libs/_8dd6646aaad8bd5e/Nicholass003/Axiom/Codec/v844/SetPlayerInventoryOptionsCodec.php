<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Enum\InventoryLayout;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Enum\InventoryLeftTab;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Enum\InventoryRightTab;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Packet\Packet;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Packet\SetPlayerInventoryOptionsPacket;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\VarInt;

class SetPlayerInventoryOptionsCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : SetPlayerInventoryOptionsPacket{
        $pk = new SetPlayerInventoryOptionsPacket();
        $pk->leftTab = InventoryLeftTab::safe(VarInt::readSignedInt($in));
        $pk->rightTab = InventoryRightTab::safe(VarInt::readSignedInt($in));
        $pk->filtering = CodecHelper::readBool($in);
        $pk->inventoryLayout = InventoryLayout::safe(VarInt::readSignedInt($in));
        $pk->craftingLayout = InventoryLayout::safe(VarInt::readSignedInt($in));
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof SetPlayerInventoryOptionsPacket);
        VarInt::writeSignedInt($out, $pk->leftTab->value);
        VarInt::writeSignedInt($out, $pk->rightTab->value);
        CodecHelper::writeBool($out, $pk->filtering);
        VarInt::writeSignedInt($out, $pk->inventoryLayout->value);
        VarInt::writeSignedInt($out, $pk->craftingLayout->value);
    }
}