<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Data\Type\ResourcePack\ResourcePackStackEntry;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Packet\Packet;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Packet\ResourcePackStackPacket;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\VarInt;

class ResourcePackStackCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : ResourcePackStackPacket{
        $pk = new ResourcePackStackPacket();
        $pk->mustAccept = CodecHelper::readBool($in);

        $behaviorCount = VarInt::readUnsignedInt($in);
        for($i = 0; $i < $behaviorCount; ++$i){
            $pk->behaviorPackStack[] = $this->readEntry($in);
        }

        $resourceCount = VarInt::readUnsignedInt($in);
        for($i = 0; $i < $resourceCount; ++$i){
            $pk->resourcePackStack[] = $this->readEntry($in);
        }

        $pk->baseGameVersion = CodecHelper::readString($in);
        $pk->experiments = $codec->experiments()->read($in);
        $pk->useVanillaEditorPacks = CodecHelper::readBool($in);

        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof ResourcePackStackPacket);
        CodecHelper::writeBool($out, $pk->mustAccept);

        VarInt::writeUnsignedInt($out, count($pk->behaviorPackStack));
        foreach($pk->behaviorPackStack as $entry){
            $this->writeEntry($out, $entry);
        }

        VarInt::writeUnsignedInt($out, count($pk->resourcePackStack));
        foreach($pk->resourcePackStack as $entry){
            $this->writeEntry($out, $entry);
        }

        CodecHelper::writeString($out, $pk->baseGameVersion);
        $codec->experiments()->write($out, $pk->experiments);
        CodecHelper::writeBool($out, $pk->useVanillaEditorPacks);
    }

    protected function readEntry(ByteBufferReader $in) : ResourcePackStackEntry{
        return new ResourcePackStackEntry(
            CodecHelper::readString($in),
            CodecHelper::readString($in),
            CodecHelper::readString($in)
        );
    }

    protected function writeEntry(ByteBufferWriter $out, ResourcePackStackEntry $entry) : void{
        CodecHelper::writeString($out, $entry->packId);
        CodecHelper::writeString($out, $entry->version);
        CodecHelper::writeString($out, $entry->subPackName);
    }
}