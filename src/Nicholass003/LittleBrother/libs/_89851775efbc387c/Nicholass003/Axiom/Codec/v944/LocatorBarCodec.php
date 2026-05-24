<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\v944;

use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Data\Type\LocatorBarWaypoint;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Data\Type\LocatorBarWaypointPayload;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Packet\LocatorBarPacket;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Packet\Packet;
use pmmp\encoding\Byte;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;

class LocatorBarCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : LocatorBarPacket{
        $pk = new LocatorBarPacket();
        $pk->waypoints = CodecHelper::readList($in, $this->readWaypointPayload(...));
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof LocatorBarPacket);
        CodecHelper::writeList($out, $pk->waypoints, $this->writeWaypointPayload(...));
    }

    protected function readWaypointPayload(ByteBufferReader $in) : LocatorBarWaypointPayload{
        $uuid = CodecHelper::readUuid($in);
        $waypoint = $this->readWaypoint($in);
        $action = Byte::readUnsigned($in);
        return new LocatorBarWaypointPayload(
            $uuid,
            $waypoint,
            $action
        );
    }

    protected function writeWaypointPayload(ByteBufferWriter $out, LocatorBarWaypointPayload $data) : void{
        CodecHelper::writeUuid($out, $data->uuid);
        $this->writeWaypoint($out, $data->waypoint);
        Byte::writeUnsigned($out, $data->action);
    }

    protected function readWaypoint(ByteBufferReader $in) : LocatorBarWaypoint{
        $updateFlag = LE::readUnsignedInt($in);
        $visible = CodecHelper::readOptional($in, CodecHelper::readBool(...));
        $worldPosition = CodecHelper::readOptional($in, CodecHelper::readWorldPosition(...));
        $textureId = CodecHelper::readOptional($in, LE::readUnsignedInt(...));
        $color = CodecHelper::readOptional($in, LE::readUnsignedInt(...));
        $clientPositionAuthority = CodecHelper::readOptional($in, CodecHelper::readBool(...));
        $actorUniqueId = CodecHelper::readOptional($in, CodecHelper::readActorUniqueId(...));
        return new LocatorBarWaypoint(
            $updateFlag,
            $visible,
            $worldPosition,
            $textureId,
            $color,
            $clientPositionAuthority,
            $actorUniqueId
        );
    }

    protected function writeWaypoint(ByteBufferWriter $out, LocatorBarWaypoint $data) : void{
        LE::writeUnsignedInt($out, $data->updateFlag);
        CodecHelper::writeOptional($out, $data->visible, CodecHelper::writeBool(...));
        CodecHelper::writeOptional($out, $data->worldPosition, CodecHelper::writeWorldPosition(...));
        CodecHelper::writeOptional($out, $data->textureId, LE::writeUnsignedInt(...));
        CodecHelper::writeOptional($out, $data->color, LE::writeUnsignedInt(...));
        CodecHelper::writeOptional($out, $data->clientPositionAuthority, CodecHelper::writeBool(...));
        CodecHelper::writeOptional($out, $data->actorUniqueId, CodecHelper::writeActorUniqueId(...));
    }
}