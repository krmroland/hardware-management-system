<?php

namespace Lawma\Forms;

abstract class MultiOptional extends Field
{
    /**
     * the available options for the multiple choice item.
     *
     * @var array
     */
    public $choices = [];
    /**
     * whether or not the field has keys.
     *
     * @var bool
     */
    public $hasKeys = false;

    /**
     * call back for formating the choices.
     *
     * @var bool|Function
     */
    public $callback = false;

    /**
     * set the choices.
     *
     * @param array $choices
     */
    public function choices(array $choices)
    {
        return $this->setProperty('choices', $choices)->tryTriggeringCallback();
    }

    /**
     * checks if the ckeck box or radio is clicked aka checked.
     *
     * @param string $option
     *
     * @return string|null
     */
    public function checkedStatus($option)
    {
        return $this->isSelected($option) ? 'checked' : null;
    }

    /**
     * set the has key property to true.
     *
     * @return self
     */
    public function hasKeys()
    {
        return $this->setProperty('hasKeys', true);
    }

    /**
     * sets the call back formating the value.
     *
     * @param <type> $callback The callback
     */
    public function format($callback)
    {
        return $this->setProperty('callback', $callback)->tryTriggeringCallback();
    }

    /**
     * check if a select box option should be checked.
     *
     * @param string $option
     *
     * @return string
     */
    public function selectedStatus($option)
    {
        return $this->isSelected($option) ? 'selected' : null;
    }

    /**
     * determines if an option is selected.
     *
     * @param string $option
     *
     * @return bool
     */
    public function isSelected($option)
    {
        return $this->getValue() == $option;
    }

    /**
     * trigger the given field call back.
     *
     * @return self
     */
    public function triggerCallback()
    {
        foreach ($this->choices as $choice) {
            $formatedChocies[] = $this->executeCallBack($choice);
        }

        return $this->setProperty('choices', $formatedChocies ?: []);
    }

    protected function executeCallBack($choice)
    {
        $callback = $this->callback;

        return  is_callable($callback) ?
                call_user_func_array($callback, [$choice, $this]) :
                $callback($choice);
    }

    /**
     * we will trigger the call back if it is set.
     *
     * @return self
     */
    public function tryTriggeringCallback()
    {
        return $this->callback ? $this->triggerCallback() : $this;
    }

    /**
     * Gets the placeholder.
     *
     * @return string the placeholder
     */
    public function getPlaceholder()
    {
        return $this->placeholder ?: 'Select ...';
    }

    public function stacked()
    {
        return $this->setProperty('class', 'custom-controls-stacked');
    }
}
