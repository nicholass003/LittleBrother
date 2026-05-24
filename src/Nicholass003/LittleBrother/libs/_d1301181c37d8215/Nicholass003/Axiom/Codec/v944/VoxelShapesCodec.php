<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Codec\v944;

use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Data\Type\SerializableVoxelCells;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Data\Type\SerializableVoxelShape;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Packet\Packet;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Packet\VoxelShapesPacket;
use pmmp\encoding\Byte;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;
use pmmp\encoding\VarInt;

class VoxelShapesCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : VoxelShapesPacket{
        $pk = new VoxelShapesPacket();
        $pk->shapes = CodecHelper::readList($in, $this->readVoxelShape(...));
        for($i = 0, $namesCount = VarInt::readUnsignedInt($in); $i < $namesCount; ++$i){
            $name = CodecHelper::readString($in);
            $id = LE::readUnsignedShort($in);
            $pk->nameMap[$name] = $id;
        }
        $pk->customShapeCount = LE::readUnsignedShort($in);
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof VoxelShapesPacket);
        CodecHelper::writeList($out, $pk->shapes, $this->writeVoxelShape(...));
        foreach($pk->nameMap as $name => $id){
            CodecHelper::writeString($out, $name);
            LE::writeUnsignedShort($out, $id);
        }
        LE::writeUnsignedShort($out, $pk->customShapeCount);
    }

    protected function readVoxelShape(ByteBufferReader $in) : SerializableVoxelShape{
        $cells = CodecHelper::readList($in, $this->readVoxelCells(...));
        $xCoordinates = CodecHelper::readList($in, LE::readFloat(...));
        $yCoordinates = CodecHelper::readList($in, LE::readFloat(...));
        $zCoordinates = CodecHelper::readList($in, LE::readFloat(...));
        return new SerializableVoxelShape($cells, $xCoordinates, $yCoordinates, $zCoordinates);
    }

    protected function writeVoxelShape(ByteBufferWriter $out, SerializableVoxelShape $shape) : void{
        CodecHelper::writeList($out, $shape->cells, $this->writeVoxelCells(...));
        CodecHelper::writeList($out, $shape->xCoordinates, LE::writeFloat(...));
        CodecHelper::writeList($out, $shape->yCoordinates, LE::writeFloat(...));
        CodecHelper::writeList($out, $shape->zCoordinates, LE::writeFloat(...));
    }

    protected function readVoxelCells(ByteBufferReader $in) : SerializableVoxelCells{
        $xSize = Byte::readUnsigned($in);
        $ySize = Byte::readUnsigned($in);
        $zSize = Byte::readUnsigned($in);
        $storage = CodecHelper::readList($in, Byte::readUnsigned(...));
        return new SerializableVoxelCells($xSize, $ySize, $zSize, $storage);
    }

    protected function writeVoxelCells(ByteBufferWriter $out, SerializableVoxelCells $cell) : void{
        Byte::writeUnsigned($out, $cell->xSize);
        Byte::writeUnsigned($out, $cell->ySize);
        Byte::writeUnsigned($out, $cell->zSize);
        CodecHelper::writeList($out, $cell->storage, Byte::writeUnsigned(...));
    }
}