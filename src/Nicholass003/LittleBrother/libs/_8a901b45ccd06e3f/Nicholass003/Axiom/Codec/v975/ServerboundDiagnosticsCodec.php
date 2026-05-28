<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\v975;

use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\v924\ServerboundDiagnosticsCodec as V924ServerboundDiagnosticsCodec;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Data\Type\EntityDiagnosticTimingInfo;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Data\Type\SystemDiagnosticTimingInfo;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Packet\Packet;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Packet\ServerboundDiagnosticsPacket;
use pmmp\encoding\Byte;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;

class ServerboundDiagnosticsCodec extends V924ServerboundDiagnosticsCodec{

    public function decode(ByteBufferReader $in, CodecType $codec) : ServerboundDiagnosticsPacket{
        $pk = parent::decode($in, $codec);
        $pk->entityDiagnostics = CodecHelper::readList($in, $this->readEntityDiagnostic(...));
        $pk->systemDiagnostics = CodecHelper::readList($in, $this->readSystemDiagnostic(...));
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        parent::encode($out, $pk, $codec);
        assert($pk instanceof ServerboundDiagnosticsPacket);
        CodecHelper::writeList($out, $pk->entityDiagnostics, $this->writeEntityDiagnostic(...));
        CodecHelper::writeList($out, $pk->systemDiagnostics, $this->writeSystemDiagnostic(...));
    }

    protected function readEntityDiagnostic(ByteBufferReader $in) : EntityDiagnosticTimingInfo{
        $displayName = CodecHelper::readString($in);
        $entity = CodecHelper::readString($in);
        $timeInNS = LE::readUnsignedLong($in);
        $percentOfTotal = Byte::readUnsigned($in);
        return new EntityDiagnosticTimingInfo($displayName, $entity, $timeInNS, $percentOfTotal);
    }

    protected function writeEntityDiagnostic(ByteBufferWriter $out, EntityDiagnosticTimingInfo $data) : void{
        CodecHelper::writeString($out, $data->displayName);
        CodecHelper::writeString($out, $data->entity);
        LE::writeUnsignedLong($out, $data->timeInNS);
        Byte::writeUnsigned($out, $data->percentOfTotal);
    }

    protected function readSystemDiagnostic(ByteBufferReader $in) : SystemDiagnosticTimingInfo{
        $displayName = CodecHelper::readString($in);
        $systemIndex = LE::readUnsignedLong($in);
        $timeInNS = LE::readUnsignedLong($in);
        $percentOfTotal = Byte::readUnsigned($in);
        return new SystemDiagnosticTimingInfo($displayName, $systemIndex, $timeInNS, $percentOfTotal);
    }

    protected function writeSystemDiagnostic(ByteBufferWriter $out, SystemDiagnosticTimingInfo $data) : void{
        CodecHelper::writeString($out, $data->displayName);
        LE::writeUnsignedLong($out, $data->systemIndex);
        LE::writeUnsignedLong($out, $data->timeInNS);
        Byte::writeUnsigned($out, $data->percentOfTotal);
    }
}