<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Codec\Common\Serializer\Structure;

use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Codec\Support\ForkableInterface;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Codec\Support\StatelessForkable;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\Type\Structure\StructureSettings;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;
use pmmp\encoding\VarInt;

class StructureSettingsSerializer implements ForkableInterface{
    use StatelessForkable;

    public function read(ByteBufferReader $in) : StructureSettings{
        $paletteName = CodecHelper::readString($in);
        $ignoreEntities = CodecHelper::readBool($in);
        $ignoreBlocks = CodecHelper::readBool($in);
        $allowNonTickingChunks = CodecHelper::readBool($in);
        $dimensions = CodecHelper::readBlockPosition($in);
        $offset = CodecHelper::readBlockPosition($in);
        $lastTouchedByPlayerID = VarInt::readSignedInt($in);
        $rotation = VarInt::readUnsignedInt($in);
        $mirror = VarInt::readUnsignedInt($in);
        $animationMode = VarInt::readUnsignedInt($in);
        $animationSeconds = LE::readFloat($in);
        $integrityValue = LE::readFloat($in);
        $integritySeed = LE::readUnsignedInt($in);
        $pivot = CodecHelper::readVec3($in);

        return new StructureSettings(
            $paletteName, $ignoreEntities, $ignoreBlocks, $allowNonTickingChunks,
            $dimensions, $offset, $lastTouchedByPlayerID, $rotation, $mirror,
            $animationMode, $animationSeconds, $integrityValue, $integritySeed, $pivot
        );
    }

    public function write(ByteBufferWriter $out, StructureSettings $settings) : void{
        CodecHelper::writeString($out, $settings->paletteName);
        CodecHelper::writeBool($out, $settings->ignoreEntities);
        CodecHelper::writeBool($out, $settings->ignoreBlocks);
        CodecHelper::writeBool($out, $settings->allowNonTickingChunks);
        CodecHelper::writeBlockPosition($out, $settings->dimensions);
        CodecHelper::writeBlockPosition($out, $settings->offset);
        VarInt::writeSignedInt($out, $settings->lastTouchedByPlayerID);
        VarInt::writeUnsignedInt($out, $settings->rotation);
        VarInt::writeUnsignedInt($out, $settings->mirror);
        VarInt::writeUnsignedInt($out, $settings->animationMode);
        LE::writeFloat($out, $settings->animationSeconds);
        LE::writeFloat($out, $settings->integrityValue);
        LE::writeUnsignedInt($out, $settings->integritySeed);
        CodecHelper::writeVec3($out, $settings->pivot);
    }
}