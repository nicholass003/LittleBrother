<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Enum\TextType;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Packet\Packet;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Packet\TextPacket;
use pmmp\encoding\Byte;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\VarInt;
use function count;

class TextCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : TextPacket{
        $pk = new TextPacket();
        $pk->type = TextType::safe(Byte::readUnsigned($in));
        $pk->needsTranslation = CodecHelper::readBool($in);
        switch($pk->type){
            case TextType::CHAT:
            case TextType::WHISPER:
            case TextType::ANNOUNCEMENT:
                $pk->sourceName = CodecHelper::readString($in);
            case TextType::RAW:
            case TextType::TIP:
            case TextType::SYSTEM:
            case TextType::JSON_WHISPER:
            case TextType::JSON:
            case TextType::JSON_ANNOUNCEMENT:
                $pk->message = CodecHelper::readString($in);
                break;
            case TextType::TRANSLATION:
            case TextType::POPUP:
            case TextType::JUKEBOX_POPUP:
                $pk->message = CodecHelper::readString($in);
                $count = VarInt::readUnsignedInt($in);
                for($i = 0; $i < $count; $i++){
                    $pk->parameters[] = CodecHelper::readString($in);
                }
                break;
        }
        $pk->xboxUserId = CodecHelper::readString($in);
        $pk->platformChatId = CodecHelper::readString($in);
        $pk->filteredMessage = CodecHelper::readString($in);
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof TextPacket);
        Byte::writeUnsigned($out, $pk->type->value);
        CodecHelper::writeBool($out, $pk->needsTranslation);
        switch($pk->type){
            case TextType::CHAT:
            case TextType::WHISPER:
            case TextType::ANNOUNCEMENT:
                CodecHelper::writeString($out, $pk->sourceName);
            case TextType::RAW:
            case TextType::TIP:
            case TextType::SYSTEM:
            case TextType::JSON_WHISPER:
            case TextType::JSON:
            case TextType::JSON_ANNOUNCEMENT:
                CodecHelper::writeString($out, $pk->message);
                break;
            case TextType::TRANSLATION:
            case TextType::POPUP:
            case TextType::JUKEBOX_POPUP:
                CodecHelper::writeString($out, $pk->message);
                VarInt::writeUnsignedInt($out, count($pk->parameters));
                foreach($pk->parameters as $p){
                    CodecHelper::writeString($out, $p);
                }
                break;
        }
        CodecHelper::writeString($out, $pk->xboxUserId);
        CodecHelper::writeString($out, $pk->platformChatId);
        CodecHelper::writeString($out, $pk->filteredMessage ?? '');
    }
}