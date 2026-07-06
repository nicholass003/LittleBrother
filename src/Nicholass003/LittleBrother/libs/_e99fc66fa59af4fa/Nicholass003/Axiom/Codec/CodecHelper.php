<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec;

use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\Common\BitSet;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\Common\Serializer\NetworkNbtSerializer;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Data\Type\BlockPosition;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Data\Type\ChunkPosition;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Data\Type\EntityLink;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Data\Type\ItemStack;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Data\Type\ItemStackWrapper;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Data\Type\SubChunk\SubChunkPosition;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Data\Type\SubChunk\SubChunkPositionOffset;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Data\Type\Vec2;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Data\Type\Vec3;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Data\Type\WorldPosition;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Enum\EntityLinkType;
use pmmp\encoding\Byte;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;
use pmmp\encoding\VarInt;
use pocketmine\utils\Binary;
use function count;
use function strlen;
use function strrev;
use function substr;

class CodecHelper{

    private function __construct(){}

    public static function readString(ByteBufferReader $in) : string{
        return $in->readByteArray(VarInt::readUnsignedInt($in));
    }

    public static function writeString(ByteBufferWriter $out, string $v) : void{
        VarInt::writeUnsignedInt($out, strlen($v));
        $out->writeByteArray($v);
    }

    public static function readBool(ByteBufferReader $in) : bool{
        return Byte::readUnsigned($in) !== 0;
    }

    public static function writeBool(ByteBufferWriter $out, bool $v) : void{
        Byte::writeUnsigned($out, $v ? 1 : 0);
    }

    public static function readUuid(ByteBufferReader $in) : string{
        $p1 = strrev($in->readByteArray(8));
        $p2 = strrev($in->readByteArray(8));
        return $p1 . $p2;
    }

    public static function writeUuid(ByteBufferWriter $out, string $uuid) : void{
        $out->writeByteArray(strrev(substr($uuid, 0, 8)));
        $out->writeByteArray(strrev(substr($uuid, 8, 8)));
    }

    public static function readActorUniqueId(ByteBufferReader $in) : int{
        return VarInt::readSignedLong($in);
    }

    public static function writeActorUniqueId(ByteBufferWriter $out, int $id) : void{
        VarInt::writeSignedLong($out, $id);
    }

    public static function readActorRuntimeId(ByteBufferReader $in) : int{
        return VarInt::readUnsignedLong($in);
    }

    public static function writeActorRuntimeId(ByteBufferWriter $out, int $id) : void{
        VarInt::writeUnsignedLong($out, $id);
    }

    public static function readBlockPosition(ByteBufferReader $in) : BlockPosition{
        $x = VarInt::readSignedInt($in);
        $y = Binary::signInt(VarInt::readUnsignedInt($in));
        $z = VarInt::readSignedInt($in);
        return new BlockPosition($x, $y, $z);
    }

    public static function writeBlockPosition(ByteBufferWriter $out, BlockPosition $pos) : void{
        VarInt::writeSignedInt($out, $pos->x);
        VarInt::writeUnsignedInt($out, Binary::unsignInt($pos->y));
        VarInt::writeSignedInt($out, $pos->z);
    }

    public static function readSignedBlockPosition(ByteBufferReader $in) : BlockPosition{
        return new BlockPosition(
            x: VarInt::readSignedInt($in),
            y: VarInt::readSignedInt($in),
            z: VarInt::readSignedInt($in)
        );
    }

    public static function writeSignedBlockPosition(ByteBufferWriter $out, BlockPosition $pos) : void{
        VarInt::writeSignedInt($out, $pos->x);
        VarInt::writeSignedInt($out, $pos->y);
        VarInt::writeSignedInt($out, $pos->z);
    }

    public static function readChunkPosition(ByteBufferReader $in) : ChunkPosition{
        return new ChunkPosition(
            x: VarInt::readSignedInt($in),
            z: VarInt::readSignedInt($in)
        );
    }

    public static function writeChunkPosition(ByteBufferWriter $out, ChunkPosition $pos) : void{
        VarInt::writeSignedInt($out, $pos->x);
        VarInt::writeSignedInt($out, $pos->z);
    }

    public static function readVec3(ByteBufferReader $in) : Vec3{
        return new Vec3(
            x: LE::readFloat($in),
            y: LE::readFloat($in),
            z: LE::readFloat($in)
        );
    }

