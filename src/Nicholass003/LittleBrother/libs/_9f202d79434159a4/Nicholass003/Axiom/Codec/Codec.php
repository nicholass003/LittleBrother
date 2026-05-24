<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec;

use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Packet\Packet;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;

interface Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : Packet;

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void;
}