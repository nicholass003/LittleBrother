<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Enum\NpcDialogueAction;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Packet\NpcDialoguePacket;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Packet\Packet;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;
use pmmp\encoding\VarInt;

class NpcDialogueCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : NpcDialoguePacket{
        $pk = new NpcDialoguePacket();
        $pk->npcActorUniqueId = LE::readSignedLong($in);
        $pk->actionType = NpcDialogueAction::safe(VarInt::readSignedInt($in));
        $pk->dialogue = CodecHelper::readString($in);
        $pk->sceneName = CodecHelper::readString($in);
        $pk->npcName = CodecHelper::readString($in);
        $pk->actionJson = CodecHelper::readString($in);
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof NpcDialoguePacket);
        LE::writeSignedLong($out, $pk->npcActorUniqueId);
        VarInt::writeSignedInt($out, $pk->actionType->value);
        CodecHelper::writeString($out, $pk->dialogue);
        CodecHelper::writeString($out, $pk->sceneName);
        CodecHelper::writeString($out, $pk->npcName);
        CodecHelper::writeString($out, $pk->actionJson);
    }
}