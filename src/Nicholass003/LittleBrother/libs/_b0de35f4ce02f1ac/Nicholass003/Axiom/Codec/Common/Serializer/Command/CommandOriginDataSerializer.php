<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Codec\Common\Serializer\Command;

use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Codec\Support\ForkableInterface;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Codec\Support\StatelessForkable;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Data\Type\Command\CommandOriginData;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Enum\CommandOriginType;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\VarInt;

class CommandOriginDataSerializer implements ForkableInterface{
    use StatelessForkable;

    public function read(ByteBufferReader $in) : CommandOriginData{
        $type = CommandOriginType::safe(VarInt::readUnsignedInt($in));
        $uuid = CodecHelper::readUuid($in);
        $requestId = CodecHelper::readString($in);

        $playerActorUniqueId = 0;
        if($type === CommandOriginType::DEV_CONSOLE || $type === CommandOriginType::TEST){
            $playerActorUniqueId = VarInt::readSignedLong($in);
        }

        return new CommandOriginData($type, $uuid, $requestId, $playerActorUniqueId);
    }

    public function write(ByteBufferWriter $out, CommandOriginData $data) : void{
        VarInt::writeUnsignedInt($out, $data->type->value);
        CodecHelper::writeUuid($out, $data->uuid);
        CodecHelper::writeString($out, $data->requestId);

        if($data->type === CommandOriginType::DEV_CONSOLE || $data->type === CommandOriginType::TEST){
            VarInt::writeSignedLong($out, $data->playerActorUniqueId);
        }
    }
}