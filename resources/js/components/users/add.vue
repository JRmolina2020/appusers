<template>
  <div>
    <Modal-Resource v-on:clear="clear" title="Registro de usuarios">
      <section v-if="!form.id" slot="title">Registro de usuarios</section>
      <section v-else slot="title">Editar usuarios</section>
      <section slot="closebtn">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </section>
      <section slot="titlebutton">Registrar usuarios</section>
      <section slot="body">
        <form
          method="POST"
          @submit.prevent="add(form.id,actions)"
          autocomplete="off"
          enctype="multipart/form-data"
        >
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label for>Nombre</label>
                <input
                  type="text"
                  v-validate="'required|max:30|min:3'"
                  class="form-control form-control-sm"
                  :class="{
                                'is-invalid': submitted && errors.has('nombre')
                            }"
                  placeholder="Nombre"
                  v-model="form.name"
                  name="nombre"
                />
                <div
                  v-if="submitted && errors.has('nombre')"
                  class="invalid-feedback"
                >{{ errors.first("nombre") }}</div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label for>Apellido</label>
                <input
                  type="text"
                  v-validate="'required|max:30|min:3'"
                  class="form-control form-control-sm"
                  :class="{
                                'is-invalid':
                                    submitted && errors.has('apellido')
                            }"
                  placeholder="Apellido"
                  v-model="form.surname"
                  name="apellido"
                />
                <div
                  v-if="submitted && errors.has('apellido')"
                  class="invalid-feedback"
                >{{ errors.first("apellido") }}</div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label for>Email</label>
                <input
                  type="email"
                  v-validate="'required|max:30|min:3'"
                  class="form-control form-control-sm"
                  :class="{
                                'is-invalid': submitted && errors.has('email')
                            }"
                  placeholder="Email"
                  v-model="form.email"
                  name="email"
                />
                <div
                  v-if="submitted && errors.has('email')"
                  class="invalid-feedback"
                >{{ errors.first("email") }}</div>
              </div>
            </div>
            <div class="col-lg-6">
              <div>
                <div class="form-group">
                  <label>Rol</label>
                  <select
                    v-model="form.rol"
                    v-validate="'required'"
                    class="form-control form-control-sm"
                    name="rol"
                    :class="{
                                'is-invalid': submitted && errors.has('rol')
                            }"
                  >
                    <option
                      v-for="(item, index) in roles"
                      :value="item.name"
                      :key="index"
                    >{{item.name}}</option>
                  </select>
                  <div
                    v-if="submitted && errors.has('rol')"
                    class="invalid-feedback"
                  >{{ errors.first("rol") }}</div>
                </div>
              </div>
            </div>
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
import Multiselect from "vue-multiselect";
import { mapState } from "vuex";
import add from "../../mixins/add";
export default {
  $_veeValidate: {
    validator: "new"
  },
  name: "add",
  components: {
    ModalResource,
    Multiselect
  },
  data() {
    return {
      actions: "Useractions",
      url: "api/users",
      submitted: true,
      form: {
        id: null,
        name: "",
        surname: "",
        email: "",
        rol: []
      }
    };
  },
  mixins: [add],
  computed: {
    ...mapState(["roles"])
  },
  created() {
    this.getlist();
  },
  methods: {
    getlist() {
      this.$store.dispatch("Roleactions");
    },

    show(row) {
      this.form.id = row.id;
      this.form.name = row.name;
      this.form.surname = row.surname;
      this.form.email = row.email;
      this.form.rol = row.roles[0].name;
      $("#model").modal("show");
    },
    clear() {
      this.form.id = null;
      this.form.name = null;
      this.form.surname = null;
      this.form.email = null;
      this.form.rol = null;
      this.$validator.reset();
    }
  }
};
</script>