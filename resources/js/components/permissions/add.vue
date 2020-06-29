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
import add from "../../mixins/add";
export default {
  $_veeValidate: {
    validator: "new"
  },
  name: "add",
  mixins: [add],
  components: {
    ModalResource
  },
  data() {
    return {
      action: "Permissionsactions",
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