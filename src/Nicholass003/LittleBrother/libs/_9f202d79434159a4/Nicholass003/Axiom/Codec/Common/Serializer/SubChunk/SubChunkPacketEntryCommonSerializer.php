<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\Common\Serializer\SubChunk;

use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\Support\CloneWithProperty;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\Support\Forkable;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\Support\ForkableInterface;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Data\Type\SubChunk\SubChunkPacketEntryCommon;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Data\Type\SubChunk\SubChunkPacketHeightMapInfo;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Enum\SubChunkPacketHeightMapType;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Enum\SubChunkRequestResult;
use pmmp\encoding\Byte;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;

class SubChunkPacketEntryCommonSerializer implements ForkableInterface{
    use Forkable;
    use CloneWithProperty;

    public function __construct(
        private SubChunkPacketHeightMapInfoSerializer $heightMapSerializer
    ){}

    public function heightMap() : SubChunkPacketHeightMapInfoSerializer{ return $this->heightMapSerializer; }

    public function withHeightMap(SubChunkPacketHeightMapInfoSerializer $v) : self{ return $this->with('heightMapSerializer', $v); }

    public function read(ByteBufferReader $in, bool $cacheEnabled) : SubChunkPacketEntryCommon{
        $offset = CodecHelper::readSubChunkOffset($in);
        $requestResult = Byte::readUnsigned($in);

        $terrainData = (!$cacheEnabled || $requestResult !== SubChunkRequestResult::SUCCESS_ALL_AIR) ? CodecHelper::readString($in) : "";

        $heightMap = $this->readHeightMap($in);
        $renderHeightMap = $this->readRenderHeightMap($in, $heightMap);

        return new SubChunkPacketEntryCommon($offset, $requestResult, $terrainData, $heightMap, $renderHeightMap);
    }

    public function write(ByteBufferWriter $out, SubChunkPacketEntryCommon $entry, bool $cacheEnabled) : void{
        CodecHelper::writeSubChunkOffset($out, $entry->offset);
        Byte::writeUnsigned($out, $entry->requestResult);

        if(!$cacheEnabled || $entry->requestResult !== SubChunkRequestResult::SUCCESS_ALL_AIR){
            CodecHelper::writeString($out, $entry->terrainData);
        }

        $this->writeHeightMap($out, $entry->heightMap);
        $this->writeRenderHeightMap($out, $entry->renderHeightMap, $entry->heightMap);
    }

    private function readHeightMap(ByteBufferReader $in) : ?SubChunkPacketHeightMapInfo{
        $type = Byte::readUnsigned($in);
        return match($type){
            SubChunkPacketHeightMapType::NO_DATA => null,
            SubChunkPacketHeightMapType::DATA => $this->heightMapSerializer->read($in),
            SubChunkPacketHeightMapType::ALL_TOO_HIGH => new SubChunkPacketHeightMapInfo(array_fill(0, 256, 16)),
            SubChunkPacketHeightMapType::ALL_TOO_LOW => new SubChunkPacketHeightMapInfo(array_fill(0, 256, -1)),
            default => throw new \RuntimeException("Unknown heightmap data type $type")
        };
    }

    private function readRenderHeightMap(ByteBufferReader $in, ?SubChunkPacketHeightMapInfo $heightMap) : ?SubChunkPacketHeightMapInfo{
        $type = Byte::readUnsigned($in);
        return match($type){
            SubChunkPacketHeightMapType::NO_DATA => null,
            SubChunkPacketHeightMapType::DATA => $this->heightMapSerializer->read($in),
            SubChunkPacketHeightMapType::ALL_TOO_HIGH => new SubChunkPacketHeightMapInfo(array_fill(0, 256, 16)),
            SubChunkPacketHeightMapType::ALL_TOO_LOW => new SubChunkPacketHeightMapInfo(array_fill(0, 256, -1)),
            SubChunkPacketHeightMapType::ALL_COPIED => $heightMap,
            default => throw new \RuntimeException("Unknown render heightmap data type $type")
        };
    }

    private function writeHeightMap(ByteBufferWriter $out, ?SubChunkPacketHeightMapInfo $info) : void{
        if($info === null){
            Byte::writeUnsigned($out, SubChunkPacketHeightMapType::NO_DATA->value);
            return;
        }

        $allTooLow = true;
        $allTooHigh = true;
        foreach($info->heights as $h){
            if($h >= 0) $allTooLow = false;
            if($h <= 15) $allTooHigh = false;
        }

        if($allTooLow){
            Byte::writeUnsigned($out, SubChunkPacketHeightMapType::ALL_TOO_LOW->value);
        }elseif($allTooHigh){
            Byte::writeUnsigned($out, SubChunkPacketHeightMapType::ALL_TOO_HIGH->value);
        }else{
            Byte::writeUnsigned($out, SubChunkPacketHeightMapType::DATA->value);
            $this->heightMapSerializer->write($out, $info);
        }
    }

    private function writeRenderHeightMap(ByteBufferWriter $out, ?SubChunkPacketHeightMapInfo $info, ?SubChunkPacketHeightMapInfo $heightMap) : void{
        if($info === null){
            Byte::writeUnsigned($out, SubChunkPacketHeightMapType::ALL_COPIED->value);
            return;
        }

        $allTooLow = true;
        $allTooHigh = true;
        foreach($info->heights as $h){
            if($h >= 0) $allTooLow = false;
            if($h <= 15) $allTooHigh = false;
        }

        if($allTooLow){
            Byte::writeUnsigned($out, SubChunkPacketHeightMapType::ALL_TOO_LOW->value);
        }elseif($allTooHigh){
            Byte::writeUnsigned($out, SubChunkPacketHeightMapType::ALL_TOO_HIGH->value);
        }else{
            Byte::writeUnsigned($out, SubChunkPacketHeightMapType::DATA->value);
            $this->heightMapSerializer->write($out, $info);
        }
    }
}