<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Codec\Common\Serializer\Inventory;

use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Codec\Common\Serializer\Inventory\StackRequest\ItemStackRequestActionSerializer;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Codec\Support\ForkableInterface;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Enum\ItemStackRequestActionType;

final class ItemStackRequestActionsSerializer implements ForkableInterface{

    /**
     * @var array<int, ItemStackRequestActionSerializer>
     */
    private array $map = [];

    public function register(ItemStackRequestActionType $type, ItemStackRequestActionSerializer $serializer) : self{
        if(isset($this->map[$type->value])){
            throw new \LogicException("Serializer already registered for {$type->name}");
        }
        $this->map[$type->value] = $serializer;
        return $this;
    }

    public function get(ItemStackRequestActionType $type) : ItemStackRequestActionSerializer{
        return $this->map[$type->value]
            ?? throw new \RuntimeException("No serializer for {$type->name}");
    }

    public function withRegistered(ItemStackRequestActionType $type, ItemStackRequestActionSerializer $serializer) : static{
        if(isset($this->map[$type->value])){
            throw new \LogicException("Serializer already registered for {$type->name}");
        }

        $clone = clone $this;
        $clone->map[$type->value] = $serializer;

        return $clone;
    }

    public function withOverridden(ItemStackRequestActionType $type, ItemStackRequestActionSerializer $serializer) : static{
        $clone = clone $this;
        $clone->map[$type->value] = $serializer;

        return $clone;
    }

    public function fork() : static{
        $clone = clone $this;

        foreach($clone->map as $key => $serializer){
            $clone->map[$key] = $serializer->fork();
        }

        return $clone;
    }
}