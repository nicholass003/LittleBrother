<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\Support;

final class Forker{

    public static function fork(object $object) : object{
        $clone = clone $object;

        $ref = new \ReflectionObject($clone);

        foreach($ref->getProperties() as $property){
            if($property->isStatic()){
                continue;
            }

            $property->setAccessible(true);
            $value = $property->getValue($clone);

            $property->setValue($clone, self::forkValue($value));
        }

        return $clone;
    }

    private static function forkValue(mixed $value) : mixed{
        if($value instanceof ForkableInterface){
            return $value->fork();
        }

        if(is_array($value)){
            foreach($value as $k => $v){
                $value[$k] = self::forkValue($v);
            }
            return $value;
        }

        return $value;
    }
}