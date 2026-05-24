<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Data\Type\Inventory\StackRequest\ItemStackRequest;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Packet\ItemStackRequestPacket;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Packet\Packet;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;

class ItemStackRequestCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : ItemStackRequestPacket{
        $pk = new ItemStackRequestPacket();
        $pk->requests = CodecHelper::readList($in, fn(ByteBufferReader $in) => $codec->inventory()->request()->read($in, $codec));
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof ItemStackRequestPacket);
        CodecHelper::writeList($out, $pk->requests, function(ByteBufferWriter $out, ItemStackRequest $request) use($codec) : void{
            $codec->inventory()->request()->write($out, $request, $codec);
        });
    }
}