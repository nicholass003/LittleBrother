<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\Common\Serializer;

use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\Common\Serializer\Inventory\FullContainerNameSerializer;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\Common\Serializer\Inventory\InventoryTransactionDataSerializer;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\Common\Serializer\Inventory\ItemInteractionDataSerializer;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\Common\Serializer\Inventory\ItemStackRequestSerializer;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\Common\Serializer\Inventory\ItemStackResponseSerializer;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\Common\Serializer\Inventory\NetworkInventoryActionSerializer;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\Support\CloneWithProperty;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\Support\Forkable;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\Support\ForkableInterface;

class InventorySerializer implements ForkableInterface{
    use Forkable;
    use CloneWithProperty;

    public function __construct(
        private ItemStackRequestSerializer $requestSerializer,
        private ItemStackResponseSerializer $responseSerializer,
        private FullContainerNameSerializer $containerSerializer,
        private NetworkInventoryActionSerializer $actionSerializer,
        private InventoryTransactionDataSerializer $transactionSerializer,
        private ItemInteractionDataSerializer $itemInteractionSerializer
    ){}

    public function request() : ItemStackRequestSerializer{ return $this->requestSerializer; }
    public function response() : ItemStackResponseSerializer{ return $this->responseSerializer; }
    public function container() : FullContainerNameSerializer{ return $this->containerSerializer; }
    public function action() : NetworkInventoryActionSerializer{ return $this->actionSerializer; }
    public function transaction() : InventoryTransactionDataSerializer{ return $this->transactionSerializer; }
    public function itemInteraction() : ItemInteractionDataSerializer{ return $this->itemInteractionSerializer; }

    public function withRequest(ItemStackRequestSerializer $v) : self{ return $this->with('requestSerializer', $v); }
    public function withResponse(ItemStackResponseSerializer $v) : self{ return $this->with('responseSerializer', $v); }
    public function withContainer(FullContainerNameSerializer $v) : self{ return $this->with('containerSerializer', $v); }
    public function withAction(NetworkInventoryActionSerializer $v) : self{ return $this->with('actionSerializer', $v); }
    public function withTransaction(InventoryTransactionDataSerializer $v) : self{ return $this->with('transactionSerializer', $v); }
    public function withItemInteraction(ItemInteractionDataSerializer $v) : self{ return $this->with('itemInteractionSerializer', $v); }
}