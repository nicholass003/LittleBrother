<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Codec\Common\Serializer;

use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Codec\Common\Serializer\Map\MapDecorationSerializer;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Codec\Common\Serializer\Map\MapImageSerializer;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Codec\Common\Serializer\Map\MapInfoRequestPacketClientPixelSerializer;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Codec\Common\Serializer\Map\MapTrackedObjectSerializer;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Codec\Support\CloneWithProperty;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Codec\Support\Forkable;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Codec\Support\ForkableInterface;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Data\Type\Map\MapDecoration;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Data\Type\Map\MapImage;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Data\Type\Map\MapTrackedObject;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;

class MapSerializer implements ForkableInterface{
    use Forkable;
    use CloneWithProperty;

    public function __construct(
        private MapTrackedObjectSerializer $trackedObjectSerializer,
        private MapDecorationSerializer $decorationSerializer,
        private MapImageSerializer $imageSerializer,
        private MapInfoRequestPacketClientPixelSerializer $clientPixelSerializer
    ){}

    public function trackedObject() : MapTrackedObjectSerializer{ return $this->trackedObjectSerializer; }
    public function decoration() : MapDecorationSerializer{ return $this->decorationSerializer; }
    public function image() : MapImageSerializer{ return $this->imageSerializer; }
    public function clientPixel() : MapInfoRequestPacketClientPixelSerializer{ return $this->clientPixelSerializer; }

    public function withTrackedObject(MapTrackedObjectSerializer $v) : self{ return $this->with('trackedObjectSerializer', $v); }
    public function withDecoration(MapDecorationSerializer $v) : self{ return $this->with('decorationSerializer', $v); }
    public function withImage(MapImageSerializer $v) : self{ return $this->with('imageSerializer', $v); }
    public function withClientPixel(MapInfoRequestPacketClientPixelSerializer $v) : self{ return $this->with('clientPixelSerializer', $v); }

    /**
     * @return list<int>
     */
    public function readParentMapIds(ByteBufferReader $in) : array{
        return CodecHelper::readList($in, static fn(ByteBufferReader $in) : int => CodecHelper::readActorUniqueId($in));
    }

    /**
     * @param list<int> $parentMapIds
     */
    public function writeParentMapIds(ByteBufferWriter $out, array $parentMapIds) : void{
        CodecHelper::writeList($out, $parentMapIds, static function(ByteBufferWriter $out, int $id) : void{
            CodecHelper::writeActorUniqueId($out, $id);
        });
    }

    /**
     * @return list<MapTrackedObject>
     */
    public function readTrackedObjects(ByteBufferReader $in) : array{
        return CodecHelper::readList($in, fn($in) => $this->trackedObjectSerializer->read($in));
    }

    /**
     * @param list<MapTrackedObject> $objects
     */
    public function writeTrackedObjects(ByteBufferWriter $out, array $objects) : void{
        CodecHelper::writeList($out, $objects, fn($out, $obj) => $this->trackedObjectSerializer->write($out, $obj));
    }

    /**
     * @return list<MapDecoration>
     */
    public function readDecorations(ByteBufferReader $in) : array{
        return CodecHelper::readList($in, fn($in) => $this->decorationSerializer->read($in));
    }

    /**
     * @param list<MapDecoration> $decorations
     */
    public function writeDecorations(ByteBufferWriter $out, array $decorations) : void{
        CodecHelper::writeList($out, $decorations, fn($out, $d) => $this->decorationSerializer->write($out, $d));
    }

    public function readImage(ByteBufferReader $in, int $width, int $height) : MapImage{
        return $this->imageSerializer->read($in, $width, $height);
    }

    public function writeImage(ByteBufferWriter $out, MapImage $image) : void{
        $this->imageSerializer->write($out, $image);
    }
}