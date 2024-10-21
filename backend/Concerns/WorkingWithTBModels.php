<?php

namespace backend\Concerns;

trait WorkingWithTBModels
{
    public function getModelId()
    {
        return $this->id;
    }

    public function getModelName()
    {
        return self::tableName();
    }
}
