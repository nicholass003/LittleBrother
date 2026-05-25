<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Packet\Packet;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Packet\PlayerEnchantOptionsPacket;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;

class PlayerEnchantOptionsCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : PlayerEnchantOptionsPacket{
        $pk = new PlayerEnchantOptionsPacket();
        $pk->options = $codec->enchantment()->option()->readList($in);
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof PlayerEnchantOptionsPacket);
        $codec->enchantment()->option()->writeList($out, $pk->options);
    }
}