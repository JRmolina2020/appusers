<template>
  <div>
    <Modal-Resource v-on:clear="clear" title="Registro de roles">
      <section v-if="!form.id" slot="title">Registro de permisos</section>
      <section v-else slot="title">Editar permiso</section>
      <section slot="closebtn">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </section>
      <section slot="titlebutton">Registrar permiso</section>
      <section slot="body">
        <form method="POST" @submit.prevent="add(form.id)" autocomplete="off">
          <div class="form-group">
            <label for>Nombre</label>
            <input
              type="text"
              v-validate="'required|max:30|min:3'"
              class="form-control form-control-sm"
              :class="{
                                'is-invalid': submitted && errors.has('nombre')
                            }"
              placeholder="Nombre del permiso a registrar"
              v-model="form.name"
              name="nombre"
            />
            <div
              v-if="submitted && errors.has('nombre')"
              class="invalid-feedback"
            >{{ errors.first("nombre") }}</div>
          </div>

          <button
            :hidden="errors.any()"
            type="submit"
            v-bind:class="{
                            'btn btn-outline-primary ': !this.form.id,
                            'btn btn-outline-danger ': this.form.id
                        }"
          >
            <i
              v-bind:class="{
                                'fi fi-wink': !this.form.id,
                                'fi fi-like': this.form.id
                            }"
              aria-hidden="true"
            ></i>
          </button>
        </form>
      </section>
    </Modal-Resource>
  </div>
</template>
<script>
import ModalResource from "../utilities/modal.vue";
import { mapState } from "vuex";
export default {
  $_veeValidate: {
    validator: "new"
  },
  name: "add",
  components: {
    ModalResource
  },
  data() {
    return {
      url: "api/permissions",

      submitted: true,
      form: {
        id: null,
        name: null
      }
    };
  },
  computed: {},
  methods: {
    add(id) {
      this.$validator.validate().then(valid => {
        if (valid) {
          if (id) {
            let url = `${this.url}/${id}`;
            axios
              .put(url, this.form)
              .then(response => {
                this.$store.dispatch("Permissionsactions");
                Swal.fire({
                  position: "center",
                  icon: "success",
                  title: `${response.data.message}`,
                  showConfirmButton: false,
                  timer: 1500
                });
                $("#model").modal("hide");
                this.clear();
              })
              .catch(error => {
                console.log(error.response);
              });
          } else {
            axios
              .post(this.url, this.form)
              .then(response => {
                Swal.fire({
                  position: "center",
                  icon: "success",
                  title: `${response.data.message}`,
                  showConfirmButton: false,
                  timer: 1500
                });
                $("#model").modal("hide");
                this.$store.dispatch("Permissionsactions");
                this.clear();
              })
              .catch(error => {
                console.log(error.response);
              });
          }
        }
      });
    },
    show(row) {
      this.status = true;
      this.form.name = row.name;
      this.form.id = row.id;
      $("#model").modal("show");
    },
    clear() {
      this.form.id = null;
      this.form.name = null;
      this.$validator.reset();
    }
  }
};
</script>