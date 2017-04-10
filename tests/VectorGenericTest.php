<?php

namespace d0niek\Tests;

use d0niek\GenericCollection\Collections\VectorInt;
use d0niek\GenericCollection\Collections\VectorGenericCollection;
use PHPUnit\Framework\TestCase;

final class VectorGenericTest extends TestCase
{
    public function testIsInstanceOfArrayGenericCollection(): void
    {
        $this->assertInstanceOf(VectorGenericCollection::class, new VectorInt());
    }

    public function testCanBeCreatedWithOneValue(): void
    {
        $array = new VectorInt(1);

        $this->assertSame(1, $array->count());
    }

    public function testCanBeCreatedWithMultiValues(): void
    {
        $array = new VectorInt(1, 2, 45);

        $this->assertSame(3, $array->count());
    }

    public function testCanBeCreatedWithNumberValues(): void
    {
        $array = new VectorInt('3', 2.4, -45);

        $this->assertSame(3, $array->count());
    }

    public function testCannotBeCreatedWithNotNumberValue(): void
    {
        $this->expectException(\TypeError::class);
        $this->expectExceptionMessageRegExp(
            '/Argument 3 passed to .+__construct\(\) must be of the type integer, string given/'
        );

        new VectorInt(3, 4.5, 'string');
    }

    public function testCanAccesToGenericCollectionAsToNormalArray(): void
    {
        $array = new VectorInt(3, '4');

        $this->assertSame(4, $array[1]);
        $this->assertSame(3, $array[0]);
    }

    public function testAllocatesEnoughMemoryForRequiredCapacity(): void
    {
        $vector = new VectorInt();

        $vector->allocate(30);

        $this->assertSame(30, $vector->capacity());
    }

    public function testUpdatesAllValuesByApplyingCallbackFunctionToEachValue(): void
    {
        $array = [2, 4, 5];
        $vector = new VectorInt(...$array);

        $vector->apply(function (int $value): int {
            return $value * 2;
        });

        foreach ($array as $key => $value) {
            $this->assertSame($value * 2, $vector[$key]);
        }
    }

    public function testRemovesAllValues(): void
    {
        $vector = new VectorInt(3, 5, 7);

        $countBeforeClear = $vector->count();
        $vector->clear();

        $this->assertGreaterThan($vector->count(), $countBeforeClear);
        $this->assertSame(0, $vector->count());
    }

    public function testDeterminesIfVectorContainsGIvenValues(): void
    {
        $vector = new VectorInt(3, 2, 56);

        $this->assertTrue($vector->contains(2, 3));
        $this->assertFalse($vector->contains(-4));
    }

    public function testReturnShallowCopyOfVector(): void
    {
        $vector = new VectorInt(4, 3, 2);

        $vectorCopy = $vector->copy();

        $this->assertInstanceOf(get_class($vector), $vector);
        $this->assertSame($vector->count(), $vectorCopy->count());

        $vectorCopy->push(12);

        $this->assertNotSame($vector->count(), $vectorCopy->count());
    }

    public function testReturnsNumberOfValuesInCollection(): void
    {
        $vector = new VectorInt(3, 4, 12);

        $this->assertSame(count($vector), $vector->count());
    }

    public function testCreatesNewVectorUsingCallableToDetermineWhichValuesToInclude(): void
    {
        $vector = new VectorInt(2, 3, 4, 5, 6);

        $filterVector = $vector->filter(function (int $value): bool {
            return $value % 2 === 0;
        });

        $this->assertInstanceOf(get_class($vector), $filterVector);
        $this->assertFalse($filterVector->contains(3, 5));
    }

    public function testAttemptsToFindValuesIndex(): void
    {
        $vector = new VectorInt(5, 3, 67);

        $this->assertSame(1, $vector->find(3));
        $this->assertSame(-1, $vector->find(1));
    }

    public function testReturnsFirstValueInVector(): void
    {
        $vector = new VectorInt(3, 2, 1);

        $this->assertSame(3, $vector->first());
    }

    public function testReturnsValueAtGivenIndex(): void
    {
        $vector = new VectorInt(3, 45, -3);

        $this->assertSame(-3, $vector->get(2));
        $this->assertSame($vector[2], $vector->get(2));
    }

    public function testCallToNotexistingIndex(): void
    {
        $this->expectException(\OutOfRangeException::class);

        $vector = new VectorInt(3);

        $vector[2];
    }

    public function testInsertValuesAtGivenIndex(): void
    {
        $vector = new VectorInt();

        $vector->insert(0, 23);
        $vector->insert(1, 2);
        $vector->insert(0, 45, 32);

        $this->assertCount(4, $vector);
        $this->assertSame(32, $vector[1]);
    }

    public function testInsertToNotExistingIndex(): void
    {
        $this->expectException(\OutOfRangeException::class);

        $vector = new VectorInt(2, 3);

        $vector->insert(5, 34);
    }

    public function testVectorIsEmpty(): void
    {
        $vector = new VectorInt();

        $this->assertTrue($vector->isEmpty());
    }

    public function testVectorIsNotEmpty(): void
    {
        $vector = new VectorInt(1, 2);

        $this->assertFalse($vector->isEmpty());
    }

    public function testJoinsAllValuesTogetherAsString(): void
    {
        $vector = new VectorInt(3, 4, 7);

        $this->assertSame('3,4,7', $vector->join(','));
        $this->assertSame('347', $vector->join());
    }

