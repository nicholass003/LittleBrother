<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Enum;

enum CameraSetInstructionEaseType : int{

    case UNKNOWN = -1;
    case LINEAR = 0;
    case SPRING = 1;
    case IN_QUAD = 2;
    case OUT_QUAD = 3;
    case IN_OUT_QUAD = 4;
    case IN_CUBIC = 5;
    case OUT_CUBIC = 6;
    case IN_OUT_CUBIC = 7;
    case IN_QUART = 8;
    case OUT_QUART = 9;
    case IN_OUT_QUART = 10;
    case IN_QUINT = 11;
    case OUT_QUINT = 12;
    case IN_OUT_QUINT = 13;
    case IN_SINE = 14;
    case OUT_SINE = 15;
    case IN_OUT_SINE = 16;
    case IN_EXPO = 17;
    case OUT_EXPO = 18;
    case IN_OUT_EXPO = 19;
    case IN_CIRC = 20;
    case OUT_CIRC = 21;
    case IN_OUT_CIRC = 22;
    case IN_BOUNCE = 23;
    case OUT_BOUNCE = 24;
    case IN_OUT_BOUNCE = 25;
    case IN_BACK = 26;
    case OUT_BACK = 27;
    case IN_OUT_BACK = 28;
    case IN_ELASTIC = 29;
    case OUT_ELASTIC = 30;
    case IN_OUT_ELASTIC = 31;

    public static function safe(int $value) : self{
        return self::tryFrom($value) ?? self::UNKNOWN;
    }

    public static function fromString(string $value) : self{
        return match($value){
            "linear" => self::LINEAR,
            "spring" => self::SPRING,
            "in_quad" => self::IN_QUAD,
            "out_quad" => self::OUT_QUAD,
            "in_out_quad" => self::IN_OUT_QUAD,
            "in_cubic" => self::IN_CUBIC,
            "out_cubic" => self::OUT_CUBIC,
            "in_out_cubic" => self::IN_OUT_CUBIC,
            "in_quart" => self::IN_QUART,
            "out_quart" => self::OUT_QUART,
            "in_out_quart" => self::IN_OUT_QUART,
            "in_quint" => self::IN_QUINT,
            "out_quint" => self::OUT_QUINT,
            "in_out_quint" => self::IN_OUT_QUINT,
            "in_sine" => self::IN_SINE,
            "out_sine" => self::OUT_SINE,
            "in_out_sine" => self::IN_OUT_SINE,
            "in_expo" => self::IN_EXPO,
            "out_expo" => self::OUT_EXPO,
            "in_out_expo" => self::IN_OUT_EXPO,
            "in_circ" => self::IN_CIRC,
            "out_circ" => self::OUT_CIRC,
            "in_out_circ" => self::IN_OUT_CIRC,
            "in_bounce" => self::IN_BOUNCE,
            "out_bounce" => self::OUT_BOUNCE,
            "in_out_bounce" => self::IN_OUT_BOUNCE,
            "in_back" => self::IN_BACK,
            "out_back" => self::OUT_BACK,
            "in_out_back" => self::IN_OUT_BACK,
            "in_elastic" => self::IN_ELASTIC,
            "out_elastic" => self::OUT_ELASTIC,
            "in_out_elastic" => self::IN_OUT_ELASTIC,
            default => self::UNKNOWN
        };
    }

    public function toString() : string{
        return match($this){
            self::LINEAR => "linear",
            self::SPRING => "spring",
            self::IN_QUAD => "in_quad",
            self::OUT_QUAD => "out_quad",
            self::IN_OUT_QUAD => "in_out_quad",
            self::IN_CUBIC => "in_cubic",
            self::OUT_CUBIC => "out_cubic",
            self::IN_OUT_CUBIC => "in_out_cubic",
            self::IN_QUART => "in_quart",
            self::OUT_QUART => "out_quart",
            self::IN_OUT_QUART => "in_out_quart",
            self::IN_QUINT => "in_quint",
            self::OUT_QUINT => "out_quint",
            self::IN_OUT_QUINT => "in_out_quint",
            self::IN_SINE => "in_sine",
            self::OUT_SINE => "out_sine",
            self::IN_OUT_SINE => "in_out_sine",
            self::IN_EXPO => "in_expo",
            self::OUT_EXPO => "out_expo",
            self::IN_OUT_EXPO => "in_out_expo",
            self::IN_CIRC => "in_circ",
            self::OUT_CIRC => "out_circ",
            self::IN_OUT_CIRC => "in_out_circ",
            self::IN_BOUNCE => "in_bounce",
            self::OUT_BOUNCE => "out_bounce",
            self::IN_OUT_BOUNCE => "in_out_bounce",
            self::IN_BACK => "in_back",
            self::OUT_BACK => "out_back",
            self::IN_OUT_BACK => "in_out_back",
            self::IN_ELASTIC => "in_elastic",
            self::OUT_ELASTIC => "out_elastic",
            self::IN_OUT_ELASTIC => "in_out_elastic",
            self::UNKNOWN => "unknown",
        };
    }
}