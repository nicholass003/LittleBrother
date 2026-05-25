<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Version\Protocol;

use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Codec\CodecBuilder;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Codec\CodecType;

interface ProtocolInterface{

    public static function buildCodecType() : CodecType;

    public static function build() : CodecBuilder;
}