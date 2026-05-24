<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Codec\v924;

use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\Type\SerializableVoxelCells;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\Type\SerializableVoxelShape;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Packet\Packet;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Packet\VoxelShapesPacket;
use pmmp\encoding\Byte;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;
use pmmp\encoding\VarInt;

class VoxelShapesCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : VoxelShapesPacket{
        $pk = new VoxelShapesPacket();
        $pk->shapes = CodecHelper::readList($in, fn($in) => $this->readVoxelShape($in));
        for($i = 0, $namesCount = VarInt::readUnsignedInt($in); $i < $namesCount; ++$i){
            $name = CodecHelper::readString($in);
            $id = LE::readUnsignedShort($in);
            $pk->nameMap[$name] = $id;
        }
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof VoxelShapesPacket);
        CodecHelper::writeList($out, $pk->shapes, fn($out, $v) => $this->writeVoxelShape($out, $v));
        foreach($pk->nameMap as $name => $id){
            CodecHelper::writeString($out, $name);
            LE::writeUnsignedShort($out, $id);
        }
    }

    protected function readVoxelShape(ByteBufferReader $in) : SerializableVoxelShape{
        $cells = CodecHelper::readList($in, fn($in) => $this->readVoxelCells($in));
        $xCoordinates = CodecHelper::readList($in, fn($in) => LE::readFloat($in));
        $yCoordinates = CodecHelper::readList($in, fn($in) => LE::readFloat($in));
        $zCoordinates = CodecHelper::readList($in, fn($in) => LE::readFloat($in));
        return new SerializableVoxelShape($cells, $xCoordinates, $yCoordinates, $zCoordinates);
    }

    protected function writeVoxelShape(ByteBufferWriter $out, SerializableVoxelShape $shape) : void{
        CodecHelper::writeList($out, $shape->cells, fn($out, $v) => $this->writeVoxelCells($out, $v));
        CodecHelper::writeList($out, $shape->xCoordinates, fn($out, $v) => LE::writeFloat($out, $v));
        CodecHelper::writeList($out, $shape->yCoordinates, fn($out, $v) => LE::writeFloat($out, $v));
        CodecHelper::writeList($out, $shape->zCoordinates, fn($out, $v) => LE::writeFloat($out, $v));
    }

    protected function readVoxelCells(ByteBufferReader $in) : SerializableVoxelCells{
        $xSize = Byte::readUnsigned($in);
        $ySize = Byte::readUnsigned($in);
        $zSize = Byte::readUnsigned($in);
        $storage = CodecHelper::readList($in, fn($in) => Byte::readUnsigned($in));
        return new SerializableVoxelCells($xSize, $ySize, $zSize, $storage);
    }

    protected function writeVoxelCells(ByteBufferWriter $out, SerializableVoxelCells $cell) : void{
        Byte::writeUnsigned($out, $cell->xSize);
        Byte::writeUnsigned($out, $cell->ySize);
        Byte::writeUnsigned($out, $cell->zSize);
        CodecHelper::writeList($out, $cell->storage, fn($out, $v) => Byte::writeUnsigned($out, $v));
    }
}