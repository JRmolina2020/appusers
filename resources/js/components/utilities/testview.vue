<template>
  <div>
    <button
      type="button"
      class="btn btn-primary btn-sm"
      data-toggle="modal"
      :data-target="'#model' + row.id"
    >
      <i class="fi fi-email"></i>
    </button>
    <div
      class="modal fade"
      :id="'model' + row.id"
      tabindex="-1"
      role="dialog"
      aria-labelledby="modelTitleId"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-body">
            <i class="fi fi-email" aria-hidden="true"></i>
            {{ row.email }}
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: {
    row: {
      type: Object,
      required: true
    }
  }
};
</script>