<?php

namespace Lawma\Forms;

use Illuminate\Support\Traits\Macroable;

abstract class Field
{
    use Macroable;
    /**
     * the name of the field.
     */
    public $name = '';
    /**
     * the label for the field.
     */
    public $label;
    /**
     * the place holder.
     */
    public $placeholder;
    /**
     * the field class.
     */
    public $class;

    /**
     * the label class.
     */
    public $labelClass;
    /**
     * the default value.
     */
    public $value;

    /**
     * the model that has this field if any.
     */
    protected $model;

    /**
     * the wrapper class to wrap the field in.
     *
     * @var string
     */
    public $wrapperClass = '';

    /**
     * the view to render.
     *
     * @return View
     */
    abstract public function viewPath();

    /**
     * sets the name.
     *
     * @param string $name
     *
     * @return self
     */
    public function name($name)
    {
        return  $this->setProperty('name', $name);
    }

    /**
     * sets the model instace on the attribute.
     *
     * @param = $model The model
     *
     * @return self
     */
    public function model($model)
    {
        //we will not over ride the model if it is already set
        //because it would be the form over riding it
        //@see forms/form.blade.php
        //but we will have to set the value to reflect the changes

        return $this->model ? $this : $this->setProperty('model', $model)->setValue();
    }

    /**
     * sets the place holder attribute.
     *
     * @param string $placeholder
     *
     * @return self
     */
    public function placeholder($placeholder)
    {
        return $this->setProperty('placeholder', $placeholder);
    }

    /**
     * gets the place holder attributer.
     *
     * @return string|null
     */
    public function getPlaceHolder()
    {
        return $this->placeholder ?: $this->label;
    }

    /**
     * sets the class attribute on the field.
     */
    public function class($class)
    {
        return $this->setProperty('class', $class);
    }

    /**
     * sets the label.
     *
     * @param string $label The label
     *
     * @return self
     */
    public function label($label)
    {
        return $this->setProperty('label', $label);
    }

    /**
     * the label class.
     *
     * @param string $class
     *
     * @return self
     */
    public function labelClass($class)
    {
        return $this->setProperty('labelClass', $class);
    }

    /**
     * sets the wrapper class on the field.
     *
     * @param <type> $class The class
     */
    public function wrapperClass($class)
    {
        return $this->setProperty('wrapperClass', $class);
    }

    /**
     * sets the value.
     *
     * @param string $default
     *
     * @return self
     */
    public function value($value)
    {
        return $this->setProperty('value', $value);
    }

    /**
     * sets the default value.
     *
     * @return null|string
     */
    public function setValue()
    {
        return $this->setProperty('value', old($this->name, $this->defaultValue()));
    }

    public function getValue()
    {
        return $this->value;
    }

    /**
     * we will check if the field has a value on the model.
     *
     * @param string $name
     *
     * @return mixed
     */
    public function defaultValue()
    {
        return $this->value ?: $this->modelValue();
    }

    /**
     * try getting the model value tied to the fields name.
     *
     * @return mixed
     */
    public function modelValue()
    {
        return $this->model ? $this->model->{$this->name} : null;
    }

    /**
     * sets a property on the instance.
     *
     * @param string $property
     * @param mixed  $data
     *
     * @return self
     */
    protected function setProperty($property, $data)
    {
        $this->$property = $data;

        return $this;
    }

    /**
     * the data we will pass to the view.
     *
     * @return array
     */
    public function viewData()
    {
        return ['field' => $this];
    }

    /**
     * render this field.
     */
    public function render()
    {
        //we will set the default value of the field before casting it to a string if we have a name
        !$this->name ?: $this->setValue();

        return $this;
    }
}