    public function testReturnsLastValue(): void
    {
        $vector = new VectorInt(2, 4, 6);

        $this->assertSame(6, $vector->last());
    }

    public function testReturnsResultOfApplyingCallbackToEachValue(): void
    {
        $vector = new VectorInt(1, 2, 3);

        $vectorMap = $vector->map(function (int $value): int {
            return $value + 2;
        });

        $this->assertInstanceOf(get_class($vector), $vectorMap);
        foreach ($vectorMap as $key => $value) {
            $this->assertSame($value, $vector[$key] + 2);
        }
    }

    public function testReturnsResultOfAddingAllGivenValuesToVector(): void
    {
        $vector = new VectorInt(1, 3, 5);

        $vectorMerge = $vector->merge(2, 4);

        $this->assertInstanceOf(get_class($vector), $vectorMerge);
        $this->assertSame(4, $vectorMerge->last());
    }

    public function testRemovesAndReturnsLastValue(): void
    {
        $vector = new VectorInt(45, 2, 37);

        $value = $vector->pop();

        $this->assertSame(2, $vector->last());
        $this->assertSame(37, $value);
    }

    public function testRemoveLastElementFromEmptyVector(): void
    {
        $this->expectException(\UnderflowException::class);

        $vector = new VectorInt();

        $vector->pop();
    }

    public function testAddsValuesToEndOfVector(): void
    {
        $vector = new VectorInt(23, 2);

        $vector->push(3);
        $vector->push(1, 56);

        $this->assertSame(56, $vector->last());
        $this->assertCount(5, $vector);
    }

    public function testReducesVectorToSingleValueUsingCallbackFunction(): void
    {
        $vector = new VectorInt(1, 2, 3);

        $value = $vector->reduce(function (int $carry, int $value): int {
            return $carry * $value;
        }, 5);

        $this->assertSame(30, $value);
    }

    public function testRemovesAndReturnsValueByIndex(): void
    {
        $vector = new VectorInt(3, 4, 5);

        $value = $vector->remove(1);

        $this->assertCount(2, $vector);
        $this->assertSame(4, $value);
    }

    public function testRemoveElementByNotExistingIndex(): void
    {
        $this->expectException(\OutOfRangeException::class);

        $vector = new VectorInt(45, 23);

        $vector->remove(5);
    }

    public function testReversesVectorInPlace(): void
    {
        $vector = new VectorInt(1, 2, 3);

        $vector->reverse();

        $this->assertSame(1, $vector->last());
    }

    public function testReturnsReversedCopy(): void
    {
        $vector = new VectorInt(23, 56, 95);

        $reversedVector = $vector->reversed();

        $this->assertInstanceOf(get_class($vector), $reversedVector);
        $this->assertSame($vector->first(), $reversedVector->last());
    }

    public function testRotatesVectorByGivenNumberOfRotation(): void
    {
        $vector = new VectorInt(23, 34, 45);

        $vector->rotate(2);

        $this->assertSame(34, $vector->last());
        $this->assertSame(45, $vector->first());
    }

    public function testUpdatesValueAtGivenIndex(): void
    {
        $vector = new VectorInt(12, 23, 34);

        $vector->set(2, 43);

        $this->assertSame(43, $vector[2]);

        $vector[1] = 0;

        $this->assertSame(0, $vector[1]);
    }

    public function testUpdateValueAtNotExistingIndex(): void
    {
        $this->expectException(\OutOfRangeException::class);
        $vector = new VectorInt(12, 23, 34);

        $vector->set(5, 43);
    }

    public function testRemovesAndReturnsFirstValue(): void
    {
        $vector = new VectorInt(34, 543, 2);

        $value = $vector->shift();

        $this->assertSame(34, $value);
        $this->assertCount(2, $vector);
    }

    public function testRemoveFirstElementFromEmptyVector(): void
    {
        $this->expectException(\UnderflowException::class);

        $vector = new VectorInt();

        $vector->shift();
    }

    public function testReturnsSubvectorOfGivenRange(): void
    {
        $vector = new VectorInt(1, 2, 3, 4, 5, 6);

        $sliceVector = $vector->slice(2, 3);

        $this->assertInstanceOf(get_class($vector), $sliceVector);
        $this->assertCount(3, $sliceVector);
        $this->assertSame($sliceVector->last(), $vector[4]);
    }

    public function testSortsVectorInPlace(): void
    {
        $vector = new VectorInt(34, 26, 58, 4);

        $vector->sort();

        $this->assertSame(4, $vector->first());
        $this->assertSame(58, $vector->last());
    }

    public function testReturnsSortedCopy(): void
    {
        $vector = new VectorInt(34, 26, 58, 4);

        $sortedVector = $vector->sorted(function (int $a, int $b): int {
            return $b <=> $a;
        });

        $this->assertSame(58, $sortedVector->first());
    }

    public function testReturnsSumOfAllValuesInVector(): void
    {
        $vector = new VectorInt(45, 5.7, 12);

        $this->assertSame(62, $vector->sum());
    }

    public function testAddsValuesToFrontOfVector(): void
    {
        $vector = new VectorInt(1, 2);

        $vector->unshift(4, 6);

        $this->assertCount(4, $vector);
        $this->assertSame(4, $vector->first());
    }
}
