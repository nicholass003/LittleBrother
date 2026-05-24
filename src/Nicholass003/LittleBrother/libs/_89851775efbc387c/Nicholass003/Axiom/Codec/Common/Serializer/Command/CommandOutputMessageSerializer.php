<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\Command;

use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Support\ForkableInterface;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Support\StatelessForkable;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Data\Type\Command\CommandOutputMessage;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;

class CommandOutputMessageSerializer implements ForkableInterface{
    use StatelessForkable;

    public function read(ByteBufferReader $in) : CommandOutputMessage{
        $isInternal = CodecHelper::readBool($in);
        $messageId = CodecHelper::readString($in);
        $params = CodecHelper::readList($in, fn($in) => CodecHelper::readString($in));
        return new CommandOutputMessage($isInternal, $messageId, $params);
    }

    public function write(ByteBufferWriter $out, CommandOutputMessage $msg) : void{
        CodecHelper::writeBool($out, $msg->isInternal);
        CodecHelper::writeString($out, $msg->messageId);
        CodecHelper::writeList($out, $msg->parameters, fn($out, $p) => CodecHelper::writeString($out, $p));
    }

    /**
     * @return list<CommandOutputMessage>
     */
    public function readList(ByteBufferReader $in) : array{
        return CodecHelper::readList($in, fn($in) => $this->read($in));
    }

    /**
     * @param list<CommandOutputMessage> $messages
     */
    public function writeList(ByteBufferWriter $out, array $messages) : void{
        CodecHelper::writeList($out, $messages, fn($out, $msg) => $this->write($out, $msg));
    }
}