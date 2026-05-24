<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\Common\Serializer\Structure;

use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\Support\CloneWithProperty;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\Support\Forkable;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\Support\ForkableInterface;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Data\Type\Structure\StructureEditorData;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Enum\StructureBlockType;
use pmmp\encoding\Byte;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\VarInt;

class StructureEditorDataSerializer implements ForkableInterface{
    use Forkable;
    use CloneWithProperty;

    public function __construct(
        private StructureSettingsSerializer $settingsSerializer
    ){}

    public function settings() : StructureSettingsSerializer{ return $this->settingsSerializer; }

    public function withSettings(StructureSettingsSerializer $v) : self{ return $this->with('settingsSerializer', $v); }

    public function read(ByteBufferReader $in) : StructureEditorData{
        $structureName = CodecHelper::readString($in);
        $filteredStructureName = CodecHelper::readString($in);
        $structureDataField = CodecHelper::readString($in);
        $includePlayers = CodecHelper::readBool($in);
        $showBoundingBox = CodecHelper::readBool($in);
        $structureBlockType = StructureBlockType::safe(VarInt::readUnsignedInt($in));
        $structureSettings = $this->settingsSerializer->read($in);
        $structureRedstoneSaveMode = Byte::readUnsigned($in);

        return new StructureEditorData(
            $structureName, $filteredStructureName, $structureDataField,
            $includePlayers, $showBoundingBox, $structureBlockType,
            $structureSettings, $structureRedstoneSaveMode
        );
    }

    public function write(ByteBufferWriter $out, StructureEditorData $data) : void{
        CodecHelper::writeString($out, $data->structureName);
        CodecHelper::writeString($out, $data->filteredStructureName);
        CodecHelper::writeString($out, $data->structureDataField);
        CodecHelper::writeBool($out, $data->includePlayers);
        CodecHelper::writeBool($out, $data->showBoundingBox);
        VarInt::writeUnsignedInt($out, $data->structureBlockType->value);
        $this->settingsSerializer->write($out, $data->structureSettings);
        Byte::writeUnsigned($out, $data->structureRedstoneSaveMode);
    }
}