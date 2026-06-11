<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Data\Type\ResourcePack\ResourcePackInfoEntry;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Packet\Packet;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Packet\ResourcePacksInfoPacket;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;

class ResourcePacksInfoCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : ResourcePacksInfoPacket{
        $pk = new ResourcePacksInfoPacket();
        $pk->mustAccept = CodecHelper::readBool($in);
        $pk->hasAddons = CodecHelper::readBool($in);
        $pk->hasScripts = CodecHelper::readBool($in);
        $pk->forceDisableVibrantVisuals = CodecHelper::readBool($in);
        $pk->worldTemplateId = CodecHelper::readUUID($in);
        $pk->worldTemplateVersion = CodecHelper::readString($in);

        $count = LE::readUnsignedShort($in);
        for($i = 0; $i < $count; ++$i){
            $pk->resourcePackEntries[] = $this->readEntry($in);
        }

        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof ResourcePacksInfoPacket);
        CodecHelper::writeBool($out, $pk->mustAccept);
        CodecHelper::writeBool($out, $pk->hasAddons);
        CodecHelper::writeBool($out, $pk->hasScripts);
        CodecHelper::writeBool($out, $pk->forceDisableVibrantVisuals);
        CodecHelper::writeUUID($out, $pk->worldTemplateId);
        CodecHelper::writeString($out, $pk->worldTemplateVersion);

        LE::writeUnsignedShort($out, count($pk->resourcePackEntries));
        foreach($pk->resourcePackEntries as $entry){
            $this->writeEntry($out, $entry);
        }
    }

    protected function readEntry(ByteBufferReader $in) : ResourcePackInfoEntry{
        return new ResourcePackInfoEntry(
            CodecHelper::readUUID($in),
            CodecHelper::readString($in),
            LE::readUnsignedLong($in),
            CodecHelper::readString($in),
            CodecHelper::readString($in),
            CodecHelper::readString($in),
            CodecHelper::readBool($in),
            CodecHelper::readBool($in),
            CodecHelper::readBool($in),
            CodecHelper::readString($in)
        );
    }

    protected function writeEntry(ByteBufferWriter $out, ResourcePackInfoEntry $entry) : void{
        CodecHelper::writeUUID($out, $entry->packId);
        CodecHelper::writeString($out, $entry->version);
        LE::writeUnsignedLong($out, $entry->sizeBytes);
        CodecHelper::writeString($out, $entry->encryptionKey);
        CodecHelper::writeString($out, $entry->subPackName);
        CodecHelper::writeString($out, $entry->contentId);
        CodecHelper::writeBool($out, $entry->hasScripts);
        CodecHelper::writeBool($out, $entry->isAddonPack);
        CodecHelper::writeBool($out, $entry->isRtxCapable);
        CodecHelper::writeString($out, $entry->cdnUrl);
    }
}