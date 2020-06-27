<template>
  <div>
    <Add ref="form_user"></Add>
    <List-User v-on:show="show" class="mt-3"></List-User>
  </div>
</template>
<script>
import Add from "./add";
import ListUser from "./list";
export default {
  name: "users",
  components: {
    ListUser,
    Add
  },
  methods: {
    show(row) {
      this.$refs.form_user.show(row);
    }
  }
};
</script>