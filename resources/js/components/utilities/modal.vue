<template>
  <div>
    <button
      type="button"
      @click="$emit('clear')"
      class="btn btn-primary btn-sm"
      data-toggle="modal"
      data-target="#model"
    >
      <slot name="titlebutton"></slot>
    </button>
    <div class="modal fade" data-backdrop="static" data-keyboard="false" d tabindex="-1" id="model">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <p class="modal-title">
              <slot name="title"></slot>
            </p>
            <slot name="closebtn"></slot>
          </div>
          <div class="modal-body">
            <slot name="body"></slot>
          </div>
          <slot name="buttonsmodal"></slot>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: "modalresource"
};
</script>