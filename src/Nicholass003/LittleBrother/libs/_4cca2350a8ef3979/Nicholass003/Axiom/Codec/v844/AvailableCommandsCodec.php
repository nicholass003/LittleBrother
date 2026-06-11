<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Packet\AvailableCommandsPacket;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Packet\Packet;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use function count;

class AvailableCommandsCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : AvailableCommandsPacket{
        $pk = new AvailableCommandsPacket();
        $pk->enumValues = $codec->command()->readEnumValues($in);
        $pk->chainedSubCommandValues = $codec->command()->readChainedSubCommandValues($in);
        $pk->postfixes = $codec->command()->readPostfixes($in);

        $valueListSize = count($pk->enumValues);
        $pk->enums = $codec->command()->enum()->readList($in, $valueListSize);
        $pk->chainedSubCommandData = $codec->command()->chainedSubCommand()->readList($in);
        $pk->commandData = $codec->command()->commandData()->readList($in);
        $pk->softEnums = $codec->command()->softEnum()->readList($in);
        $pk->enumConstraints = $codec->command()->enumConstraint()->readList($in);
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof AvailableCommandsPacket);
        $codec->command()->writeEnumValues($out, $pk->enumValues);
        $codec->command()->writeChainedSubCommandValues($out, $pk->chainedSubCommandValues);
        $codec->command()->writePostfixes($out, $pk->postfixes);

        $valueListSize = count($pk->enumValues);
        $codec->command()->enum()->writeList($out, $pk->enums, $valueListSize);
        $codec->command()->chainedSubCommand()->writeList($out, $pk->chainedSubCommandData);
        $codec->command()->commandData()->writeList($out, $pk->commandData);
        $codec->command()->softEnum()->writeList($out, $pk->softEnums);
        $codec->command()->enumConstraint()->writeList($out, $pk->enumConstraints);
    }
}