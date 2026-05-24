<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\Common\Serializer\Command;

use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\Support\CloneWithProperty;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\Support\Forkable;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\Support\ForkableInterface;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Data\Type\Command\CommandOverloadRawData;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;

class CommandOverloadSerializer implements ForkableInterface{
    use Forkable;
    use CloneWithProperty;

    public function __construct(
        private CommandParameterSerializer $parameterSerializer
    ){}

    public function parameter() : CommandParameterSerializer{ return $this->parameterSerializer; }

    public function withParameter(CommandParameterSerializer $v) : self{ return $this->with('parameterSerializer', $v); }

    public function read(ByteBufferReader $in) : CommandOverloadRawData{
        $chaining = CodecHelper::readBool($in);
        $parameters = $this->parameterSerializer->readList($in);
        return new CommandOverloadRawData($chaining, $parameters);
    }

    public function write(ByteBufferWriter $out, CommandOverloadRawData $overload) : void{
        CodecHelper::writeBool($out, $overload->chaining);
        $this->parameterSerializer->writeList($out, $overload->parameters);
    }

    /**
     * @return list<CommandOverloadRawData>
     */
    public function readList(ByteBufferReader $in) : array{
        return CodecHelper::readList($in, fn($in) => $this->read($in));
    }

    /**
     * @param list<CommandOverloadRawData> $overloads
     */
    public function writeList(ByteBufferWriter $out, array $overloads) : void{
        CodecHelper::writeList($out, $overloads, fn($out, $o) => $this->write($out, $o));
    }
}