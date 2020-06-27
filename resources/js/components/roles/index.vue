<template>
  <div>
    <Add ref="form_role"></Add>
    <List-Role v-on:show="show" class="mt-3"></List-Role>
  </div>
</template>
<script>
import Add from "./add";
import ListRole from "./list";
export default {
  name: "roles",
  components: {
    ListRole,
    Add
  },
  methods: {
    show(row) {
      this.$refs.form_role.show(row);
    }
  }
};
</script>