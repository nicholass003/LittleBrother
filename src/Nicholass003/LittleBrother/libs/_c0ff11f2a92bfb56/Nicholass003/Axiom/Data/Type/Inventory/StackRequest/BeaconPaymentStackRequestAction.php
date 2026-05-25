<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\Type\Inventory\StackRequest;

use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Enum\ItemStackRequestActionType;

class BeaconPaymentStackRequestAction extends ItemStackRequestAction{

    public function __construct(
        public readonly int $primaryEffectId,
        public readonly int $secondaryEffectId
    ){
        parent::__construct(ItemStackRequestActionType::BEACON_PAYMENT);
    }
}