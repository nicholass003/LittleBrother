<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\Common\Serializer;

use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\Support\ForkableInterface;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\Support\StatelessForkable;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Data\Type\PlayerMovementSettingsData;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\VarInt;

class PlayerMovementSettingsSerializer implements ForkableInterface{
    use StatelessForkable;

    public function read(ByteBufferReader $in) : PlayerMovementSettingsData{
        return new PlayerMovementSettingsData(
            VarInt::readSignedInt($in),
            CodecHelper::readBool($in)
        );
    }

    public function write(ByteBufferWriter $out, PlayerMovementSettingsData $data) : void{
        VarInt::writeSignedInt($out, $data->rewindHistorySize);
        CodecHelper::writeBool($out, $data->serverAuthoritativeBlockBreaking);
    }
}