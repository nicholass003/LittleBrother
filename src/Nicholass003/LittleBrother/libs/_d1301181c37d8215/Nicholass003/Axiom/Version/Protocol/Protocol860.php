<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Version\Protocol;

use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Codec\CodecBuilder;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Version\ProtocolVersion;

class Protocol860 implements ProtocolInterface{

    public static function buildCodecType() : CodecType{
        return Protocol859::buildCodecType()->fork();
    }

    public static function build() : CodecBuilder{
        return Protocol859::build()->fork(ProtocolVersion::v860, "1.21.124");
    }
}