<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Codec\v898\Serializer\Command;

use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Codec\Common\Serializer\Command\CommandOriginDataSerializer as BaseCommandOriginDataSerializer;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Data\Type\Command\CommandOriginData;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Enum\CommandOriginType;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;

class CommandOriginDataSerializer extends BaseCommandOriginDataSerializer{

    public function read(ByteBufferReader $in) : CommandOriginData{
        $type = CommandOriginType::fromString(CodecHelper::readString($in));
        $uuid = CodecHelper::readUuid($in);
        $requestId = CodecHelper::readString($in);
        $playerActorUniqueId = LE::readSignedLong($in);
        return new CommandOriginData($type, $uuid, $requestId, $playerActorUniqueId);
    }

    public function write(ByteBufferWriter $out, CommandOriginData $data) : void{
        CodecHelper::writeString($out, $data->type->toString());
        CodecHelper::writeUuid($out, $data->uuid);
        CodecHelper::writeString($out, $data->requestId);
        LE::writeSignedLong($out, $data->playerActorUniqueId);
    }
}