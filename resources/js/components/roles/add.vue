<template>
  <div>
    <Modal-Resource v-on:clear="clear" title="Registro de roles">
      <section v-if="!form.id" slot="title">Registro de roles</section>
      <section v-else slot="title">Editar roles</section>
      <section slot="closebtn">
        <button
          type="button"
          @click="clearrolesitem"
          class="close"
          data-dismiss="modal"
          aria-label="Close"
        >
          <span aria-hidden="true">&times;</span>
        </button>
      </section>
      <section slot="titlebutton">Registrar roles</section>
      <section slot="body">
        <form method="POST" @submit.prevent="add(form.id,action)" autocomplete="off">
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
          <div v-if="form.id" class="row">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Permiso</th>
                  <th>
                    <i class="fi fi-wink"></i>
                  </th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(item, index) in permissions" :key="index">
                  <td>{{item.name}}</td>
                  <td>
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" v-model="form.permissions" :value="item.name" />
                      </label>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
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
import add from "../../mixins/add";
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
      action: "Roleactions",
      url: "api/roles",
      submitted: true,
      rolesitem: [],
      form: {
        id: null,
        name: null,
        permissions: []
      }
    };
  },
  mixins: [add],
  computed: {
    ...mapState(["permissions"])
  },
  created() {
    this.getlist();
  },
  methods: {
    getlist() {
      this.$store.dispatch("Permissionsactions");
    },
    show(row) {
      this.status = true;
      this.form.id = row.id;
      this.form.name = row.name;
      row.permissions.forEach(element => {
        this.rolesitem.push(element.name);
      });
      this.form.permissions = this.rolesitem;
      $("#model").modal("show");
    },
    clearrolesitem() {
      this.rolesitem = [];
      $("#model").modal("hide");
    },
    clear() {
      this.form.id = null;
      this.form.name = null;
      this.$validator.reset();
      this.rolesitem = [];
      this.form.permissions = [];
    }
  }
};
</script>