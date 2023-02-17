<template>
  <div>
        <span class="whitespace-no-wrap px-2 py-1 rounded-full uppercase text-xs font-bold bg-green-500 mr-1"
              v-for="role in roles" :key="role.id">
            {{ role.name }}
        </span>
  </div>
</template>

<script>
export default {
  props: ['resourceName', 'field'],
  computed: {
    roles: function value() {
      return this.field.value;
    },
  },
}
</script>
