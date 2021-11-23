<?php

namespace Virusphp\AutoNumber\Observers;

use Virusphp\AutoNumber\AutoNumber;
use Illuminate\Database\Eloquent\Model;

class AutoNumberObserver
{
    /**
     * @var AutoNumber
     */
    private $autoNumber;

    /**
     * AutoNumberObserver constructor.
     *
     * @param AutoNumber $autoNumber
     */
    public function __construct(AutoNumber $autoNumber)
    {
        $this->autoNumber = $autoNumber;
    }

    /**
     * @param \Illuminate\Database\Eloquent\Model $model
     * @return null
     */
    public function saving(Model $model)
    {
        if (! config('autonumber.onUpdate', false) && $model->exists) {
            return;
        }

        $this->generateAutoNumber($model);
    }

    /**
     * Generate auto number.
     *
     * @param Model $model
     * @return bool
     */
    protected function generateAutoNumber(Model $model)
    {
        $generated = $this->autoNumber->generate($model);

        return $generated;
    }
}
