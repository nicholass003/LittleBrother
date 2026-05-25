<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Data\Type\Inventory\StackRequest;

use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Enum\ItemStackRequestActionType;

class BeaconPaymentStackRequestAction extends ItemStackRequestAction{

    public function __construct(
        public readonly int $primaryEffectId,
        public readonly int $secondaryEffectId
    ){
        parent::__construct(ItemStackRequestActionType::BEACON_PAYMENT);
    }
}