<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Codec\v1001;

use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Codec\v975\ServerboundDiagnosticsCodec as V975ServerboundDiagnosticsCodec;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Data\Type\WhiskerScopeDataSummary;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Packet\Packet;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Packet\ServerboundDiagnosticsPacket;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;

class ServerboundDiagnosticsCodec extends V975ServerboundDiagnosticsCodec{

    public function decode(ByteBufferReader $in, CodecType $codec) : ServerboundDiagnosticsPacket{
        $pk = parent::decode($in, $codec);
        $pk->whiskerScopes = CodecHelper::readList($in, $this->readWhiskerScopeDataSummary(...));
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        parent::encode($out, $pk, $codec);
        assert($pk instanceof ServerboundDiagnosticsPacket);
        CodecHelper::writeList($out, $pk->whiskerScopes, $this->writeWhiskerScopeDataSummary(...));
    }

    protected function readWhiskerScopeDataSummary(ByteBufferReader $in) : WhiskerScopeDataSummary{
        $label = CodecHelper::readString($in);
        $indentation = CodecHelper::readString($in);
        $totalHighCostNS = LE::readUnsignedLong($in);
        $totalMidCostNS = LE::readUnsignedLong($in);
        $totalLowCostNS = LE::readUnsignedLong($in);
        return new WhiskerScopeDataSummary($label, $indentation, $totalHighCostNS, $totalMidCostNS, $totalLowCostNS);
    }

    protected function writeWhiskerScopeDataSummary(ByteBufferWriter $out, WhiskerScopeDataSummary $data) : void{
        CodecHelper::writeString($out, $data->label);
        CodecHelper::writeString($out, $data->identation);
        LE::writeUnsignedLong($out, $data->totalHighCostNS);
        LE::writeUnsignedLong($out, $data->totalMidCostNS);
        LE::writeUnsignedLong($out, $data->totalLowCostNS);
    }
}