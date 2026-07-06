<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Codec\Common\Serializer;

use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Codec\Support\ForkableInterface;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Codec\Support\StatelessForkable;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Data\Type\BoolGameRule;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Data\Type\FloatGameRule;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Data\Type\GameRule;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Data\Type\IntGameRule;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Enum\GameRuleType;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;
use pmmp\encoding\VarInt;

class GameRulesSerializer implements ForkableInterface{
    use StatelessForkable;

    /**
     * @return array<string, GameRule>
     */
    public function read(ByteBufferReader $in, bool $isStartGame) : array{
        $rules = [];
        $count = VarInt::readUnsignedInt($in);
        for($i = 0; $i < $count; ++$i){
            $name = CodecHelper::readString($in);
            $isPlayerModifiable = CodecHelper::readBool($in);
            $type = GameRuleType::safe(VarInt::readUnsignedInt($in));
            $rules[$name] = $this->readRule($in, $type, $isPlayerModifiable, $isStartGame);
        }
        return $rules;
    }

    /**
     * @param array<string, GameRule> $rules
     */
    public function write(ByteBufferWriter $out, array $rules, bool $isStartGame) : void{
        VarInt::writeUnsignedInt($out, count($rules));
        foreach($rules as $name => $rule){
            CodecHelper::writeString($out, $name);
            CodecHelper::writeBool($out, $rule->isPlayerModifiable);
            VarInt::writeUnsignedInt($out, $this->getType($rule)->value);
            $this->writeRule($out, $rule, $isStartGame);
        }
    }

    private function readRule(ByteBufferReader $in, GameRuleType $type, bool $isPlayerModifiable, bool $isStartGame) : GameRule{
        return match($type){
            GameRuleType::BOOL => new BoolGameRule(CodecHelper::readBool($in), $isPlayerModifiable),
            GameRuleType::INT => new IntGameRule(
                $isStartGame ? VarInt::readUnsignedInt($in) : LE::readUnsignedInt($in),
                $isPlayerModifiable
            ),
            GameRuleType::FLOAT => new FloatGameRule(LE::readFloat($in), $isPlayerModifiable),
            GameRuleType::UNKNOWN => throw new \RuntimeException("Unknown game rule type")
        };
    }

    private function writeRule(ByteBufferWriter $out, GameRule $rule, bool $isStartGame) : void{
        match(true){
            $rule instanceof BoolGameRule => CodecHelper::writeBool($out, $rule->value),
            $rule instanceof IntGameRule => $isStartGame
                ? VarInt::writeUnsignedInt($out, $rule->value)
                : LE::writeUnsignedInt($out, $rule->value),
            $rule instanceof FloatGameRule => LE::writeFloat($out, $rule->value),
            default => throw new \InvalidArgumentException("Unknown game rule class")
        };
    }

    private function getType(GameRule $rule) : GameRuleType{
        return match(true){
            $rule instanceof BoolGameRule => GameRuleType::BOOL,
            $rule instanceof IntGameRule => GameRuleType::INT,
            $rule instanceof FloatGameRule => GameRuleType::FLOAT,
            default => throw new \InvalidArgumentException("Unknown game rule class")
        };
    }
}