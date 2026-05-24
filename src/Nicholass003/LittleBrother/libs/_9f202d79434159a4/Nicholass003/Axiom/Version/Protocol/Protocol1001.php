<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Version\Protocol;

use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\CodecBuilder;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Version\ProtocolVersion;

class Protocol1001 implements ProtocolInterface{

    public static function buildCodecType() : CodecType{
        return Protocol975::buildCodecType()->fork();
    }

    public static function build() : CodecBuilder{
        return Protocol975::build()->fork(ProtocolVersion::v1001, "1.26.30");
    }
}