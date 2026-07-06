<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\Common\Serializer;

use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\Common\Serializer\Command\ChainedSubCommandDataSerializer;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\Common\Serializer\Command\CommandDataSerializer;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\Common\Serializer\Command\CommandEnumConstraintSerializer;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\Common\Serializer\Command\CommandEnumSerializer;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\Common\Serializer\Command\CommandOriginDataSerializer;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\Common\Serializer\Command\CommandOutputMessageSerializer;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\Common\Serializer\Command\CommandSoftEnumSerializer;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\Support\CloneWithProperty;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\Support\Forkable;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\Support\ForkableInterface;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;

class CommandSerializer implements ForkableInterface{
    use Forkable;
    use CloneWithProperty;

    public function __construct(
        private CommandEnumSerializer $enumSerializer,
        private ChainedSubCommandDataSerializer $chainedSubCommandSerializer,
        private CommandDataSerializer $commandDataSerializer,
        private CommandSoftEnumSerializer $softEnumSerializer,
        private CommandEnumConstraintSerializer $enumConstraintSerializer,
        private CommandOriginDataSerializer $originDataSerializer,
        private CommandOutputMessageSerializer $outputMessageSerializer
    ){}

    public function enum() : CommandEnumSerializer{ return $this->enumSerializer; }
    public function chainedSubCommand() : ChainedSubCommandDataSerializer{ return $this->chainedSubCommandSerializer; }
    public function commandData() : CommandDataSerializer{ return $this->commandDataSerializer; }
    public function softEnum() : CommandSoftEnumSerializer{ return $this->softEnumSerializer; }
    public function enumConstraint() : CommandEnumConstraintSerializer{ return $this->enumConstraintSerializer; }
    public function originData() : CommandOriginDataSerializer{ return $this->originDataSerializer; }
    public function outputMessage() : CommandOutputMessageSerializer{ return $this->outputMessageSerializer; }

    public function withEnum(CommandEnumSerializer $v) : self{ return $this->with('enumSerializer', $v); }
    public function withChainedSubCommand(ChainedSubCommandDataSerializer $v) : self{ return $this->with('chainedSubCommandSerializer', $v); }
    public function withCommandData(CommandDataSerializer $v) : self{ return $this->with('commandDataSerializer', $v); }
    public function withSoftEnum(CommandSoftEnumSerializer $v) : self{ return $this->with('softEnumSerializer', $v); }
    public function withEnumConstraint(CommandEnumConstraintSerializer $v) : self{ return $this->with('enumConstraintSerializer', $v); }
    public function withOriginData(CommandOriginDataSerializer $v) : self{ return $this->with('originDataSerializer', $v); }
    public function withOutputMessage(CommandOutputMessageSerializer $v) : self{ return $this->with('outputMessageSerializer', $v); }

    public function readEnumValues(ByteBufferReader $in) : array{
        return CodecHelper::readList($in, fn($in) => CodecHelper::readString($in));
    }

    public function writeEnumValues(ByteBufferWriter $out, array $values) : void{
        CodecHelper::writeList($out, $values, fn($out, $v) => CodecHelper::writeString($out, $v));
    }

    public function readChainedSubCommandValues(ByteBufferReader $in) : array{
        return CodecHelper::readList($in, fn($in) => CodecHelper::readString($in));
    }

    public function writeChainedSubCommandValues(ByteBufferWriter $out, array $values) : void{
        CodecHelper::writeList($out, $values, fn($out, $v) => CodecHelper::writeString($out, $v));
    }

    public function readPostfixes(ByteBufferReader $in) : array{
        return CodecHelper::readList($in, fn($in) => CodecHelper::readString($in));
    }

    public function writePostfixes(ByteBufferWriter $out, array $values) : void{
        CodecHelper::writeList($out, $values, fn($out, $v) => CodecHelper::writeString($out, $v));
    }
}