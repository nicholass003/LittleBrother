<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v944\Serializer\SubChunk;

use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\Common\Serializer\SubChunk\UpdateSubChunkBlocksPacketEntrySerializer as BaseUpdateSubChunkBlocksPacketEntrySerializer;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\Type\SubChunk\UpdateSubChunkBlocksPacketEntry;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\VarInt;

class UpdateSubChunkBlocksPacketEntrySerializer extends BaseUpdateSubChunkBlocksPacketEntrySerializer{

    public function read(ByteBufferReader $in) : UpdateSubChunkBlocksPacketEntry{
        $blockPosition = CodecHelper::readSignedBlockPosition($in);
        $blockRuntimeId = VarInt::readUnsignedInt($in);
        $flags = VarInt::readUnsignedInt($in);
        $syncedUpdateType = VarInt::readUnsignedInt($in);
        $actorUniqueId = CodecHelper::readActorUniqueId($in);

        return new UpdateSubChunkBlocksPacketEntry(
            $blockPosition, $blockRuntimeId, $flags, $syncedUpdateType, $actorUniqueId
        );
    }

    public function write(ByteBufferWriter $out, UpdateSubChunkBlocksPacketEntry $entry) : void{
        CodecHelper::writeSignedBlockPosition($out, $entry->blockPosition);
        VarInt::writeUnsignedInt($out, $entry->blockRuntimeId);
        VarInt::writeUnsignedInt($out, $entry->flags);
        VarInt::writeUnsignedInt($out, $entry->syncedUpdateType);
        CodecHelper::writeActorUniqueId($out, $entry->actorUniqueId);
    }

    /**
     * @return list<UpdateSubChunkBlocksPacketEntry>
     */
    public function readList(ByteBufferReader $in) : array{
        return CodecHelper::readList($in, fn($in) => $this->read($in));
    }

    /**
     * @param list<UpdateSubChunkBlocksPacketEntry> $entries
     */
    public function writeList(ByteBufferWriter $out, array $entries) : void{
        CodecHelper::writeList($out, $entries, fn($out, $e) => $this->write($out, $e));
    }
}