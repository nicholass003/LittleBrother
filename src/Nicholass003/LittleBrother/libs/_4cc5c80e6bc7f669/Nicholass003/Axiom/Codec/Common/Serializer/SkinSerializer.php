<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\Common\Serializer;

use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\Support\ForkableInterface;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\Support\StatelessForkable;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Data\Type\Skin\PersonaPieceTintColor;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Data\Type\Skin\PersonaSkinPiece;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Data\Type\Skin\SkinAnimation;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Data\Type\Skin\SkinData;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Data\Type\Skin\SkinImage;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;

class SkinSerializer implements ForkableInterface{
    use StatelessForkable;

    public function read(ByteBufferReader $in) : SkinData{
        $skinId = CodecHelper::readString($in);
        $playFabId = CodecHelper::readString($in);
        $resourcePatch = CodecHelper::readString($in);
        $skinImage = $this->readSkinImage($in);

        $animationCount = LE::readUnsignedInt($in);
        $animations = [];
        for($i = 0; $i < $animationCount; ++$i){
            $animations[] = new SkinAnimation(
                $this->readSkinImage($in),
                LE::readUnsignedInt($in),
                LE::readFloat($in),
                LE::readUnsignedInt($in)
            );
        }

        $capeImage = $this->readSkinImage($in);
        $geometryData = CodecHelper::readString($in);
        $geometryDataVersion = CodecHelper::readString($in);
        $animationData = CodecHelper::readString($in);
        $capeId = CodecHelper::readString($in);
        $fullSkinId = CodecHelper::readString($in);
        $armSize = CodecHelper::readString($in);
        $skinColor = CodecHelper::readString($in);

        $personaPieceCount = LE::readUnsignedInt($in);
        $personaPieces = [];
        for($i = 0; $i < $personaPieceCount; ++$i){
            $personaPieces[] = new PersonaSkinPiece(
                CodecHelper::readString($in),
                CodecHelper::readString($in),
                CodecHelper::readString($in),
                CodecHelper::readBool($in),
                CodecHelper::readString($in)
            );
        }

        $tintCount = LE::readUnsignedInt($in);
        $pieceTintColors = [];
        for($i = 0; $i < $tintCount; ++$i){
            $pieceType = CodecHelper::readString($in);
            $colorCount = LE::readUnsignedInt($in);
            $colors = [];
            for($j = 0; $j < $colorCount; ++$j){
                $colors[] = CodecHelper::readString($in);
            }
            $pieceTintColors[] = new PersonaPieceTintColor($pieceType, $colors);
        }

        $premium = CodecHelper::readBool($in);
        $persona = CodecHelper::readBool($in);
        $capeOnClassic = CodecHelper::readBool($in);
        $isPrimaryUser = CodecHelper::readBool($in);
        $override = CodecHelper::readBool($in);

        return new SkinData(
            $skinId, $playFabId, $resourcePatch, $skinImage,
            $animations, $capeImage, $geometryData, $geometryDataVersion,
            $animationData, $capeId, $fullSkinId, $armSize, $skinColor,
            $personaPieces, $pieceTintColors, true,
            $premium, $persona, $capeOnClassic, $isPrimaryUser, $override
        );
    }

    public function write(ByteBufferWriter $out, SkinData $skin) : void{
        CodecHelper::writeString($out, $skin->skinId);
        CodecHelper::writeString($out, $skin->playFabId);
        CodecHelper::writeString($out, $skin->resourcePatch);
        $this->writeSkinImage($out, $skin->skinImage);

        LE::writeUnsignedInt($out, count($skin->animations));
        foreach($skin->animations as $anim){
            $this->writeSkinImage($out, $anim->image);
            LE::writeUnsignedInt($out, $anim->type);
            LE::writeFloat($out, $anim->frames);
            LE::writeUnsignedInt($out, $anim->expressionType);
        }

        $this->writeSkinImage($out, $skin->capeImage);
        CodecHelper::writeString($out, $skin->geometryData);
        CodecHelper::writeString($out, $skin->geometryDataEngineVersion);
        CodecHelper::writeString($out, $skin->animationData);
        CodecHelper::writeString($out, $skin->capeId);
        CodecHelper::writeString($out, $skin->fullSkinId);
        CodecHelper::writeString($out, $skin->armSize);
        CodecHelper::writeString($out, $skin->skinColor);

        LE::writeUnsignedInt($out, count($skin->personaPieces));
        foreach($skin->personaPieces as $piece){
            CodecHelper::writeString($out, $piece->pieceId);
            CodecHelper::writeString($out, $piece->pieceType);
            CodecHelper::writeString($out, $piece->packId);
            CodecHelper::writeBool($out, $piece->isDefaultPiece);
            CodecHelper::writeString($out, $piece->productId);
        }

        LE::writeUnsignedInt($out, count($skin->pieceTintColors));
        foreach($skin->pieceTintColors as $tint){
            CodecHelper::writeString($out, $tint->pieceType);
            LE::writeUnsignedInt($out, count($tint->colors));
            foreach($tint->colors as $color){
                CodecHelper::writeString($out, $color);
            }
        }

        CodecHelper::writeBool($out, $skin->isPremium);
        CodecHelper::writeBool($out, $skin->isPersona);
        CodecHelper::writeBool($out, $skin->isPersonaCapeOnClassic);
        CodecHelper::writeBool($out, $skin->isPrimaryUser);
        CodecHelper::writeBool($out, $skin->isOverride);
    }

    private function readSkinImage(ByteBufferReader $in) : SkinImage{
        $width = LE::readUnsignedInt($in);
        $height = LE::readUnsignedInt($in);
        $data = CodecHelper::readString($in);
        return new SkinImage($height, $width, $data);
    }

    private function writeSkinImage(ByteBufferWriter $out, SkinImage $image) : void{
        LE::writeUnsignedInt($out, $image->width);
        LE::writeUnsignedInt($out, $image->height);
        CodecHelper::writeString($out, $image->data);
    }
}