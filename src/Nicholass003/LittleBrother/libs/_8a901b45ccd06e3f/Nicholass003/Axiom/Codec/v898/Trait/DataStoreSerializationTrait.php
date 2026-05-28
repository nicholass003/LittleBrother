<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\v898\Trait;

use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Data\Type\DataStore\BoolDataStoreValue;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Data\Type\DataStore\DataStore;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Data\Type\DataStore\DataStoreChange;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Data\Type\DataStore\DataStoreRemoval;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Data\Type\DataStore\DataStoreUpdate;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Data\Type\DataStore\DataStoreValue;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Data\Type\DataStore\DoubleDataStoreValue;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Data\Type\DataStore\StringDataStoreValue;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Enum\DataStoreType;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Enum\DataStoreValueType;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;
use pmmp\encoding\VarInt;

/**
 * @internal This API is under active evaluation.
 * @todo This architecture is not final and may be refactored in a future version.
 */
trait DataStoreSerializationTrait{

    protected function readDataStore(ByteBufferReader $in, DataStoreType $type) : DataStore{
        return match($type){
            DataStoreType::UPDATE => $this->readUpdate($in),
            DataStoreType::CHANGE => $this->readChange($in),
            DataStoreType::REMOVAL => $this->readRemoval($in),
            default => throw new \RuntimeException("Unknown DataStore type $type->value")
        };
    }

    protected function readUpdate(ByteBufferReader $in) : DataStoreUpdate{
        $name = CodecHelper::readString($in);
        $property = CodecHelper::readString($in);
        $path = CodecHelper::readString($in);
        $data = $this->readDataStoreValue($in);
        $updateCount = VarInt::readUnsignedInt($in);
        return new DataStoreUpdate($name, $property, $path, $data, $updateCount);
    }

    protected function readChange(ByteBufferReader $in) : DataStoreChange{
        $name = CodecHelper::readString($in);
        $property = CodecHelper::readString($in);
        $updateCount = VarInt::readUnsignedInt($in);
        $data = $this->readDataStoreValue($in);
        return new DataStoreChange($name, $property, $updateCount, $data);
    }

    protected function readRemoval(ByteBufferReader $in) : DataStoreRemoval{
        return new DataStoreRemoval(CodecHelper::readString($in));
    }

    protected function readDataStoreValue(ByteBufferReader $in) : DataStoreValue{
        $valueType = DataStoreValueType::safe(VarInt::readUnsignedInt($in));
        return match($valueType){
            DataStoreValueType::DOUBLE => new DoubleDataStoreValue(LE::readDouble($in)),
            DataStoreValueType::BOOL => new BoolDataStoreValue(CodecHelper::readBool($in)),
            DataStoreValueType::STRING => new StringDataStoreValue(CodecHelper::readString($in)),
            default => throw new \RuntimeException("Unknown DataStoreValue type $valueType->value")
        };
    }

    protected function getDataStoreType(DataStore $store) : DataStoreType{
        return match(true){
            $store instanceof DataStoreUpdate => DataStoreType::UPDATE,
            $store instanceof DataStoreChange => DataStoreType::CHANGE,
            $store instanceof DataStoreRemoval => DataStoreType::REMOVAL,
            default => throw new \LogicException("Unknown DataStore class")
        };
    }

    protected function writeDataStore(ByteBufferWriter $out, DataStore $store) : void{
        match(true){
            $store instanceof DataStoreUpdate => $this->writeUpdate($out, $store),
            $store instanceof DataStoreChange => $this->writeChange($out, $store),
            $store instanceof DataStoreRemoval => $this->writeRemoval($out, $store),
            default => throw new \LogicException("Unknown DataStore class")
        };
    }

    protected function writeUpdate(ByteBufferWriter $out, DataStoreUpdate $update) : void{
        CodecHelper::writeString($out, $update->name);
        CodecHelper::writeString($out, $update->property);
        CodecHelper::writeString($out, $update->path);
        $this->writeDataStoreValue($out, $update->data);
        VarInt::writeUnsignedInt($out, $update->updateCount);
    }

    protected function writeChange(ByteBufferWriter $out, DataStoreChange $change) : void{
        CodecHelper::writeString($out, $change->name);
        CodecHelper::writeString($out, $change->property);
        VarInt::writeUnsignedInt($out, $change->updateCount);
        $this->writeDataStoreValue($out, $change->data);
    }

    protected function writeRemoval(ByteBufferWriter $out, DataStoreRemoval $removal) : void{
        CodecHelper::writeString($out, $removal->name);
    }

    protected function writeDataStoreValue(ByteBufferWriter $out, DataStoreValue $value) : void{
        VarInt::writeUnsignedInt($out, $value->type->value);
        match(true){
            $value instanceof DoubleDataStoreValue => LE::writeDouble($out, $value->value),
            $value instanceof BoolDataStoreValue => CodecHelper::writeBool($out, $value->value),
            $value instanceof StringDataStoreValue => CodecHelper::writeString($out, $value->value),
            default => throw new \LogicException("Unknown DataStoreValue class")
        };
    }
}