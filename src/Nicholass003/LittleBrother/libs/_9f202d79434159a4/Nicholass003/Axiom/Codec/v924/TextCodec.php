<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\v924;

use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Enum\TextType;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Packet\Packet;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Packet\TextPacket;
use pmmp\encoding\Byte;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\VarInt;

final class TextCodec implements Codec{

    private const CATEGORY_MESSAGE_ONLY = 0;
    private const CATEGORY_AUTHORED_MESSAGE = 1;
    private const CATEGORY_MESSAGE_WITH_PARAMETERS = 2;

    public function decode(ByteBufferReader $in, CodecType $codec) : TextPacket{
        $pk = new TextPacket();

        $pk->needsTranslation = CodecHelper::readBool($in);

        $category = Byte::readUnsigned($in);

        $type = Byte::readUnsigned($in);
        $pk->type = TextType::from($type);

        switch($pk->type){
            case TextType::CHAT:
            case TextType::WHISPER:
            case TextType::ANNOUNCEMENT:
                if($category !== self::CATEGORY_AUTHORED_MESSAGE){
                    throw new \RuntimeException("Invalid structure: {$pk->type->name} requires CATEGORY_AUTHORED_MESSAGE");
                }
                $pk->sourceName = CodecHelper::readString($in);
                $pk->message = CodecHelper::readString($in);
                break;
            case TextType::RAW:
            case TextType::TIP:
            case TextType::SYSTEM:
            case TextType::JSON_WHISPER:
            case TextType::JSON:
            case TextType::JSON_ANNOUNCEMENT:
                if($category !== self::CATEGORY_MESSAGE_ONLY){
                    throw new \RuntimeException("Invalid structure: {$pk->type->name} requires CATEGORY_MESSAGE_ONLY");
                }
                $pk->message = CodecHelper::readString($in);
                break;
            case TextType::TRANSLATION:
            case TextType::POPUP:
            case TextType::JUKEBOX_POPUP:
                if($category !== self::CATEGORY_MESSAGE_WITH_PARAMETERS){
                    throw new \RuntimeException("Invalid structure: {$pk->type->name} requires CATEGORY_MESSAGE_WITH_PARAMETERS");
                }
                $pk->message = CodecHelper::readString($in);
                $count = VarInt::readUnsignedInt($in);
                $pk->parameters = [];
                for($i = 0; $i < $count; ++$i){
                    $pk->parameters[] = CodecHelper::readString($in);
                }
                break;
            default:
                throw new \RuntimeException("Unknown TextType {$pk->type->name}");
        }

        $pk->xboxUserId = CodecHelper::readString($in);
        $pk->platformChatId = CodecHelper::readString($in);
        $pk->filteredMessage = CodecHelper::readOptional($in, CodecHelper::readString(...));

        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof TextPacket);

        CodecHelper::writeBool($out, $pk->needsTranslation);

        $category = match($pk->type){
            TextType::RAW,
            TextType::TIP,
            TextType::SYSTEM,
            TextType::JSON_WHISPER,
            TextType::JSON_ANNOUNCEMENT,
            TextType::JSON => self::CATEGORY_MESSAGE_ONLY,

            TextType::CHAT,
            TextType::WHISPER,
            TextType::ANNOUNCEMENT => self::CATEGORY_AUTHORED_MESSAGE,

            TextType::TRANSLATION,
            TextType::POPUP,
            TextType::JUKEBOX_POPUP => self::CATEGORY_MESSAGE_WITH_PARAMETERS,
        };

        Byte::writeUnsigned($out, $category);

        Byte::writeUnsigned($out, $pk->type->value);

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
                VarInt::writeUnsignedInt($out, \count($pk->parameters));
                foreach($pk->parameters as $param){
                    CodecHelper::writeString($out, $param);
                }
                break;
            default:
                throw new \LogicException("Invalid TextType {$pk->type->name}");
        }

        CodecHelper::writeString($out, $pk->xboxUserId);
        CodecHelper::writeString($out, $pk->platformChatId);
        CodecHelper::writeOptional($out, $pk->filteredMessage, CodecHelper::writeString(...));
    }
}