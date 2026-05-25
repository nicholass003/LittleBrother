<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Data\Type\FeatureRegistryPacketEntry;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Packet\FeatureRegistryPacket;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Packet\Packet;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;

class FeatureRegistryCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : FeatureRegistryPacket{
        $pk = new FeatureRegistryPacket();
        $pk->entries = $this->readEntries($in);
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof FeatureRegistryPacket);
        $this->writeEntries($out, $pk->entries);
    }

    /**
     * @return list<FeatureRegistryPacketEntry>
     */
    protected function readEntries(ByteBufferReader $in) : array{
        return CodecHelper::readList($in, fn(ByteBufferReader $in) : FeatureRegistryPacketEntry => $this->readEntry($in));
    }

    /**
     * @param list<FeatureRegistryPacketEntry> $entries
     */
    protected function writeEntries(ByteBufferWriter $out, array $entries) : void{
        CodecHelper::writeList($out, $entries, function(ByteBufferWriter $out, FeatureRegistryPacketEntry $entry) : void{
            $this->writeEntry($out, $entry);
        });
    }

    protected function readEntry(ByteBufferReader $in) : FeatureRegistryPacketEntry{
        return new FeatureRegistryPacketEntry(
            CodecHelper::readString($in),
            CodecHelper::readString($in)
        );
    }

    protected function writeEntry(ByteBufferWriter $out, FeatureRegistryPacketEntry $entry) : void{
        CodecHelper::writeString($out, $entry->featureName);
        CodecHelper::writeString($out, $entry->featureJson);
    }
}