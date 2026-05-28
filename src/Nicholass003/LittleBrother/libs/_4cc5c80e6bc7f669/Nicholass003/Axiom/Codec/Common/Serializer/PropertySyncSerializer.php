<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\Common\Serializer;

use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\Support\ForkableInterface;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\Support\StatelessForkable;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Data\Type\PropertySyncData;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;
use pmmp\encoding\VarInt;

class PropertySyncSerializer implements ForkableInterface{
    use StatelessForkable;

    public function read(ByteBufferReader $in) : PropertySyncData{
        $intProps = [];
        $count = VarInt::readUnsignedInt($in);
        for($i = 0; $i < $count; ++$i){
            $intProps[VarInt::readUnsignedInt($in)] = VarInt::readSignedInt($in);
        }
        $floatProps = [];
        $count = VarInt::readUnsignedInt($in);
        for($i = 0; $i < $count; ++$i){
            $floatProps[VarInt::readUnsignedInt($in)] = LE::readFloat($in);
        }
        return new PropertySyncData($intProps, $floatProps);
    }

    public function write(ByteBufferWriter $out, PropertySyncData $data) : void{
        VarInt::writeUnsignedInt($out, count($data->intProperties));
        foreach($data->intProperties as $k => $v){
            VarInt::writeUnsignedInt($out, $k);
            VarInt::writeSignedInt($out, $v);
        }
        VarInt::writeUnsignedInt($out, count($data->floatProperties));
        foreach($data->floatProperties as $k => $v){
            VarInt::writeUnsignedInt($out, $k);
            LE::writeFloat($out, $v);
        }
    }
}