<template>
  <div>
    <button
      type="button"
      class="btn bg-purple btn-sm"
      @click="clear"
      data-toggle="modal"
      :data-target="'#modelpassword' + row.id"
    >
      <i class="fi fi-key"></i>
    </button>
    <div class="modal fade" :id="'modelpassword' + row.id">
      <div class="modal-dialog">
        <div class="modal-content">
          <form
            method="POST"
            @submit.prevent="updatepassword(row)"
            autocomplete="off"
            enctype="multipart/form-data"
          >
            <div class="modal-body">
              <div class="callout callout-danger">
                <p>
                  <strong>INFO!</strong>En este apartado puedes gestionar la contraseña del usuario
                </p>
              </div>
              <div class="col-lg-12">
                <div class="form-group">
                  <input
                    type="password"
                    v-validate="'required|max:30|min:3'"
                    class="form-control"
                    :class="{
                                            'is-invalid':
                                                submitted &&
                                                errors.has('password')
                                        }"
                    placeholder="Digite la nueva contraseña"
                    v-model="form.password"
                    name="password"
                  />
                  <div
                    v-if="
                                            submitted && errors.has('password')
                                        "
                    class="invalid-feedback"
                  >{{ errors.first("password") }}</div>
                </div>
              </div>
            </div>

            <div class="modal-footer">
              <button :hidden="errors.any()" type="submit" class="btn btn-outline-primary">
                <i class="fi fi-wink"></i>
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  $_veeValidate: {
    validator: "new"
  },
  props: {
    row: {
      type: Object,
      required: true
    }
  },
  name: "modalresource",
  data() {
    return {
      url: "api/users/password",
      submitted: true,
      form: {
        password: null
      }
    };
  },
  methods: {
    updatepassword(row) {
      this.$validator.validate().then(valid => {
        if (valid) {
          let url = `${this.url}/${row.id}`;
          axios
            .put(url, this.form)
            .then(response => {
              Swal.fire({
                position: "center",
                icon: "success",
                title: `${response.data.message}`,
                showConfirmButton: false,
                timer: 1500
              });
              $("#modelpassword" + row.id).modal("hide");
              this.$store.dispatch("Useractions");
            })
            .catch(error => {
              console.log(error.response);
            });
        }
      });
    },
    clear() {
      this.form.password = null;
      this.$validator.reset();
    }
  }
};
</script>