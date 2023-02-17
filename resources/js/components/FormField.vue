<template>
  <default-field :field="field" :errors="errors">
    <template #field>
      <checkbox-with-label
        class="mt-2"
        v-for="option in value"
        :key="option.name"
        :name="option.name"
        :checked="option.checked"
        @input="toggle($event, option)"
        :disabled="isReadonly"
      >
        {{ option.name }}
      </checkbox-with-label>
    </template>
  </default-field>
</template>

<script>
import {FormField, HandlesValidationErrors} from 'laravel-nova'

export default {
  mixins: [FormField, HandlesValidationErrors],

  props: ['resourceName', 'resourceId', 'field'],

  methods: {
    /*
     * Set the initial, internal value for the field.
     */
    setInitialValue() {
      this.value = this.field.value || {}

      this.value = _(this.field.roles)
        .map(o => {
          const exists = _(this.field.value).find(selectedRole => selectedRole.name == o.name);
          const checked = !!exists;

          return {
            name: o.name,
            checked: checked,
          }
        })
        .value()
    },

    /**
     * Fill the given FormData object with the field's internal value.
     */
    fill(formData) {
      formData.append(this.field.attribute, JSON.stringify(this.finalPayload))
    },

    /**
     * Toggle the option's value.
     */
    toggle(event, option) {
      const firstOption = _(this.value).find(o => o.name == option.name)
      firstOption.checked = event.target.checked
    },
  },

  computed: {
    /**
     * Return the final filtered json object
     */
    finalPayload() {
      return _(this.value)
        .filter('checked')
        .map('name')
        .value();
    },
  },
}
</script>
