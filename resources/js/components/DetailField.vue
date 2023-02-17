<template>
  <panel-item :field="field">
    <template #value>
      <span class="whitespace-no-wrap px-2 py-1 rounded-full uppercase text-xs font-bold bg-green-500 mr-1"
            v-for="role in roles"
            :key="role.id"
      >
          {{ role.name }}
      </span>
    </template>
  </panel-item>
</template>

<script>
export default {
  props: ['resource', 'resourceName', 'resourceId', 'field'],

  computed: {
    roles: function value() {
      return this.field.value;
    },
  },
}
</script>
