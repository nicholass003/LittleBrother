<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Data\Type\PlayerListEntry;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Enum\PlayerListType;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Packet\Packet;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Packet\PlayerListPacket;
use pmmp\encoding\Byte;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;
use pmmp\encoding\VarInt;

class PlayerListCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : PlayerListPacket{
        $pk = new PlayerListPacket();
        $pk->type = PlayerListType::safe(Byte::readUnsigned($in));
        $count = VarInt::readUnsignedInt($in);
        for($i = 0; $i < $count; ++$i){
            if($pk->type === PlayerListType::ADD){
                $uuid = CodecHelper::readUUID($in);
                $actorUniqueId = CodecHelper::readActorUniqueId($in);
                $username = CodecHelper::readString($in);
                $xboxUserId = CodecHelper::readString($in);
                $platformChatId = CodecHelper::readString($in);
                $buildPlatform = LE::readSignedInt($in);
                $skin = $codec->skin()->read($in);
                $isTeacher = CodecHelper::readBool($in);
                $isHost = CodecHelper::readBool($in);
                $isSubClient = CodecHelper::readBool($in);
                $color = LE::readUnsignedInt($in);

                $pk->entries[$i] = new PlayerListEntry(
                    $uuid,
                    $actorUniqueId,
                    $username,
                    $xboxUserId,
                    $platformChatId,
                    $buildPlatform,
                    $skin,
                    $isTeacher,
                    $isHost,
                    $isSubClient,
                    $color,
                    null
                );
            }else{
                $uuid = CodecHelper::readUUID($in);
                $pk->entries[$i] = new PlayerListEntry($uuid);
            }
        }

        if($pk->type === PlayerListType::ADD){
            for($i = 0; $i < $count; ++$i){
                $verified = CodecHelper::readBool($in);

                $entry = $pk->entries[$i];
                $pk->entries[$i] = new PlayerListEntry(
                    $entry->uuid,
                    $entry->actorUniqueId,
                    $entry->username,
                    $entry->xboxUserId,
                    $entry->platformChatId,
                    $entry->buildPlatform,
                    $entry->skinData,
                    $entry->isTeacher,
                    $entry->isHost,
                    $entry->isSubClient,
                    $entry->color,
                    $verified
                );
            }
        }

        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof PlayerListPacket);
        Byte::writeUnsigned($out, $pk->type->value);
        VarInt::writeUnsignedInt($out, count($pk->entries));
        foreach($pk->entries as $entry){
            if($pk->type === PlayerListType::ADD){
                CodecHelper::writeUUID($out, $entry->uuid);
                CodecHelper::writeActorUniqueId($out, $entry->actorUniqueId ?? 0);
                CodecHelper::writeString($out, $entry->username ?? "");
                CodecHelper::writeString($out, $entry->xboxUserId ?? "");
                CodecHelper::writeString($out, $entry->platformChatId ?? "");
                LE::writeSignedInt($out, $entry->buildPlatform ?? -1);
                $codec->skin()->write($out, $entry->skinData);
                CodecHelper::writeBool($out, $entry->isTeacher ?? false);
                CodecHelper::writeBool($out, $entry->isHost ?? false);
                CodecHelper::writeBool($out, $entry->isSubClient ?? false);
                LE::writeUnsignedInt($out, $entry->color ?? 0xFFFFFFFF);
            }else{
                CodecHelper::writeUUID($out, $entry->uuid);
            }
        }

        if($pk->type === PlayerListType::ADD){
            foreach($pk->entries as $entry){
                CodecHelper::writeBool($out, $entry->skinVerified ?? true);
            }
        }
    }
}