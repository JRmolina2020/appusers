<template>
  <div>
    <div class="text-center">
      <img
        class="profile-user-img img-fluid img-circle"
        src="https://www.kindpng.com/picc/m/78-786207_user-avatar-png-user-avatar-icon-png-transparent.png"
        alt="User profile picture"
        height="60"
        width="60"
      />
      <h3 class="profile-username text-center">{{currentUser.name}}</h3>
      <p class="text-muted text-center">{{currentUser.email}}</p>
    </div>
    <form
      method="POST"
      @submit.prevent="updatepassword(currentUser.id)"
      autocomplete="off"
      enctype="multipart/form-data"
    >
      <div class="row">
        <div class="col-lg-12">
          <div class="form-group">
            <label for>password</label>
            <input
              type="password"
              v-validate="'required|max:30|min:3'"
              class="form-control form-control-sm"
              :class="{
                                'is-invalid': submitted && errors.has('password')
                            }"
              placeholder="nuevo password"
              v-model="form.password"
              name="password"
              ref="password"
            />
            <div
              v-if="submitted && errors.has('password')"
              class="invalid-feedback"
            >{{ errors.first("password") }}</div>
          </div>
        </div>
        <div class="col-lg-12">
          <div class="form-group">
            <label for>password confirmation</label>
            <input
              type="password"
              v-validate="'required|confirmed:password'"
              data-vv-as="password"
              class="form-control form-control-sm"
              :class="{
                                'is-invalid': submitted && errors.has('password_confirmation')
                            }"
              placeholder="confirmar password"
              name="password_confirmation"
            />
            <div
              v-if="submitted && errors.has('password_confirmation')"
              class="invalid-feedback"
            >{{ errors.first("password_confirmation") }}</div>
          </div>
        </div>
      </div>
      <button :hidden="errors.any()" type="submit" class="btn btn-outline-primary">
        <li class="fi fi-wink"></li>
      </button>
    </form>
  </div>
</template>
<script>
export default {
  $_veeValidate: {
    validator: "new"
  },
  name: "profile",
  data() {
    return {
      submitted: true,
      url: "api/users/password",
      form: {
        password: null
      }
    };
  },
  methods: {
    updatepassword(id) {
      this.$validator.validate().then(valid => {
        if (valid) {
          let url = `${this.url}/${id}`;
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
              this.form.password = null;
              this.$validator.reset();
            })
            .catch(error => {
              console.log(error.response);
            });
        }
      });
    }
  }
};
</script>