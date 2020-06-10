<template>
    <div class="container">
        <div class="row pt-3" v-if="$gate.isAdminOrAuthor()">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Users Table</h3>

                        <div class="card-tools">
                            <button class="btn btn-success" @click="newModal">
                                Add New
                                <i class="fas fa-user-plus fa-fw"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Type</th>
                                    <th>Bio</th>
                                    <th>Registered At</th>
                                    <div v-if="$gate.isAdmin()">
                                        <th>Modify</th>
                                    </div>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="user in users.data" :key="user.id">
                                    <td>{{ user.id }}</td>
                                    <td>{{ user.name }}</td>
                                    <td>{{ user.email }}</td>
                                    <td>{{ user.type | upText }}</td>
                                    <td>{{ user.bio }}</td>
                                    <td>{{ user.created_at | myDate }}</td>
                                    <div v-if="$gate.isAdmin()">
                                        <td>
                                            <a
                                                href="#"
                                                @click="editModal(user)"
                                            >
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            |
                                            <a
                                                href="#"
                                                @click="deleteUser(user.id)"
                                            >
                                                <i
                                                    class="fa fa-trash text-red"
                                                ></i>
                                            </a>
                                        </td>
                                    </div>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <pagination
                            :data="users"
                            @pagination-change-page="getResults"
                        ></pagination>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>

        <div v-if="!$gate.isAdminOrAuthor()">
            <not-found></not-found>
        </div>

        <!-- Modal -->
        <div
            class="modal fade"
            id="addNew"
            tabindex="-1"
            role="dialog"
            aria-labelledby="addNewLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5
                            v-show="!editmode"
                            class="modal-title"
                            id="addNewLabel"
                        >
                            Add New User
                        </h5>
                        <h5
                            v-show="editmode"
                            class="modal-title"
                            id="addNewLabel"
                        >
                            Update User
                        </h5>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form
                        @submit.prevent="editmode ? updateUser() : createUser()"
                    >
                        <div class="modal-body">
                            <div class="form-group">
                                <input
                                    v-model="form.name"
                                    type="text"
                                    name="name"
                                    placeholder="Name"
                                    class="form-control"
                                    :class="{
                                        'is-invalid': form.errors.has('name')
                                    }"
                                />
                                <has-error
                                    :form="form"
                                    field="name"
                                ></has-error>
                            </div>
                            <div class="form-group">
                                <input
                                    v-model="form.email"
                                    type="email"
                                    name="email"
                                    placeholder="Email"
                                    class="form-control"
                                    :class="{
                                        'is-invalid': form.errors.has('email')
                                    }"
                                />
                                <has-error
                                    :form="form"
                                    field="email"
                                ></has-error>
                            </div>
                            <div class="form-group">
                                <textarea
                                    v-model="form.bio"
                                    name="bio"
                                    placeholder="Tell somethin about you (Optional)"
                                    class="form-control"
                                    :class="{
                                        'is-invalid': form.errors.has('bio')
                                    }"
                                ></textarea>

                                <has-error :form="form" field="bio"></has-error>
                            </div>
                            <div class="form-group">
                                <select
                                    name="type"
                                    id="type"
                                    v-model="form.type"
                                    class="form-control"
                                    :class="{
                                        'is-invalid': form.errors.has('type')
                                    }"
                                >
                                    <option value>Select User Role</option>
                                    <option value="admin">Admin</option>
                                    <option value="user">Standard User</option>
                                    <option value="author">Author</option>
                                </select>
                                <has-error
                                    :form="form"
                                    field="type"
                                ></has-error>
                            </div>

                            <div class="form-group">
                                <input
                                    v-model="form.password"
                                    type="password"
                                    name="password"
                                    placeholder="Password"
                                    class="form-control"
                                    :class="{
                                        'is-invalid': form.errors.has(
                                            'password'
                                        )
                                    }"
                                />
                                <has-error
                                    :form="form"
                                    field="password"
                                ></has-error>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button
                                type="button"
                                class="btn btn-danger"
                                data-dismiss="modal"
                            >
                                Close
                            </button>
                            <!-- show if the editmode is true -->
                            <button
                                v-show="editmode"
                                type="submit"
                                class="btn btn-success"
                            >
                                Update
                            </button>
                            <!-- show if the editmode is falase -->
                            <button
                                v-show="!editmode"
                                type="submit"
                                class="btn btn-primary"
                            >
                                Create
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
    data() {
        return {
            editmode: false,
            users: {},
            form: new Form({
                id: "",
                name: "",
                email: "",
                bio: "",
                password: "",
                type: "",
                rating: "",
                photo: ""
            })
        };
    },
    methods: {
        // ! Pagination get Results
        // Our method to GET results from a Laravel endpoint
        getResults(page = 1) {
            axios.get("api/user?page=" + page).then(response => {
                this.users = response.data;
            });
        },
        updateUser() {
            // !start progress bar
            this.$Progress.start();
            //   console.log("editing data");
            this.form
                .put("api/user/" + this.form.id)
                .then(() => {
                    // Successfull
                    $("#addNew").modal("hide");
                    Fire.$emit("AfterCreated");
                    toast.fire({
                        icon: "success",
                        title: "User Updated successfully"
                    });
                    this.$Progress.finish();
                })
                .catch(() => {
                    this.$Progress.fail();
                });
        },
        // ! Load edit modal
        editModal(user) {
            this.editmode = true;

            this.form.reset();
            $("#addNew").modal("show");

            this.form.fill(user);
        },

        // !Load add new modal
        newModal() {
            this.editmode = false;
            // !Reset the form on click @newModal (v-form function)
            this.form.reset();
            $("#addNew").modal("show");
        },
        deleteUser(id) {
            swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then(result => {
                //! Send request to the server
                if (result.value) {
                    this.form
                        .delete("api/user/" + id)
                        .then(() => {
                            toast.fire({
                                icon: "success",
                                title: "User Deleted Successfully"
                            });
                            Fire.$emit("AfterCreated");
                        })
                        .catch(() => {
                            swal.fire({
                                icon: "error",
                                title: "Oops...",
                                text: "Something went wrong!"
                            });
                        });
                }
            });
        },
        loadUsers() {
            if (this.$gate.isAdminOrAuthor()) {
                axios
                    .get("api/user")
                    .then(({ data }) => (this.users = data));
            }
        },
        createUser() {
            // !start progress bar
            this.$Progress.start();
            //! route
            this.form
                .post("api/user")
                .then(() => {
                    // !fire ater created( load new data to the ui from the database without rereshing)
                    Fire.$emit("AfterCreated");
                    // ! hide model after creating
                    $("#addNew").modal("hide");
                    // !fire sweet alart after created
                    toast.fire({
                        icon: "success",
                        title: "User Created successfully"
                    });
                    // ! end progressbar
                    this.$Progress.finish();
                })
                .catch(() => {});
        }
    },

    created() {
        // console.log("Component mounted.");
        this.loadUsers();

        // !Custome even to load data when an action happened in the form
        Fire.$on("AfterCreated", () => {
            this.loadUsers();
        });
        // setInterval(()=>this.loadUsers(),3000);
    }
};
</script>