    public static function writeVec3(ByteBufferWriter $out, Vec3 $v) : void{
        LE::writeFloat($out, $v->x);
        LE::writeFloat($out, $v->y);
        LE::writeFloat($out, $v->z);
    }

    public static function readVec3Nullable(ByteBufferReader $in) : ?Vec3{
        return self::readVec3($in);
    }

    public static function writeVec3Nullable(ByteBufferWriter $out, ?Vec3 $v) : void{
        if($v !== null){
            self::writeVec3($out, $v);
        }else{
            LE::writeFloat($out, 0.0);
            LE::writeFloat($out, 0.0);
            LE::writeFloat($out, 0.0);
        }
    }

    public static function readVec2(ByteBufferReader $in) : Vec2{
        return new Vec2(
            x: LE::readFloat($in),
            y: LE::readFloat($in)
        );
    }

    public static function writeVec2(ByteBufferWriter $out, Vec2 $v) : void{
        LE::writeFloat($out, $v->x);
        LE::writeFloat($out, $v->y);
    }

    public static function readRotationByte(ByteBufferReader $in) : float{
        return Byte::readUnsigned($in) * (360.0 / 256.0);
    }

    public static function writeRotationByte(ByteBufferWriter $out, float $rotation) : void{
        Byte::writeUnsigned($out, (int) ($rotation / (360.0 / 256.0)));
    }

    public static function readWorldPosition(ByteBufferReader $in) : WorldPosition{
        return new WorldPosition(
            position: self::readVec3($in),
            dimension: VarInt::readSignedInt($in)
        );
    }

    public static function writeWorldPosition(ByteBufferWriter $out, WorldPosition $pos) : void{
        self::writeVec3($out, $pos->position);
        VarInt::writeSignedInt($out, $pos->dimension);
    }

    public static function readEntityLink(ByteBufferReader $in) : EntityLink{
        return new EntityLink(
            fromActorUniqueId: self::readActorUniqueId($in),
            toActorUniqueId: self::readActorUniqueId($in),
            type: EntityLinkType::safe(Byte::readUnsigned($in)),
            immediate: self::readBool($in),
            causedByRider: self::readBool($in),
            vehicleAngularVelocity: LE::readFloat($in)
        );
    }

    public static function writeEntityLink(ByteBufferWriter $out, EntityLink $link) : void{
        self::writeActorUniqueId($out, $link->fromActorUniqueId);
        self::writeActorUniqueId($out, $link->toActorUniqueId);
        Byte::writeUnsigned($out, $link->type->value);
        self::writeBool($out, $link->immediate);
        self::writeBool($out, $link->causedByRider);
        LE::writeFloat($out, $link->vehicleAngularVelocity);
    }

    /**
     * @template T
     * @param \Closure(ByteBufferReader): T $reader
     * @return T|null
     */
    public static function readOptional(ByteBufferReader $in, \Closure $reader) : mixed{
        return self::readBool($in) ? $reader($in) : null;
    }

    /**
     * @template T
     * @param T|null $value
     * @param \Closure(ByteBufferWriter, T): void $writer
     */
    public static function writeOptional(ByteBufferWriter $out, mixed $value, \Closure $writer) : void{
        self::writeBool($out, $value !== null);
        if($value !== null){
            $writer($out, $value);
        }
    }

    /**
     * @template T
     * @param \Closure(ByteBufferReader): T $reader
     * @return list<T>
     */
    public static function readList(ByteBufferReader $in, \Closure $reader) : array{
        $result = [];
        for($i = 0, $size = VarInt::readUnsignedInt($in); $i < $size; $i++){
            $result[] = $reader($in);
        }
        return $result;
    }

    /**
     * @template T
     * @param list<T> $list
     * @param \Closure(ByteBufferWriter, T): void $writer
     */
    public static function writeList(ByteBufferWriter $out, array $list, \Closure $writer) : void{
        VarInt::writeUnsignedInt($out, count($list));
        foreach($list as $item){
            $writer($out, $item);
        }
    }

    public static function readNbt(ByteBufferReader $in) : string{
        $offset = $in->getOffset();
        try{
            $serializer = new NetworkNbtSerializer();
            $nbt = $serializer->read($in->getData(), $offset, 512);
            return $serializer->write($nbt);
        }catch(\RuntimeException $e){
            throw new \RuntimeException("Failed decoding NBT root: " . $e->getMessage());
        }finally{
            $in->setOffset($offset);
        }
    }

