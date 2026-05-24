<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\v924;

use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\v898\ClientboundDataStoreCodec as V898ClientboundDataStoreCodec;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Data\Type\DataStore\DataStoreUpdate;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;

class ClientboundDataStoreCodec extends V898ClientboundDataStoreCodec{

    protected function readUpdate(ByteBufferReader $in) : DataStoreUpdate{
        $name = CodecHelper::readString($in);
        $property = CodecHelper::readString($in);
        $path = CodecHelper::readString($in);
        $data = $this->readDataStoreValue($in);
        $updateCount = LE::readUnsignedInt($in);
        $pathUpdateCount = LE::readUnsignedInt($in);

        return new DataStoreUpdate($name, $property, $path, $data, $updateCount, $pathUpdateCount);
    }

    protected function writeUpdate(ByteBufferWriter $out, DataStoreUpdate $update) : void{
        CodecHelper::writeString($out, $update->name);
        CodecHelper::writeString($out, $update->property);
        CodecHelper::writeString($out, $update->path);
        $this->writeDataStoreValue($out, $update->data);
        LE::writeUnsignedInt($out, $update->updateCount);
        LE::writeUnsignedInt($out, $update->pathUpdateCount);
    }
}