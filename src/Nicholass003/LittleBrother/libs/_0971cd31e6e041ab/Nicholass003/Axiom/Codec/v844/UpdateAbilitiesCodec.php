<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\Type\AbilitiesData;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\Type\AbilitiesLayer;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Packet\Packet;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Packet\UpdateAbilitiesPacket;
use pmmp\encoding\Byte;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;

class UpdateAbilitiesCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : UpdateAbilitiesPacket{
        $pk = new UpdateAbilitiesPacket();
        $targetActorUniqueId = LE::readSignedLong($in);
        $playerPermission = Byte::readUnsigned($in);
        $commandPermission = Byte::readUnsigned($in);

        $layerCount = Byte::readUnsigned($in);
        $layers = [];
        for($i = 0; $i < $layerCount; ++$i){
            $layers[] = $this->readLayer($in);
        }

        $pk->data = new AbilitiesData(
            $commandPermission,
            $playerPermission,
            $targetActorUniqueId,
            $layers
        );
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof UpdateAbilitiesPacket);
        LE::writeSignedLong($out, $pk->data->targetActorUniqueId);
        Byte::writeUnsigned($out, $pk->data->playerPermission);
        Byte::writeUnsigned($out, $pk->data->commandPermission);
        Byte::writeUnsigned($out, count($pk->data->abilityLayers));
        foreach($pk->data->abilityLayers as $layer){
            $this->writeLayer($out, $layer);
        }
    }

    protected function readLayer(ByteBufferReader $in) : AbilitiesLayer{
        $layerId = LE::readUnsignedShort($in);
        $setAbilities = LE::readUnsignedInt($in);
        $setValues = LE::readUnsignedInt($in);
        $flySpeed = LE::readFloat($in);
        $verticalFlySpeed = LE::readFloat($in);
        $walkSpeed = LE::readFloat($in);

        $abilities = [];
        for($i = 0; $i < 20; $i++){
            if($i === 13 || $i === 14){
                continue;
            }

            if(($setAbilities & (1 << $i)) !== 0){
                $abilities[$i] = ($setValues & (1 << $i)) !== 0;
            }
        }

        if(($setAbilities & (1 << 13)) === 0){
            $flySpeed = null;
        }
        if(($setAbilities & (1 << 19)) === 0){
            $verticalFlySpeed = null;
        }
        if(($setAbilities & (1 << 14)) === 0){
            $walkSpeed = null;
        }

        return new AbilitiesLayer(
            $layerId,
            $abilities,
            $flySpeed,
            $verticalFlySpeed,
            $walkSpeed
        );
    }

    protected function writeLayer(ByteBufferWriter $out, AbilitiesLayer $layer) : void{
        LE::writeUnsignedShort($out, $layer->layerId);
        $setAbilities = 0;
        $setValues = 0;

        foreach($layer->abilities as $ability => $value){
            $setAbilities |= (1 << $ability);
            if($value){
                $setValues |= (1 << $ability);
            }
        }

        if($layer->flySpeed !== null){
            $setAbilities |= (1 << 13);
        }
        if($layer->verticalFlySpeed !== null){
            $setAbilities |= (1 << 19);
        }
        if($layer->walkSpeed !== null){
            $setAbilities |= (1 << 14);
        }

        LE::writeUnsignedInt($out, $setAbilities);
        LE::writeUnsignedInt($out, $setValues);
        LE::writeFloat($out, $layer->flySpeed ?? 0.0);
        LE::writeFloat($out, $layer->verticalFlySpeed ?? 0.0);
        LE::writeFloat($out, $layer->walkSpeed ?? 0.0);
    }
}