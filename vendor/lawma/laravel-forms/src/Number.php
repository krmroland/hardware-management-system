<?php

namespace Lawma\Forms;

class Number extends Field
{
    public $step = '';

    /**
     * the view responsible for numbers.
     *
     * @return Illuminate\View\View
     */
    public function viewPath()
    {
        return 'forms::numberField';
    }

    /**
     * sets the step.
     *
     * @param int|float $step
     *
     * @return self
     */
    public function step($step)
    {
        $this->step = $step;

        return $this;
    }
}
