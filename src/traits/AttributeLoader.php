<?php
namespace core\traits;

trait AttributeLoader
{
    /**
     * 加载类属性值
     * @param array $attributes
     * @param bool $strict
     * @return bool
     */
    public function load(array $attributes = [], $strict = false) : bool
    {
        try {
            $rc = new \ReflectionClass(static::class);
        } catch (\Exception $e) {
            return false;
        }
        $publicProperties = $rc->getProperties(\ReflectionProperty::IS_PUBLIC);

        $propertyNames = [];

        foreach ($publicProperties as $property) {
            $propertyNames[] = $property->name;
        }

        foreach ($attributes as $key => $value) {
            if (in_array($key, $propertyNames)) {
                $this->$key = $value;
            } else {
                if ($strict) {
                    return false;
                }
            }
        }

        return true;
    }
}