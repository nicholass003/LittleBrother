<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v898\Serializer\Command;

use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\Common\Serializer\Command\CommandOutputMessageSerializer as BaseCommandOutputMessageSerializer;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\Type\Command\CommandOutputMessage;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;

class CommandOutputMessageSerializer extends BaseCommandOutputMessageSerializer{

    public function read(ByteBufferReader $in) : CommandOutputMessage{
        $messageId = CodecHelper::readString($in);
        $isInternal = CodecHelper::readBool($in);
        $params = CodecHelper::readList($in, fn($in) => CodecHelper::readString($in));
        return new CommandOutputMessage($isInternal, $messageId, $params);
    }

    public function write(ByteBufferWriter $out, CommandOutputMessage $msg) : void{
        CodecHelper::writeString($out, $msg->messageId);
        CodecHelper::writeBool($out, $msg->isInternal);
        CodecHelper::writeList($out, $msg->parameters, fn($out, $p) => CodecHelper::writeString($out, $p));
    }
}