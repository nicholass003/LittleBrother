<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\Common\Serializer;

use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\Support\ForkableInterface;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\Support\StatelessForkable;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Data\Type\NetworkPermissionsData;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;

class NetworkPermissionsSerializer implements ForkableInterface{
    use StatelessForkable;

    public function read(ByteBufferReader $in) : NetworkPermissionsData{
        return new NetworkPermissionsData(
            CodecHelper::readBool($in)
        );
    }

    public function write(ByteBufferWriter $out, NetworkPermissionsData $data) : void{
        CodecHelper::writeBool($out, $data->disableClientSounds);
    }
}