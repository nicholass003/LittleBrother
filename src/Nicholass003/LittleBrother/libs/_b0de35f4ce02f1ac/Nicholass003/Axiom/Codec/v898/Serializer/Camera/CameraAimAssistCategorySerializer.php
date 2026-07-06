<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Codec\v898\Serializer\Camera;

use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Codec\Common\Serializer\Camera\CameraAimAssistCategorySerializer as BaseCameraAimAssistCategorySerializer;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Data\Type\Camera\CameraAimAssistCategory;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Data\Type\Camera\CameraAimAssistCategoryBlockPriority;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Data\Type\Camera\CameraAimAssistCategoryEntityPriority;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;
use pmmp\encoding\VarInt;

class CameraAimAssistCategorySerializer extends BaseCameraAimAssistCategorySerializer{

    public function read(ByteBufferReader $in) : CameraAimAssistCategory{
        $entities = [];
        $entityCount = VarInt::readUnsignedInt($in);
        for($i = 0; $i < $entityCount; ++$i){
            $entities[] = new CameraAimAssistCategoryEntityPriority(
                CodecHelper::readString($in),
                LE::readSignedInt($in)
            );
        }

        $blocks = [];
        $blockCount = VarInt::readUnsignedInt($in);
        for($i = 0; $i < $blockCount; ++$i){
            $blocks[] = new CameraAimAssistCategoryBlockPriority(
                CodecHelper::readString($in),
                LE::readSignedInt($in)
            );
        }

        $defaultEntity = CodecHelper::readOptional($in, fn($i) => LE::readSignedInt($i));
        $defaultBlock = CodecHelper::readOptional($in, fn($i) => LE::readSignedInt($i));

        return new CameraAimAssistCategory(CodecHelper::readString($in),$entities, $blocks, defaultEntityPriority: $defaultEntity, defaultBlockPriority: $defaultBlock);
    }

    public function write(ByteBufferWriter $out, CameraAimAssistCategory $data) : void{
        CodecHelper::writeString($out, $data->name);
        VarInt::writeUnsignedInt($out, count($data->entities));
        foreach($data->entities as $e){
            CodecHelper::writeString($out, $e->identifier);
            LE::writeSignedInt($out, $e->priority);
        }

        VarInt::writeUnsignedInt($out, count($data->blocks));
        foreach($data->blocks as $b){
            CodecHelper::writeString($out, $b->identifier);
            LE::writeSignedInt($out, $b->priority);
        }

        CodecHelper::writeOptional($out, $data->defaultEntityPriority, fn($o, $v) => LE::writeSignedInt($o, $v));
        CodecHelper::writeOptional($out, $data->defaultBlockPriority, fn($o, $v) => LE::writeSignedInt($o, $v));
    }
}