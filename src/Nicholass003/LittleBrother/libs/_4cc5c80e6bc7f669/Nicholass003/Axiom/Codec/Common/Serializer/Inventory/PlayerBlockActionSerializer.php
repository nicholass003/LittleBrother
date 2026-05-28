<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\Common\Serializer\Inventory;

use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\Support\ForkableInterface;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Data\Type\PlayerBlockActionStopBreak;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Data\Type\PlayerBlockActionWithBlockInfo;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Enum\PlayerAction;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\VarInt;

final class PlayerBlockActionSerializer implements ForkableInterface{

    /** @var array<int, callable> */
    private array $readers = [];

    /** @var array<int, callable> */
    private array $writers = [];

    public function register(PlayerAction $type, callable $reader, callable $writer) : static{
        if(isset($this->readers[$type->value])){
            throw new \LogicException("Reader already registered for {$type->name}");
        }

        $this->readers[$type->value] = $reader;
        $this->writers[$type->value] = $writer;

        return $this;
    }

    public function override(PlayerAction $type, callable $reader, callable $writer) : static{
        $this->readers[$type->value] = $reader;
        $this->writers[$type->value] = $writer;

        return $this;
    }

    public function read(ByteBufferReader $in) : PlayerBlockActionStopBreak|PlayerBlockActionWithBlockInfo{
        $type = VarInt::readSignedInt($in);

        $reader = $this->readers[$type] ?? throw new \RuntimeException("No reader registered for block action type $type");

        return $reader($in, $type);
    }

    public function write(ByteBufferWriter $out, PlayerBlockActionStopBreak|PlayerBlockActionWithBlockInfo $action) : void{
        $type = match(true){
            $action instanceof PlayerBlockActionStopBreak => PlayerAction::STOP_BREAK,
            $action instanceof PlayerBlockActionWithBlockInfo => PlayerAction::safe($action->actionType)
        };

        VarInt::writeSignedInt($out, $type->value);

        $writer = $this->writers[$type->value] ?? throw new \RuntimeException("No writer registered for {$type->name}");

        $writer($out, $action);
    }

    public function fork() : static{
        $clone = clone $this;
        $clone->readers = $this->readers;
        $clone->writers = $this->writers;
        return $clone;
    }

    public static function createDefault() : static{
        $self = new self();

        $self->register(
            PlayerAction::STOP_BREAK,
            fn(ByteBufferReader $in, int $type) => new PlayerBlockActionStopBreak(),
            fn(ByteBufferWriter $out, PlayerBlockActionStopBreak $action) => null
        );

        $blockInfoReader = fn(ByteBufferReader $in, int $type) => new PlayerBlockActionWithBlockInfo(
            PlayerAction::safe($type)->value,
            CodecHelper::readSignedBlockPosition($in),
            VarInt::readSignedInt($in)
        );

        $blockInfoWriter = function(ByteBufferWriter $out, PlayerBlockActionWithBlockInfo $action) : void{
            CodecHelper::writeSignedBlockPosition($out, $action->blockPosition);
            VarInt::writeSignedInt($out, $action->face);
        };

        foreach([
        	PlayerAction::START_BREAK,
        	PlayerAction::ABORT_BREAK,
        	PlayerAction::CRACK_BREAK,
        	PlayerAction::PREDICT_DESTROY_BLOCK,
        	PlayerAction::CONTINUE_DESTROY_BLOCK
        ] as $type){
            $self->register($type, $blockInfoReader, $blockInfoWriter);
        }

        return $self;
    }
}