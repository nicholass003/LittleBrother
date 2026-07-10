<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Codec\v1001;

use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Codec\v975\ServerPresenceInfoCodec as V975ServerPresenceInfoCodec;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\Type\PresenceConfig;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;

class ServerPresenceInfoCodec extends V975ServerPresenceInfoCodec{

    protected function readPresenceConfig(ByteBufferReader $in) : PresenceConfig{
        $experienceName = CodecHelper::readString($in);
        $worldName = CodecHelper::readString($in);
        $richPresenceId = CodecHelper::readString($in);
        return new PresenceConfig($experienceName, $worldName, $richPresenceId);
    }

    protected function writePresenceConfig(ByteBufferWriter $out, PresenceConfig $data) : void{
        CodecHelper::writeString($out, $data->experienceName);
        CodecHelper::writeString($out, $data->worldName);
        CodecHelper::writeString($out, $data->richPresenceId);
    }
}