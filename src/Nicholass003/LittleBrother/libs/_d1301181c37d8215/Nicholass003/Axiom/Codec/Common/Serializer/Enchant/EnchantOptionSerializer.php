<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Codec\Common\Serializer\Enchant;

use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Codec\Support\CloneWithProperty;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Codec\Support\Forkable;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Codec\Support\ForkableInterface;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Data\Type\Enchant\Enchant;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Data\Type\Enchant\EnchantOption;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;
use pmmp\encoding\VarInt;

class EnchantOptionSerializer implements ForkableInterface{
    use Forkable;
    use CloneWithProperty;

    public function __construct(
        private EnchantSerializer $enchantSerializer
    ){}

    public function enchant() : EnchantSerializer{ return $this->enchantSerializer; }

    public function withEnchant(EnchantSerializer $v) : self{ return $this->with('enchantSerializer', $v); }

    public function read(ByteBufferReader $in) : EnchantOption{
        $cost = VarInt::readUnsignedInt($in);
        $slotFlags = LE::readUnsignedInt($in);
        $equipActivated = $this->readEnchantList($in);
        $heldActivated = $this->readEnchantList($in);
        $selfActivated = $this->readEnchantList($in);
        $name = CodecHelper::readString($in);
        $optionId = CodecHelper::readRecipeNetId($in);

        return new EnchantOption(
            $cost, $slotFlags, $equipActivated, $heldActivated, $selfActivated, $name, $optionId
        );
    }

    public function write(ByteBufferWriter $out, EnchantOption $option) : void{
        VarInt::writeUnsignedInt($out, $option->cost);
        LE::writeUnsignedInt($out, $option->slotFlags);
        $this->writeEnchantList($out, $option->equipActivatedEnchantments);
        $this->writeEnchantList($out, $option->heldActivatedEnchantments);
        $this->writeEnchantList($out, $option->selfActivatedEnchantments);
        CodecHelper::writeString($out, $option->name);
        CodecHelper::writeRecipeNetId($out, $option->optionId);
    }

    /**
     * @return list<EnchantOption>
     */
    public function readList(ByteBufferReader $in) : array{
        return CodecHelper::readList($in, fn($in) => $this->read($in));
    }

    /**
     * @param list<EnchantOption> $list
     */
    public function writeList(ByteBufferWriter $out, array $list) : void{
        CodecHelper::writeList($out, $list, fn($out, $enchant) => $this->write($out, $enchant));
    }

    /**
     * @return list<Enchant>
     */
    private function readEnchantList(ByteBufferReader $in) : array{
        return CodecHelper::readList($in, fn($in) => $this->enchantSerializer->read($in));
    }

    /**
     * @param list<Enchant> $list
     */
    private function writeEnchantList(ByteBufferWriter $out, array $list) : void{
        CodecHelper::writeList($out, $list, fn($out, $enchant) => $this->enchantSerializer->write($out, $enchant));
    }
}