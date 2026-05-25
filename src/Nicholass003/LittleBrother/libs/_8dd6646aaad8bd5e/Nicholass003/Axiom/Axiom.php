<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom;

use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Codec\CodecBuilder;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Version\Protocol\Protocol844;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Version\Protocol\Protocol859;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Version\Protocol\Protocol860;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Version\Protocol\Protocol898;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Version\Protocol\Protocol924;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Version\Protocol\Protocol944;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Version\Protocol\Protocol975;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Version\ProtocolVersion;

class Axiom{

    /** @var array<int, CodecBuilder> */
    private static array $cache = [];

    public static function for(int $protocol) : CodecBuilder{
        $version = ProtocolVersion::tryFrom($protocol) ?? throw new \InvalidArgumentException("Unsupported protocol: $protocol");

        if(isset(self::$cache[$protocol])){
            return self::$cache[$protocol];
        }

        $builder = match($version){
            ProtocolVersion::v844 => Protocol844::build(),
            ProtocolVersion::v859 => Protocol859::build(),
            ProtocolVersion::v860 => Protocol860::build(),
            ProtocolVersion::v898 => Protocol898::build(),
            ProtocolVersion::v924 => Protocol924::build(),
            ProtocolVersion::v944 => Protocol944::build(),
            ProtocolVersion::v975 => Protocol975::build(),
            default => throw new \InvalidArgumentException("Protocol $protocol not yet implemented in Axiom"),
        };
        return self::$cache[$protocol] = $builder;
    }

    public static function clearCache() : void{
        self::$cache = [];
    }
}