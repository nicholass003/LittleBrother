<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\Common\Serializer\Enchant;

use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\Support\ForkableInterface;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\Support\StatelessForkable;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Data\Type\Enchant\Enchant;
use pmmp\encoding\Byte;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;

class EnchantSerializer implements ForkableInterface{
    use StatelessForkable;

    public function read(ByteBufferReader $in) : Enchant{
        $id = Byte::readUnsigned($in);
        $level = Byte::readUnsigned($in);
        return new Enchant($id, $level);
    }

    public function write(ByteBufferWriter $out, Enchant $enchant) : void{
        Byte::writeUnsigned($out, $enchant->id);
        Byte::writeUnsigned($out, $enchant->level);
    }
}