<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\Common\Serializer\Map;

use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\Support\ForkableInterface;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\Support\StatelessForkable;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Data\Type\Map\MapImage;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\VarInt;
use pocketmine\utils\Binary;

class MapImageSerializer implements ForkableInterface{
    use StatelessForkable;

    private const MAX_WIDTH = 128;
    private const MAX_HEIGHT = 128;

    public function read(ByteBufferReader $in, int $width, int $height) : MapImage{
        $this->validateDimensions($width, $height);

        $pixels = [];
        for($y = 0; $y < $height; ++$y){
            $row = [];
            for($x = 0; $x < $width; ++$x){
                $row[] = Binary::flipIntEndianness(VarInt::readUnsignedInt($in));
            }
            $pixels[] = $row;
        }
        return new MapImage($width, $height, $pixels);
    }

    public function write(ByteBufferWriter $out, MapImage $image) : void{
        $this->validateMapImage($image);

        for($y = 0; $y < $image->height; ++$y){
            for($x = 0; $x < $image->width; ++$x){
                VarInt::writeUnsignedInt($out, Binary::flipIntEndianness($image->pixels[$y][$x]));
            }
        }
    }

    private function validateMapImage(MapImage $image) : void{
        $this->validateDimensions($image->width, $image->height);
        if(count($image->pixels) !== $image->height){
            throw new \InvalidArgumentException("Pixel rows count must equal height");
        }
        foreach($image->pixels as $row){
            if(count($row) !== $image->width){
                throw new \InvalidArgumentException("All rows must have width columns");
            }
        }
    }

    private function validateDimensions(int $width, int $height) : void{
        if($height < 1){
            throw new \InvalidArgumentException("Image height must be at least 1");
        }
        if($width > self::MAX_WIDTH){
            throw new \InvalidArgumentException("Image width exceeds maximum of " . self::MAX_WIDTH);
        }
        if($height > self::MAX_HEIGHT){
            throw new \InvalidArgumentException("Image height exceeds maximum of " . self::MAX_HEIGHT);
        }
    }

    public function getPixelCount(MapImage $image) : int{
        return $image->width * $image->height;
    }
}