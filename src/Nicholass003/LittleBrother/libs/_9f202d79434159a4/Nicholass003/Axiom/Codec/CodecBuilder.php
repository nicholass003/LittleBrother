<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec;

use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Version\ProtocolVersion;

class CodecBuilder{

    /** @var array<int, Codec> */
    private array $codecs = [];

    private int $protocolVersion;

    private CodecType $codecType;

    private function __construct(
        ProtocolVersion $protocolVersion,
        private string $minecraftVersion,
        CodecType $codecType
    ){
        $this->protocolVersion = $protocolVersion->value;
        $this->codecType = $codecType;
    }

    public static function create(ProtocolVersion $protocolVersion, string $minecraftVersion, CodecType $codecType) : self{
        return new self($protocolVersion, $minecraftVersion, $codecType);
    }

    public function register(int $packetId, Codec $codec) : self{
        if(isset($this->codecs[$packetId])){
            throw new \InvalidArgumentException("Codec already registered for packet 0x" . dechex($packetId));
        }
        $this->codecs[$packetId] = $codec;
        return $this;
    }

    public function override(int $packetId, Codec $codec) : self{
        $this->codecs[$packetId] = $codec;
        return $this;
    }

    public function overrideCodecType(CodecType $codecType) : self{
        $this->codecType = $codecType;
        return $this;
    }

    public function remove(int $packetId) : self{
        unset($this->codecs[$packetId]);
        return $this;
    }

    public function fork(ProtocolVersion $protocolVersion, string $minecraftVersion) : self{
        $new = new self($protocolVersion, $minecraftVersion, $this->codecType);
        $new->codecs = $this->codecs;
        return $new;
    }

    public function get(int $packetId) : Codec{
        return $this->codecs[$packetId] ?? throw new \InvalidArgumentException("No codec for packet 0x" . dechex($packetId));
    }

    /**
     * @return array<int, Codec>
     */
    public function getCodecs() : array{
        return $this->codecs;
    }

    public function getCodecType() : CodecType{
        return $this->codecType;
    }

    public function getProtocolVersion() : int{
        return $this->protocolVersion;
    }

    public function getMinecraftVersion() : string{
        return $this->minecraftVersion;
    }
}