<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Codec\v924;

use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Enum\BookEditType;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Packet\BookEditPacket;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Packet\Packet;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\VarInt;

class BookEditCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : BookEditPacket{
        $pk = new BookEditPacket();
        $pk->inventorySlot = VarInt::readSignedInt($in);
        $pk->type = BookEditType::safe(VarInt::readUnsignedInt($in));

        switch($pk->type){
            case BookEditType::REPLACE_PAGE:
            case BookEditType::ADD_PAGE:
                $pk->pageNumber = VarInt::readSignedInt($in);
                $pk->text = CodecHelper::readString($in);
                $pk->photoName = CodecHelper::readString($in);
                break;
            case BookEditType::DELETE_PAGE:
                $pk->pageNumber = VarInt::readSignedInt($in);
                break;
            case BookEditType::SWAP_PAGES:
                $pk->pageNumber = VarInt::readSignedInt($in);
                $pk->secondaryPageNumber = VarInt::readSignedInt($in);
                break;
            case BookEditType::SIGN_BOOK:
                $pk->title = CodecHelper::readString($in);
                $pk->author = CodecHelper::readString($in);
                $pk->xuid = CodecHelper::readString($in);
                break;
        }
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof BookEditPacket);
        VarInt::writeSignedInt($out, $pk->inventorySlot);
        VarInt::writeUnsignedInt($out, $pk->type->value);

        switch($pk->type){
            case BookEditType::REPLACE_PAGE:
            case BookEditType::ADD_PAGE:
                VarInt::writeSignedInt($out, $pk->pageNumber);
                CodecHelper::writeString($out, $pk->text);
                CodecHelper::writeString($out, $pk->photoName);
                break;
            case BookEditType::DELETE_PAGE:
                VarInt::writeSignedInt($out, $pk->pageNumber);
                break;
            case BookEditType::SWAP_PAGES:
                VarInt::writeSignedInt($out, $pk->pageNumber);
                VarInt::writeSignedInt($out, $pk->secondaryPageNumber);
                break;
            case BookEditType::SIGN_BOOK:
                CodecHelper::writeString($out, $pk->title);
                CodecHelper::writeString($out, $pk->author);
                CodecHelper::writeString($out, $pk->xuid);
                break;
        }
    }
}