<template>
    <DefaultField
        :field="currentField"
        :errors="errors"
    >
        <template #field>
            <VDatePicker
                v-model="value"
                ref="superDatePicker"
                :key="currentField.attribute"
                :id="currentField.attribute"
                :dusk="currentField.attribute"
                :name="currentField.name"
                :attributes="attributeCalendar"
                format-date="YYYY-MM-DD"
                :mask="{
                  input: 'YYYY-MM-DD',
                }"
                :allowed-dates="currentField.allowedDates"
                :allowed-months="currentField.allowedMonths"
                :allowed-years="currentField.allowedYears"
                :first-day-of-week="currentField.firstDayOfWeek"
                :control-height="currentField.controlHeight"
                :control-variant="currentField.controlVariant"
                :locale="currentField.locale"
                :multiple="currentField.isRange"
                :border="currentField.border"
                :timezone="currentField.timezone"
                :is-dark="currentField.isDark"
                :elevation="currentField.elevation"
                :is-required="currentField.isRequired"
                :min-date="currentField.minDate"
                :max-date="currentField.maxDate"
                :disabled='currentField.disabled'
                :disabled-dates='currentField.disabledDates'
                :color="currentField.color"
            >
                <template #default="{ inputValue, inputEvents }">
                    <input
                        type="text"
                        disabled
                        :value="inputValue"
                        v-on="inputEvents"
                        class="w-full form-control form-input form-control-bordered"
                    />
                </template>
            </VDatePicker>
        </template>
    </DefaultField>
</template>

<script>
import {DependentFormField, HandlesValidationErrors,} from 'laravel-nova'

export default {
    mixins: [DependentFormField, HandlesValidationErrors],

    props: ['resourceName', 'resourceId', 'field'],

    watch: {
        hasError(val) {
            let errorClass = val ? this.errorClasses.join() : null;
        },
        'value': function (newValue, oldValue) {
            this.handleChange({
                target: {
                    value: newValue
                }
            });
        },
    },

    data() {
        return {
            attributeCalendar: [],
        }
    },

    computed: {
        placeholder() {
            return this.field.placeholder || moment().format(this.format)
        },

        format() {
            return 'YYYY-MM-DD'
        },
    },

    methods: {
        /*
         * Set the initial, internal value for the field.
         */
        setInitialValue() {
            this.value = this.field.value || null;

            if (this.value) {
                this.value = this.value;
            }

            this.fillAttributesCalendar();

            this.fillSelectAttributesCalendar();
        },

        /**
         * Fill the given FormData object with the field's internal value.
         */
        fill(formData) {

            let date = this.value;

            if (date) {
                date = moment(this.value).format(this.format);
            }

            formData.append(this.field.attribute, date || '');
        },

        /**
         * Fill attributes
         */
        fillAttributesCalendar() {
            if (this.field.attributeCalendar.length > 0) {
                this.field.attributeCalendar.forEach(fieldAttr => {
                    let attr = this.getAttributeCalendar(fieldAttr);
                    this.attributeCalendar.push(attr);
                });
            }
        },

        /**
         * Fill select attributes
         */
        fillSelectAttributesCalendar() {
            if (this.field.selectAttribute != null) {
                this.selectAttribute = this.getAttributeCalendar(this.field.selectAttribute);
            }
        },

        /**
         * Get attributes
         */
        getAttributeCalendar(attribute) {
            let attr = {
                key: attribute.key,
                content: attribute.content,
                order: attribute.order,
            };

            if (attribute.popover !== null) {
                attr.popover = {
                    hideIndicator: attribute.popover.hideIndicator,
                    label: attribute.popover.label,
                    visibility: attribute.popover.visibility,
                };
            }

            attr[attribute.typeName] = attribute.typeValue;

            if (attribute.dates != null) {
                attr.dates = attribute.dates.map(dateField => {
                    return moment(dateField.date).format(this.format);
                });
            }

            if (attribute.excludeDates != null) {
                attr.excludeDates = attribute.excludeDates.map(dateField => {
                    return moment(dateField.date).format(this.format);
                });
            }

            return attr;
        }
    },
}
</script>
