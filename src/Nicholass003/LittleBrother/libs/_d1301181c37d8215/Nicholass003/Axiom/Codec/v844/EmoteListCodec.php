<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Packet\EmoteListPacket;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Packet\Packet;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;

class EmoteListCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : EmoteListPacket{
        $pk = new EmoteListPacket();
        $pk->playerActorRuntimeId = CodecHelper::readActorRuntimeId($in);
        $pk->emoteIds = $this->readEmoteIds($in);
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof EmoteListPacket);
        CodecHelper::writeActorRuntimeId($out, $pk->playerActorRuntimeId);
        $this->writeEmoteIds($out, $pk->emoteIds);
    }

    /**
     * @return list<string>
     */
    protected function readEmoteIds(ByteBufferReader $in) : array{
        return CodecHelper::readList($in, static fn(ByteBufferReader $in) : string => CodecHelper::readUuid($in));
    }

    /**
     * @param list<string> $emoteIds
     */
    protected function writeEmoteIds(ByteBufferWriter $out, array $emoteIds) : void{
        CodecHelper::writeList($out, $emoteIds, static function(ByteBufferWriter $out, string $emoteId) : void{
            CodecHelper::writeUuid($out, $emoteId);
        });
    }
}