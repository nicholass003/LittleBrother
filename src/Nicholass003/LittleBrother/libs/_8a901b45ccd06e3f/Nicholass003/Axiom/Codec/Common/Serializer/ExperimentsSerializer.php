<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\Common\Serializer;

use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\Support\ForkableInterface;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\Support\StatelessForkable;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Data\Type\Experiments;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;

class ExperimentsSerializer implements ForkableInterface{
    use StatelessForkable;

    public function read(ByteBufferReader $in) : Experiments{
        $experiments = [];
        $count = LE::readUnsignedInt($in);
        for($i = 0; $i < $count; ++$i){
            $name = CodecHelper::readString($in);
            $enabled = CodecHelper::readBool($in);
            $experiments[$name] = $enabled;
        }
        $hasPreviouslyUsed = CodecHelper::readBool($in);
        return new Experiments($experiments, $hasPreviouslyUsed);
    }

    public function write(ByteBufferWriter $out, Experiments $exp) : void{
        LE::writeUnsignedInt($out, count($exp->experiments));
        foreach($exp->experiments as $name => $enabled){
            CodecHelper::writeString($out, $name);
            CodecHelper::writeBool($out, $enabled);
        }
        CodecHelper::writeBool($out, $exp->hasPreviouslyUsedExperiments);
    }
}