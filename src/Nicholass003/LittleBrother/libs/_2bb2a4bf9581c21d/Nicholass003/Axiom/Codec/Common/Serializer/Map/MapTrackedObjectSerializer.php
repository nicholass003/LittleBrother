<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Codec\Common\Serializer\Map;

use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Codec\Support\ForkableInterface;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Codec\Support\StatelessForkable;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\Type\BlockPosition;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\Type\Map\MapTrackedObject;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Enum\MapTrackedObjectType;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;

class MapTrackedObjectSerializer implements ForkableInterface{
    use StatelessForkable;

    public function read(ByteBufferReader $in) : MapTrackedObject{
        $rawType = LE::readUnsignedInt($in);
        $type = MapTrackedObjectType::safe($rawType);

        return match($type){
            MapTrackedObjectType::ENTITY => new MapTrackedObject($type, CodecHelper::readActorUniqueId($in), null),
            MapTrackedObjectType::BLOCK => new MapTrackedObject($type, null, CodecHelper::readBlockPosition($in)),
            MapTrackedObjectType::UNKNOWN => throw new \RuntimeException("Unknown map object type $rawType")
        };
    }

    public function write(ByteBufferWriter $out, MapTrackedObject $object) : void{
        match($object->type){
            MapTrackedObjectType::ENTITY => $this->writeEntity($out, $object),
            MapTrackedObjectType::BLOCK => $this->writeBlock($out, $object),
            MapTrackedObjectType::UNKNOWN => throw new \InvalidArgumentException("Unknown map object type")
        };
    }

    private function writeEntity(ByteBufferWriter $out, MapTrackedObject $object) : void{
        LE::writeUnsignedInt($out, $object->type->value);
        CodecHelper::writeActorUniqueId($out, $this->requireActorUniqueId($object));
    }

    private function writeBlock(ByteBufferWriter $out, MapTrackedObject $object) : void{
        LE::writeUnsignedInt($out, $object->type->value);
        CodecHelper::writeBlockPosition($out, $this->requireBlockPosition($object));
    }

    private function requireActorUniqueId(MapTrackedObject $object) : int{
        return $object->actorUniqueId ?? throw new \InvalidArgumentException("Entity tracked object requires actor unique ID");
    }

    private function requireBlockPosition(MapTrackedObject $object) : BlockPosition{
        return $object->blockPosition ?? throw new \InvalidArgumentException("Block tracked object requires block position");
    }
}