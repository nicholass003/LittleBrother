<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\Common\Serializer\Inventory;

use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\Support\CloneWithProperty;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\Support\Forkable;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\Support\ForkableInterface;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Data\Type\Inventory\StackRequest\ItemStackRequest;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Data\Type\Inventory\StackRequest\ItemStackRequestSlotInfo;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Enum\ItemStackRequestActionType;
use pmmp\encoding\Byte;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;
use pmmp\encoding\VarInt;

class ItemStackRequestSerializer implements ForkableInterface{
    use Forkable;
    use CloneWithProperty;

    public function __construct(
        private ItemStackRequestActionsSerializer $actionsSerializer
    ){}

    public function actions() : ItemStackRequestActionsSerializer{ return $this->actionsSerializer; }

    public function withActions(ItemStackRequestActionsSerializer $v) : self{ return $this->with('actionsSerializer', $v); }

    public function read(ByteBufferReader $in, CodecType $codec) : ItemStackRequest{
        $requestId = VarInt::readSignedInt($in);

        $size = VarInt::readUnsignedInt($in);
        $actions = [];

        for($i = 0; $i < $size; $i++){
            $type = ItemStackRequestActionType::safe(Byte::readUnsigned($in));
            $serializer = $this->actionsSerializer->get($type);

            $actions[] = $serializer->read($in, $codec);
        }

        $filterStrings = CodecHelper::readList($in, fn($in) => CodecHelper::readString($in));
        $filterStringCause = LE::readSignedInt($in);

        return new ItemStackRequest($requestId, $actions, $filterStrings, $filterStringCause);
    }

    public function write(ByteBufferWriter $out, ItemStackRequest $request, CodecType $codec) : void{
        VarInt::writeSignedInt($out, $request->requestId);

        VarInt::writeUnsignedInt($out, count($request->actions));

        foreach($request->actions as $action){
            Byte::writeUnsigned($out, $action->type->value);

            $serializer = $this->actionsSerializer->get($action->type);
            $serializer->write($out, $action, $codec);
        }

        CodecHelper::writeList($out, $request->filterStrings, fn($out, $s) => CodecHelper::writeString($out, $s));
        LE::writeSignedInt($out, $request->filterStringCause);
    }

	public function readSlotInfo(ByteBufferReader $in, CodecType $codec) : ItemStackRequestSlotInfo{
		$containerName = $codec->inventory()->container()->read($in);
		$slotId = Byte::readUnsigned($in);
		$stackId = CodecHelper::readItemStackNetIdVariant($in);
		return new ItemStackRequestSlotInfo($containerName, $slotId, $stackId);
	}

	public function writeSlotInfo(ByteBufferWriter $out, ItemStackRequestSlotInfo $info, CodecType $codec) : void{
		$codec->inventory()->container()->write($out, $info->containerName);
		Byte::writeUnsigned($out, $info->slotId);
		CodecHelper::writeItemStackNetIdVariant($out, $info->stackId);
	}
}