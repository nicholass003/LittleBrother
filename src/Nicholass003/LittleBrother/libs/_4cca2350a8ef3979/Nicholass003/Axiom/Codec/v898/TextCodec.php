<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\v898;

use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Enum\TextType;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Packet\Packet;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Packet\TextPacket;
use pmmp\encoding\Byte;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\VarInt;

final class TextCodec implements Codec{

    private const CATEGORY_MESSAGE_ONLY = 0;
    private const CATEGORY_AUTHORED_MESSAGE = 1;
    private const CATEGORY_MESSAGE_WITH_PARAMETERS = 2;

    private const DUMMY_STRINGS = [
    	self::CATEGORY_MESSAGE_ONLY => [
    		'raw', 'tip', 'systemMessage',
    		'textObjectWhisper', 'textObjectAnnouncement', 'textObject'
    	],
    	self::CATEGORY_AUTHORED_MESSAGE => [
    		'chat', 'whisper', 'announcement'
    	],
    	self::CATEGORY_MESSAGE_WITH_PARAMETERS => [
    		'translate', 'popup', 'jukeboxPopup'
    	]
    ];

    public function decode(ByteBufferReader $in, CodecType $codec) : TextPacket{
        $pk = new TextPacket();

        $pk->needsTranslation = CodecHelper::readBool($in);

        $category = Byte::readUnsigned($in);
        $expected = self::DUMMY_STRINGS[$category]
            ?? throw new \RuntimeException("Unknown category $category");

        foreach($expected as $i => $dummy){
            $actual = CodecHelper::readString($in);
            if($actual !== $dummy){
                throw new \RuntimeException("Dummy mismatch at $i: expected '$dummy', got '$actual'");
            }
        }

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
        $pk->filteredMessage = CodecHelper::readOptional($in, fn($i) => CodecHelper::readString($i));

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

        foreach(self::DUMMY_STRINGS[$category] as $dummy){
            CodecHelper::writeString($out, $dummy);
        }

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
        CodecHelper::writeOptional($out, $pk->filteredMessage, fn($o, $v) => CodecHelper::writeString($o, $v));
    }
}