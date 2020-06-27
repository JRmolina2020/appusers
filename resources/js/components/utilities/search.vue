<template>
  <div class="input-group input-group-sm">
    <input type="text" class="form-control" v-model="filters.data.value" :placeholder="titleinput" />
    <div class="input-group-append">
      <div class="btn btn-primary">
        <i class="fi fi-search"></i>
      </div>
    </div>
  </div>
</template>
<script>
import { mapState } from "vuex";
export default {
  computed: {
    ...mapState(["filters"])
  },
  props: {
    titleinput: String,
    required: true
  }
};
</script>