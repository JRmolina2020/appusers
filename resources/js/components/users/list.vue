
<template>
  <div>
    <div v-if="!status">
      <Loader></Loader>
    </div>
    <div v-else>
      <Search-Item titleinput="Buscar Usuarios"></Search-Item>
      <div class="table-responsive mt-3">
        <v-table
          :data="users"
          :currentPage.sync="currentPage"
          :filters="filters"
          :pageSize="4"
          @totalPagesChanged="totalPages = $event"
          class="table table-striped"
        >
          <thead slot="head">
            <tr>
              <th>Nombre</th>
              <th>Apellido</th>
              <th>Rol</th>
              <th>Correo</th>
              <th>Estado</th>
              <th>Password</th>
              <th>Opciones</th>
            </tr>
          </thead>
          <tbody slot="body" slot-scope="{ displayData }">
            <tr v-for="(row, index) in displayData" :key="index">
              <td>{{ row.name }}</td>
              <td>{{ row.surname }}</td>
              <td>
                <span class="pull-right badge bg-blue">
                  {{
                  row.roles[0].name
                  }}
                </span>
              </td>
              <td>
                <Test-View v-bind:row="row" title="email"></Test-View>
              </td>
              <td v-if="can('Administrador de seguridad')">
                <button
                  type="button"
                  @click="thestatus(row)"
                  v-bind:class="{
                                        'btn btn-sm': true,
                                        'btn-success': row.status,
                                        'btn-danger': row.status == 0
                                    }"
                >
                  <i
                    :class="
                                            row.status
                                                ? 'fi fi-toggle-on'
                                                : 'fi fi-toggle-off'
                                        "
                    aria-hidden="true"
                  ></i>
                </button>
              </td>
              <td v-else>
                <i class="fi fi-frowning"></i>
              </td>
              <td v-if="can('Administrador de seguridad')">
                <Modal-Password v-bind:row="row"></Modal-Password>
              </td>
              <td v-else>
                <i class="fi fi-frowning"></i>
              </td>
              <td v-if="can('Administrador de seguridad')">
                <button type="button" @click="$emit('show', row)" class="btn bg-warning btn-sm">
                  <i class="fi fi-eye"></i>
                </button>
                <button type="button" @click="remove(row)" class="btn btn-danger btn-sm">
                  <i class="fi fi-trash"></i>
                </button>
              </td>
              <td v-else>
                <i class="fi fi-frowning"></i>
              </td>
            </tr>
          </tbody>
        </v-table>
      </div>
      <div class="box-footer clearfix">
        <smart-pagination
          :currentPage.sync="currentPage"
          :maxPageLinks="6"
          :totalPages="totalPages"
        />
      </div>
    </div>
  </div>
</template>
<script>
import SearchItem from "../utilities/search";
import TestView from "../utilities/testview";
import Loader from "../utilities/loader";
import ModalPassword from "./modalpassword";
import { mapState } from "vuex";
export default {
  components: {
    SearchItem,
    TestView,
    Loader,
    ModalPassword
  },
  data() {
    return {
      currentPage: 1,
      totalPages: 0
    };
  },
  computed: {
    ...mapState(["filters", "users", "status", "urlusers"])
  },
  created() {
    this.getlist();
  },
  methods: {
    getlist() {
      this.$store.dispatch("Useractions");
    },
    async remove(row) {
      let url = this.urlusers + row.id;
      let response = await axios.delete(url);
      try {
        this.getlist();
        Swal.fire({
          title: `El usuario ${row.name} ${response.data.message}`,
          icon: "success"
        });
      } catch (error) {
        console.log(error);
      }
    },
    async thestatus(row) {
      if (row.status == 1) {
        let url = this.urlusers + "locked/" + row.id;
        let response = await axios.put(url);
        try {
          Swal.fire({
            title: `El usuario ${row.name} ${response.data.message}`,
            icon: "success"
          });
          this.getlist();
        } catch (error) {
          console.log(error);
        }
      } else {
        let url = this.urlusers + "available/" + row.id;
        let response = await axios.put(url);
        try {
          Swal.fire({
            title: `El usuario ${row.name} ${response.data.message}`,
            icon: "success"
          });
          this.getlist();
        } catch (error) {
          console.log(error);
        }
      }
    }
  }
};
</script>