    public static function writeNbt(ByteBufferWriter $out, string $nbtData) : void{
        $out->writeByteArray($nbtData);
    }

    public static function readNetworkItemStackDescriptor(ByteBufferReader $in) : ItemStackWrapper{
		$id = LE::readSignedShort($in);
		$count = LE::readUnsignedShort($in);
		$meta = VarInt::readUnsignedInt($in);

		$hasNetId = self::readBool($in);
		if($hasNetId){
			$variant = VarInt::readUnsignedInt($in);
			$stackId = VarInt::readSignedInt($in);
		}else{
			$variant = 0;
			$stackId = 0;
		}

		$blockRuntimeId = VarInt::readUnsignedInt($in);
		$rawExtraData = self::readString($in);
        return new ItemStackWrapper($stackId, new ItemStack($id, $meta, $count, $blockRuntimeId, $rawExtraData), $variant);
    }

    public static function writeNetworkItemStackDescriptor(ByteBufferWriter $out, ItemStackWrapper $wrapper) : void{
		LE::writeSignedShort($out, $wrapper->itemStack->id);
		LE::writeUnsignedShort($out, $wrapper->itemStack->count);
		VarInt::writeUnsignedInt($out, $wrapper->itemStack->meta);

		self::writeBool($out, $hasNetId = $wrapper->stackId !== 0);
		if($hasNetId){
			VarInt::writeUnsignedInt($out, $wrapper->stackIdVariant);
			VarInt::writeSignedInt($out, $wrapper->stackId);
		}

		VarInt::writeUnsignedInt($out, $wrapper->itemStack->blockRuntimeId);
		self::writeString($out, $wrapper->itemStack->rawExtraData);
    }

    public static function readItemStackWrapper(ByteBufferReader $in) : ItemStackWrapper{
        $id = VarInt::readSignedInt($in);
        if($id === 0){
            return new ItemStackWrapper(0, new ItemStack(0, 0, 0, 0, ''));
        }
        $count = LE::readUnsignedShort($in);
        $meta = VarInt::readUnsignedInt($in);
        $hasNetId = self::readBool($in);
        $stackId = $hasNetId ? self::readServerItemStackId($in) : 0;
        $blockRuntimeId = VarInt::readSignedInt($in);
        $rawExtraData = self::readString($in);
        return new ItemStackWrapper($stackId, new ItemStack($id, $meta, $count, $blockRuntimeId, $rawExtraData));
    }

    public static function writeItemStackWrapper(ByteBufferWriter $out, ItemStackWrapper $wrapper) : void{
        $item = $wrapper->itemStack;
        if($item->id === 0){
            VarInt::writeSignedInt($out, 0);
            return;
        }
        VarInt::writeSignedInt($out, $item->id);
        LE::writeUnsignedShort($out, $item->count);
        VarInt::writeUnsignedInt($out, $item->meta);
        $hasNetId = $wrapper->stackId !== 0;
        self::writeBool($out, $hasNetId);
        if($hasNetId){
            self::writeServerItemStackId($out, $wrapper->stackId);
        }
        VarInt::writeSignedInt($out, $item->blockRuntimeId);
        self::writeString($out, $item->rawExtraData);
    }

    private static function readServerItemStackId(ByteBufferReader $in) : int{
        return VarInt::readSignedInt($in);
    }

    private static function writeServerItemStackId(ByteBufferWriter $out, int $id) : void{
        VarInt::writeSignedInt($out, $id);
    }

    private const INT_BITS = PHP_INT_SIZE * 8;
    private const SHIFT = 7;

    public static function readBitSet(ByteBufferReader $in, int $length) : BitSet{
        $result = [0];
        $currentIndex = 0;
        $currentShift = 0;

        for($i = 0; $i < $length; $i += self::SHIFT){
            $b = Byte::readUnsigned($in);
            $bits = $b & 0x7f;

            $result[$currentIndex] |= $bits << $currentShift;
            $nextShift = $currentShift + self::SHIFT;
            if($nextShift >= self::INT_BITS){
                $nextShift -= self::INT_BITS;
                $rightShift = self::SHIFT - $nextShift;
                $result[++$currentIndex] = $bits >> $rightShift;
            }
            $currentShift = $nextShift;

            if(($b & 0x80) === 0){
                $expectedPartsCount = (int) ceil($length / self::INT_BITS);
                $parts = array_slice($result, 0, $expectedPartsCount);
                return new BitSet($length, $parts);
            }
        }

        $expectedPartsCount = (int) ceil($length / self::INT_BITS);
        $parts = array_slice($result, 0, $expectedPartsCount);
        return new BitSet($length, $parts);
    }

