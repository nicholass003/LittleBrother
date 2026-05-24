<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Data\Type\PackSetting\BoolPackSetting;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Data\Type\PackSetting\FloatPackSetting;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Data\Type\PackSetting\StringPackSetting;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Enum\PackSettingType;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Packet\Packet;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Packet\ServerboundPackSettingChangePacket;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;
use pmmp\encoding\VarInt;

class ServerboundPackSettingChangeCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : ServerboundPackSettingChangePacket{
        $pk = new ServerboundPackSettingChangePacket();
        $pk->packId = CodecHelper::readUuid($in);

        $name = CodecHelper::readString($in);
        $typeId = PackSettingType::safe(VarInt::readUnsignedInt($in));

        $pk->packSetting = match($typeId){
            PackSettingType::FLOAT => new FloatPackSetting($name, LE::readFloat($in)),
            PackSettingType::BOOL => new BoolPackSetting($name, CodecHelper::readBool($in)),
            PackSettingType::STRING => new StringPackSetting($name, CodecHelper::readString($in)),
        };

        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof ServerboundPackSettingChangePacket);
        CodecHelper::writeUuid($out, $pk->packId);
        CodecHelper::writeString($out, $pk->packSetting->name);

        $type = match(true){
            $pk->packSetting instanceof FloatPackSetting => PackSettingType::FLOAT,
            $pk->packSetting instanceof BoolPackSetting => PackSettingType::BOOL,
            $pk->packSetting instanceof StringPackSetting => PackSettingType::STRING,
            default => throw new \LogicException("Unknown pack setting type")
        };
        VarInt::writeUnsignedInt($out, $type->value);

        match(true){
            $pk->packSetting instanceof FloatPackSetting => LE::writeFloat($out, $pk->packSetting->value),
            $pk->packSetting instanceof BoolPackSetting => CodecHelper::writeBool($out, $pk->packSetting->value),
            $pk->packSetting instanceof StringPackSetting => CodecHelper::writeString($out, $pk->packSetting->value),
        };
    }
}