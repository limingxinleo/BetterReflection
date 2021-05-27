<?php

declare(strict_types=1);

namespace Roave\BetterReflection\Reflection;

use Roave\BetterReflection\Reflector\Reflector;

class ReflectionUnionType extends ReflectionType
{
    private string $type;

    private array $types;

    private bool $allowsNull;

    private Reflector $reflector;

    private function __construct()
    {
    }

    public static function createFromTypesAndReflector(
        array $types,
        bool $allowsNull,
        Reflector $classReflector
    ): self
    {
        $reflectionType = new self();

        $reflectionType->types = $types;
        $reflectionType->allowsNull = $allowsNull;
        $reflectionType->reflector = $classReflector;
        $reflectionType->type = implode('|', array_filter(array_map(static function (ReflectionType $t) {
            return (string) $t;
        }, $types)));

        return $reflectionType;
    }

    /** @return ReflectionType[] */
    public function getTypes()
    {
        return $this->types;
    }

    public function __toString(): string
    {
        return $this->type;
    }
}
