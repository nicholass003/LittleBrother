<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Codec\v898;

use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Codec\v898\Serializer\Command\ChainedSubCommandDataSerializer;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Codec\v898\Serializer\Command\CommandEnumSerializer;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Packet\AvailableCommandsPacket;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Packet\Packet;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;

class AvailableCommandsCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : AvailableCommandsPacket{
        $enum = $codec->command()->enum();
        $chainedSubCommand = $codec->command()->chainedSubCommand();
        assert($enum instanceof CommandEnumSerializer);
        assert($chainedSubCommand instanceof ChainedSubCommandDataSerializer);
        $pk = new AvailableCommandsPacket();
        $pk->enumValues = $codec->command()->readEnumValues($in);
        $pk->chainedSubCommandValues = $codec->command()->readChainedSubCommandValues($in);
        $pk->postfixes = $codec->command()->readPostfixes($in);
        $pk->enums = $enum->readList($in);
        $pk->chainedSubCommandData = $chainedSubCommand->readList($in);
        $pk->commandData = $codec->command()->commandData()->readList($in);
        $pk->softEnums = $codec->command()->softEnum()->readList($in);
        $pk->enumConstraints = $codec->command()->enumConstraint()->readList($in);
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof AvailableCommandsPacket);
        $enum = $codec->command()->enum();
        $chainedSubCommand = $codec->command()->chainedSubCommand();
        assert($enum instanceof CommandEnumSerializer);
        assert($chainedSubCommand instanceof ChainedSubCommandDataSerializer);
        $codec->command()->writeEnumValues($out, $pk->enumValues);
        $codec->command()->writeChainedSubCommandValues($out, $pk->chainedSubCommandValues);
        $codec->command()->writePostfixes($out, $pk->postfixes);
        $enum->writeList($out, $pk->enums);
        $chainedSubCommand->writeList($out, $pk->chainedSubCommandData);
        $codec->command()->commandData()->writeList($out, $pk->commandData);
        $codec->command()->softEnum()->writeList($out, $pk->softEnums);
        $codec->command()->enumConstraint()->writeList($out, $pk->enumConstraints);
    }
}