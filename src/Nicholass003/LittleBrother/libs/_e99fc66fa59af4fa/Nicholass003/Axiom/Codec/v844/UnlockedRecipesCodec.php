<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Enum\UnlockedRecipesType;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Packet\Packet;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Packet\UnlockedRecipesPacket;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;

class UnlockedRecipesCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : UnlockedRecipesPacket{
        $pk = new UnlockedRecipesPacket();
        $pk->type = UnlockedRecipesType::safe(LE::readUnsignedInt($in));
        $pk->recipes = CodecHelper::readList($in, fn($in) => CodecHelper::readString($in));
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof UnlockedRecipesPacket);
        LE::writeUnsignedInt($out, $pk->type->value);
        CodecHelper::writeList($out, $pk->recipes, fn($out, $s) => CodecHelper::writeString($out, $s));
    }
}