<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Enum\BookEditType;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Packet\BookEditPacket;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Packet\Packet;
use pmmp\encoding\Byte;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;

class BookEditCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : BookEditPacket{
        $pk = new BookEditPacket();
        $pk->type = BookEditType::safe(Byte::readUnsigned($in));
        $pk->inventorySlot = Byte::readUnsigned($in);

        switch($pk->type){
            case BookEditType::REPLACE_PAGE:
            case BookEditType::ADD_PAGE:
                $pk->pageNumber = Byte::readUnsigned($in);
                $pk->text = CodecHelper::readString($in);
                $pk->photoName = CodecHelper::readString($in);
                break;
            case BookEditType::DELETE_PAGE:
                $pk->pageNumber = Byte::readUnsigned($in);
                break;
            case BookEditType::SWAP_PAGES:
                $pk->pageNumber = Byte::readUnsigned($in);
                $pk->secondaryPageNumber = Byte::readUnsigned($in);
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
        Byte::writeUnsigned($out, $pk->type->value);
        Byte::writeUnsigned($out, $pk->inventorySlot);

        switch($pk->type){
            case BookEditType::REPLACE_PAGE:
            case BookEditType::ADD_PAGE:
                Byte::writeUnsigned($out, $pk->pageNumber);
                CodecHelper::writeString($out, $pk->text);
                CodecHelper::writeString($out, $pk->photoName);
                break;
            case BookEditType::DELETE_PAGE:
                Byte::writeUnsigned($out, $pk->pageNumber);
                break;
            case BookEditType::SWAP_PAGES:
                Byte::writeUnsigned($out, $pk->pageNumber);
                Byte::writeUnsigned($out, $pk->secondaryPageNumber);
                break;
            case BookEditType::SIGN_BOOK:
                CodecHelper::writeString($out, $pk->title);
                CodecHelper::writeString($out, $pk->author);
                CodecHelper::writeString($out, $pk->xuid);
                break;
        }
    }
}