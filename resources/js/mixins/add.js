module.exports = {
    methods: {
        add(id, actions) {
            this.$validator.validate().then(valid => {
                if (valid) {
                    if (id) {
                        let url = `${this.url}/${id}`;
                        axios
                            .put(url, this.form)
                            .then(response => {
                                this.$store.dispatch(actions);
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
                                this.$store.dispatch(actions);
                                this.clear();
                            })
                            .catch(error => {
                                console.log(error.response);
                            });
                    }
                }
            });
        }
    }
};
