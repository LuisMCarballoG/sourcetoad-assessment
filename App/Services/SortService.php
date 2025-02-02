<?php

namespace App\Services;

class SortService
{
    /**
     * @param array<string, mixed> $array
     * @param string[] $keys
     * @return list<mixed>
     */
    public function sortData(array &$array, $keys): array
    {
        $comparator = function ($a, $b) use ($keys) {
            foreach ($keys as $key) {
                $valA = $this->findNestedValue($a, $key);
                $valB = $this->findNestedValue($b, $key);

                if ($valA === null && $valB === null) {
                    continue;
                }
                if ($valA === null) {
                    return -1;
                }
                if ($valB === null) {
                    return 1;
                }

                $cmp = $valA <=> $valB;
                if ($cmp !== 0) {
                    return $cmp;
                }
            }
            return 0;
        };

        usort($array, $comparator);

        return $array;
    }

    /**
     * @param array<mixed, mixed> $array
     * @param mixed $targetKey
     * @return mixed
     */
    private function findNestedValue(array $array, mixed $targetKey): mixed
    {
        foreach ($array as $key => $value) {
            if ($key === $targetKey) {
                return $value;
            }
            if (is_array($value)) {
                $result = $this->findNestedValue($value, $targetKey);
                if ($result !== null) {
                    return $result;
                }
            }
        }
        return null;
    }
}
