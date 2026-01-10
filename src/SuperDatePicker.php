<?php

namespace AbdullahFaqeir\VCalendar;

use Laravel\Nova\Fields\Date;
use Illuminate\Support\Facades\App;
use AbdullahFaqeir\VCalendar\Attributes\AttributeVCalendar;
use AbdullahFaqeir\VCalendar\Interval\IntervalDatesVCalendar;
use AbdullahFaqeir\VCalendar\Disabled\DisabledDatesVCalendar;

class SuperDatePicker extends Date
{

    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'super-date-picker';


    protected $attributes = [];

    protected $disabledDates = [];

    /**
     * Create a new field.
     *
     * @param string      $name
     * @param string|null $attribute
     * @param mixed|null  $resolveCallback
     *
     * @return void
     */
    public function __construct($name, $attribute = null, $resolveCallback = null)
    {
        parent::__construct($name, $attribute, $resolveCallback);
        
        $this->locale(App::getLocale());

        $this->withMeta(['attributeCalendar' => []]);
        $this->withMeta(['minDate' => null]);
        $this->withMeta(['maxDate' => null]);
        $this->withMeta(["isRange" => false]);
        $this->withMeta(["disabled" => []]);
        $this->withMeta(["color" => 'blue']);
        $this->withMeta(["elevation" => 'undefined']);
        $this->withMeta(["firstFayOfWeek" => 'undefined']);
        $this->withMeta(["allowedDates" => 'undefined']);
        $this->withMeta(["allowedMonths" => 'undefined']);
        $this->withMeta(["allowedYears" => 'undefined']);
        $this->withMeta(["controlHeight" => 'undefined']);
        $this->withMeta(["border" => false]);
        $this->withMeta(["divided" => false]);
        $this->withMeta(["header" => '$vuetify.datePicker.header']);
    }

    public function header(string $header): self
    {
        return $this->withMeta([
            'header' => $header,
        ]);
    }

    public function firstDayOfWeek(string|int $firstDayOfWeek): self
    {
        return $this->withMeta([
            'firstDayOfWeek' => $firstDayOfWeek,
        ]);
    }

    public function elevation(string|int $elevation): self
    {
        return $this->withMeta([
            'elevation' => $elevation,
        ]);
    }

    public function allowedDates(array $allowedDates): self
    {
        return $this->withMeta([
            'allowedDates' => $allowedDates,
        ]);
    }

    public function allowedMonths(array $allowedMonths): self
    {
        return $this->withMeta([
            'allowedMonths' => $allowedMonths,
        ]);
    }

    public function allowedYears(array $allowedYears): self
    {
        return $this->withMeta([
            'allowedYears' => $allowedYears,
        ]);
    }

    public function bgColor(string $bgColor): self
    {
        return $this->withMeta([
            'bgColor' => $bgColor,
        ]);
    }

    public function border(string|int|bool $border): self
    {
        return $this->withMeta([
            'border' => $border,
        ]);
    }

    public function divided(bool $divided): self
    {
        return $this->withMeta([
            'divided' => $divided,
        ]);
    }

    public function timezone(string $timezone): self
    {
        return $this->withMeta([
            'timezone' => $timezone,
        ]);
    }

    public function isDark(): self
    {
        return $this->withMeta([__FUNCTION__ => true]);
    }

    public function locale(string $locale): self
    {
        return $this->withMeta([__FUNCTION__ => $locale]);
    }

    public function attributeCalendar(AttributeVCalendar $attribute): self
    {
        $this->attributes[] = $attribute;

        return $this->withMeta([__FUNCTION__ => $this->attributes]);
    }

    public function minDate($date): self
    {
        return $this->withMeta([__FUNCTION__ => $date]);
    }

    public function maxDate($date): self
    {
        return $this->withMeta([__FUNCTION__ => new \DateTime($date)]);
    }

    public function disabled(DisabledDatesVCalendar $disable, IntervalDatesVCalendar $interval = null): self
    {
        $this->disabledDates[] = $disable->toArray($interval);

        return $this->withMeta([__FUNCTION__ => $this->disabledDates]);
    }

    public function disabledDates(...$disabled): self
    {
        foreach ($disabled as $date) {
            $this->disabledDates[] = $date;
        }

        return $this->withMeta(['disabledDates' => $this->disabledDates]);
    }

    public function disabledDatesMany($disabled = []): self
    {
        foreach ($disabled as $date) {
            $this->disabledDates[] = $date;
        }

        return $this->withMeta(['disabledDates' => $this->disabledDates]);
    }

    public function selectAttribute(AttributeVCalendar $attributeVCalendar): self
    {
        return $this->withMeta([__FUNCTION__ => $attributeVCalendar]);
    }

    public function color(string $color): self
    {
        return $this->withMeta([__FUNCTION__ => $color]);
    }
}