    public static function writeBitSet(ByteBufferWriter $out, BitSet $bitSet) : void{
        $parts = $bitSet->getParts();
        $length = $bitSet->length;
        $currentIndex = 0;
        $currentShift = 0;

        for($i = 0; $i < $length; $i += self::SHIFT){
            $bits = $parts[$currentIndex] >> $currentShift;
            $nextShift = $currentShift + self::SHIFT;
            if($nextShift >= self::INT_BITS){
                $nextShift -= self::INT_BITS;
                $bits |= ($parts[++$currentIndex] ?? 0) << (self::SHIFT - $nextShift);
            }
            $currentShift = $nextShift;

            $last = $i + self::SHIFT >= $length;
            $bits |= $last ? 0 : 0x80;

            Byte::writeUnsigned($out, $bits);
            if($last){
                break;
            }
        }
    }

    public static function readItemStackWithoutStackId(ByteBufferReader $in) : ItemStack{
        $id = VarInt::readSignedInt($in);
        if($id === 0){
            return new ItemStack(0, 0, 0, 0, '');
        }
        $count = LE::readUnsignedShort($in);
        $meta = VarInt::readUnsignedInt($in);
        $blockRuntimeId = VarInt::readSignedInt($in);
        $rawExtraData = self::readString($in);
        return new ItemStack($id, $meta, $count, $blockRuntimeId, $rawExtraData);
    }

    public static function writeItemStackWithoutStackId(ByteBufferWriter $out, ItemStack $item) : void{
        if($item->id === 0){
            VarInt::writeSignedInt($out, 0);
            return;
        }
        VarInt::writeSignedInt($out, $item->id);
        LE::writeUnsignedShort($out, $item->count);
        VarInt::writeUnsignedInt($out, $item->meta);
        VarInt::writeSignedInt($out, $item->blockRuntimeId);
        self::writeString($out, $item->rawExtraData);
    }

    public static function readRecipeNetId(ByteBufferReader $in) : int{
        return VarInt::readUnsignedInt($in);
    }

    public static function writeRecipeNetId(ByteBufferWriter $out, int $id) : void{
        VarInt::writeUnsignedInt($out, $id);
    }

    public static function readCreativeItemNetId(ByteBufferReader $in) : int{
        return VarInt::readUnsignedInt($in);
    }

    public static function writeCreativeItemNetId(ByteBufferWriter $out, int $id) : void{
        VarInt::writeUnsignedInt($out, $id);
    }

    public static function readItemStackNetIdVariant(ByteBufferReader $in) : int{
        return VarInt::readSignedInt($in);
    }

    public static function writeItemStackNetIdVariant(ByteBufferWriter $out, int $id) : void{
        VarInt::writeSignedInt($out, $id);
    }

    public static function readSubChunk(ByteBufferReader $in) : SubChunkPosition{
        $x = VarInt::readSignedInt($in);
        $y = VarInt::readSignedInt($in);
        $z = VarInt::readSignedInt($in);
        return new SubChunkPosition($x, $y, $z);
    }

    public static function writeSubChunk(ByteBufferWriter $out, SubChunkPosition $pos) : void{
        VarInt::writeSignedInt($out, $pos->x);
        VarInt::writeSignedInt($out, $pos->y);
        VarInt::writeSignedInt($out, $pos->z);
    }

    public static function readSubChunkOffset(ByteBufferReader $in) : SubChunkPositionOffset{
        $xOffset = Byte::readSigned($in);
        $yOffset = Byte::readSigned($in);
        $zOffset = Byte::readSigned($in);
        return new SubChunkPositionOffset($xOffset, $yOffset, $zOffset);
    }

    public static function writeSubChunkOffset(ByteBufferWriter $out, SubChunkPositionOffset $pos) : void{
        Byte::writeSigned($out, $pos->xOffset);
        Byte::writeSigned($out, $pos->yOffset);
        Byte::writeSigned($out, $pos->zOffset);
    }
}