<?php

namespace d0niek\Tests;

use d0niek\GenericCollection\Collections\ArrayInt;
use d0niek\GenericCollection\Collections\ArrayGenericCollection;
use PHPUnit\Framework\TestCase;

final class ArrayGenericTest extends TestCase
{
    public function testIsInstanceOfArrayGenericCollection(): void
    {
        $this->assertInstanceOf(ArrayGenericCollection::class, new ArrayInt());
    }

    public function testCanBeCreatedWithOneValue(): void
    {
        $array = new ArrayInt(1);

        $this->assertCount(1, $array);
    }

    public function testCanBeCreatedWithMultiValues(): void
    {
        $array = new ArrayInt(1, 2, 45);

        $this->assertCount(3, $array);
    }

    public function testCanBeCreatedWithNumberValues(): void
    {
        $array = new ArrayInt('3', 2.4, -45);

        $this->assertCount(3, $array);
    }

    public function testCannotBeCreatedWithNotNumberValue(): void
    {
        $this->expectException(\TypeError::class);
        $this->expectExceptionMessageRegExp(
            '/Argument 3 passed to .+__construct\(\) must be of the type integer, string given/'
        );

        new ArrayInt(3, 4.5, 'string');
    }

    public function testCanAccesToGenericCollectionAsToNormalArray(): void
    {
        $array = new ArrayInt(3, '4');

        $this->assertSame(4, $array[1]);
        $this->assertSame(3, $array[0]);
    }

    public function testCanAddNewElement(): void
    {
        $array = new ArrayInt(4, 3);

        $array[] = 7;

        $this->assertSame(7, $array[2]);
    }

    public function testCanAddNewElementWithKey(): void
    {
        $array = new ArrayInt(4, 3);

        $array[5] = 34;
        $array['key'] = -4;

        $this->assertSame(34, $array[5]);
        $this->assertSame(-4, $array['key']);
    }

    public function testCannotAddNewElementWithNotNumberValue(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Value string is not instance of int');

        $array = new ArrayInt(4, 5);

        $array[] = 'string';
    }

    public function testCanCheckIfKeyExists(): void
    {
        $array = new ArrayInt(3, 5);

        $this->assertFalse(isset($array[5]));
    }

    public function testCanCountElement(): void
    {
        $array = new ArrayInt(4, 3, -2);

        $this->assertEquals(3, count($array));
    }

    public function testCanIterateInLoop(): void
    {
        $array = new ArrayInt(3, 5, 12);

        foreach ($array as $key => $value) {
            $this->assertSame($array[$key], $value);
        }
    }

    public function testCanBeSerialize(): void
    {
        $array = [1, 4, 5];
        $arrayInt = new ArrayInt(...$array);

        $this->assertContains(serialize($array), serialize($arrayInt));
    }

    public function testCanBeTransformetToArray(): void
    {
        $array = new ArrayInt(34, 1);

        $this->assertTrue(is_array($array->toArray()));
    }
}
