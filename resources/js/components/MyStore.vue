<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12 pt-3">
        <div class>
          <div class="card card-solid">
            <div class="card-header">
              <h3 class="card-title">My Stores</h3>

              <div class="card-tools">
                <button class="btn btn-success" @click="newModal">
                  Add New
                  <i class="fas fa-user-plus fa-fw"></i>
                </button>
              </div>
            </div>

            <div class="card-body pb-0">
              <div class="row d-flex align-items-stretch">
                <div
                  class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch"
                  v-for="post in posts.data"
                  :key="post.id"
                >
                  <div class="card bg-light">
                    <div class="card-header text-muted border-bottom-0">
                      <h2 class="lead">{{ post.title | upText}}</h2>
                      <h2 class="lead">Rs.{{ post.price }}</h2>
                      <p class="text-sm">{{ post.category |upText }}</p>
                    </div>
                    <div class="card-body pt-0">
                      <div class="row">
                        <div class="col-7">
                          <p class="text-muted text-sm">
                            <b>Description :</b>
                             {{ truncateText(post.description) }}
                          </p>
                          <ul class="ml-4 mb-0 fa-ul text-muted">
                            <li class="small">
                              <span class="fa-li">
                                <i class="fas fa-lg fa-building"></i>
                              </span>
                              Location : {{ post.location }}
                            </li>
                            <li class="small">
                              <span class="fa-li">
                                <i class="fas fa-lg fa-phone"></i>
                              </span>
                              Phone :
                              <a
                                :href="'tel:' + post.phone"
                              >{{ post.phone }}</a>
                            </li>
                            <li class="small">
                              Posted at :
                              {{ post.created_at | myDate}}
                            </li>
                          </ul>
                        </div>
                        <div class="col-5 text-center mt-3">
                          <img :src="`images/post/${post.photo}`" class="img-circle img-fluid" />
                        </div>
                      </div>
                    </div>
                    <div class="card-footer">
                      <div class="text-left">
                        <a href="#" @click="editModal(post)" class="">
                          <i class="fa fa-edit text-green"></i>
                        </a>
                        |
                        <a
                          href="#"
                          @click="deletePost(post.id)"
                          class=""
                        >
                          <i class="fa fa-trash text-red"></i>
                        </a>
                      </div>
                      <div class="text-right">
                        <!-- <a :href="'/my-store/' + post.id" class="btn btn-sm btn-primary">
                          <i class="fas fa-user"></i>
                          View Post
                        </a>-->

                         <el-button type="text" @click="viewBlog(post)" class="button">View Post</el-button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer">
              <pagination :data="posts" @pagination-change-page="getResults"></pagination>
            </div>
          </div>
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
                <h5 v-show="!editmode" class="modal-title" id="addNewLabel">Add New Post</h5>
                <h5 v-show="editmode" class="modal-title" id="addNewLabel">Update Post</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <!-- <form @submit.prevent="editmode ? updateUser() : createPost()"> -->
              <form @submit.prevent="editmode ? updatePost() : createPost()">
                <div class="modal-body">
                  <div class="form-group">
                    <input
                      v-model="form.title"
                      type="text"
                      name="title"
                      placeholder="Title"
                      class="form-control"
                      :class="{
                                        'is-invalid': form.errors.has('title')
                                    }"
                    />
                    <has-error :form="form" field="title"></has-error>
                  </div>
                  <div class="form-group">
                    <input
                      v-model="form.price"
                      type="text"
                      name="price"
                      placeholder="Price"
                      class="form-control"
                      :class="{
                                        'is-invalid': form.errors.has('price')
                                    }"
                    />
                    <has-error :form="form" field="price"></has-error>
                  </div>
                  <div class="form-group">
                    <input
                      v-model="form.location"
                      type="text"
                      name="location"
                      placeholder="Location"
                      class="form-control"
                      :class="{
                                        'is-invalid': form.errors.has(
                                            'location'
                                        )
                                    }"
                    />
                    <has-error :form="form" field="location"></has-error>
                  </div>

                  <div class="form-group">
                    <textarea
                      v-model="form.description"
                      name="description"
                      placeholder="Tell somethin about your product"
                      class="form-control"
                      :class="{
                            'is-invalid': form.errors.has(
                                'description'
                            )
                        }"
                    ></textarea>

                    <has-error :form="form" field="description"></has-error>
                  </div>
                  <div class="form-group">
                    <input
                      v-model="form.phone"
                      type="text"
                      name="phone"
                      placeholder="Phone"
                      class="form-control"
                      :class="{
                                        'is-invalid': form.errors.has(
                                            'phone'
                                        )
                                    }"
                    />
                    <has-error :form="form" field="phone"></has-error>
                  </div>
                  <div class="form-group">
                    <select
                      name="category"
                      id="category"
                      v-model="form.category"
                      class="form-control"
                      :class="{
                                        'is-invalid': form.errors.has(
                                            'category'
                                        )
                                    }"
                    >
                      <option value>Select Category</option>
                      <option value="animal">Animal</option>
                      <option value="bird">Bird</option>
                      <option value="fish">Fish</option>
                    </select>
                    <has-error :form="form" field="category"></has-error>
                  </div>

                  <label for>Meetable Date</label>
                  <div class="form-group">
                    <input
                      v-model="form.meeting_date_start"
                      type="date"
                      name="meeting_date_start"
                      placeholder="meeting_date_start"
                      class="form-control"
                      :class="{
                                        'is-invalid': form.errors.has(
                                            'meeting_date_start'
                                        )
                                    }"
                    />
                    <has-error :form="form" field="meeting_date_start"></has-error>
                  </div>
                  <label for>To</label>
                  <div class="form-group">
                    <input
                      v-model="form.meeting_date_end"
                      type="date"
                      name="meeting_date_end"
                      placeholder="meeting_date_end"
                      class="form-control"
                      :class="{
                                        'is-invalid': form.errors.has(
                                            'meeting_date_end'
                                        )
                                    }"
                    />
                    <has-error :form="form" field="meeting_date_end"></has-error>
                  </div>

                  <div class="form-group">
                    <input
                      v-model="form.meeting_time"
                      type="text"
                      name="meeting_time"
                      placeholder="Meetable Time"
                      class="form-control"
                      :class="{
                            'is-invalid': form.errors.has(
                                'meeting_time'
                            )
                        }"
                    />
                    <has-error :form="form" field="meeting_time"></has-error>
                  </div>

                  <div class="form-group">
                    <label for="inputSkills">Pictures</label>
                    <div class="col-sm-12">
                      <input
                        type="file"
                        @change="addPhoto"
                        name="photo"
                        class="form-input"
                      />
                    </div>
                    <has-error :form="form" field="photo"></has-error>
                  </div>
                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                  <!-- show if the editmode is true -->
                  <button v-show="editmode" type="submit" class="btn btn-success">Update</button>
                  <!-- show if the editmode is falase -->
                  <button v-show="!editmode" type="submit" class="btn btn-primary">Create</button>
                </div>
              </form>
            </div>
          </div>
        </div>
          <!-- SHOW MOEL -->
        <div
          class="modal fade"
          id="addShow"
          tabindex="-1"
          role="dialog"
          aria-labelledby="addNewLabel"
          aria-hidden="true"
        >
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="addNewLabel">Post</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

              <div class="modal-body">
                  <div class="card ">
                    <div class="card-header">
                        <img :src="'/images/post/' + form.photo" class="image" />
                    </div>
                    <div class="card-body">
                        <h5 class="">{{ form.title | upText}}</h5>
                        <h5 class="text-muted">Rs.{{ form.price}}</h5>

                        <p class="text-muted">   <a :href="'tel:'+form.phone"><i class="fas fa-lg fa-phone"></i> {{ form.phone}}</a></p>
                        <p class="text-muted"> {{ form.category |upText }}</p>
                        <p class="card-text paragraph">{{ form.description | upText}}</p>
                    </div>
                    <div class="card-footer text-muted">
                        {{ form.created_at | myDate}}
                    </div>
                    </div>

              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Ok</button>
              </div>
            </div>
          </div>
        </div>

        <!-- SHOW MOEL -->
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      editmode: false,
      // * Posts object
      posts: {},


      form: new Form({
        id: "",
        title: "",
        price: "",
        location: "",
        category: "",
        description: "",
        phone: "",
        rating: "",
        photo: "",
        meeting_date_start: "",
        meeting_date_end: "",
        meeting_time: "",
        user_id: ""
      })
    };
  },

  methods: {
          viewBlog(post) {
      $("#addShow").modal("show");
      this.form.fill(post);
    },
          truncateText(text) {
      if (text.length > 15) {
        return `${text.substr(0, 15)}...`;
      }
      return text;
    },
    // ! Pagination get Results
    // Our method to GET results from a Laravel endpoint
    getResults(page = 1) {
      axios.get("api/post?page=" + page).then(response => {
        this.posts = response.data;
      });
    },
    //   ! Load Posts 1
    loadPost() {
      axios.get("api/post").then(({ data }) => (this.posts = data));
    },

    // !Creae Posts 2
    createPost() {
      this.$Progress.start();
      this.form
        .post("api/post")
        .then(() => {
          // ! hide model after creating
          $("#addNew").modal("hide");
          Fire.$emit("AfterCreated");
          toast.fire({
            icon: "success",
            title: "Product Created successfully"
          });
          this.$Progress.finish();
        })
        .catch(() => {
          this.$Progress.fail();
        });
    },
    deletePost(id) {
      swal
        .fire({
          title: "Are you sure?",
          text: "You won't be able to revert this!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Yes, delete it!"
        })
        .then(result => {
          //! Send request to the server
          if (result.value) {
            this.form
              .delete("api/post/" + id)

              .then(() => {
                this.$Progress.start();
                toast.fire({
                  icon: "success",
                  title: "Post Deleted Successfully"
                });
                Fire.$emit("AfterCreated");
                this.$Progress.finish();
              })
              .catch(() => {
                swal.fire({
                  icon: "error",
                  title: "Oops...",
                  text: "Something went wrong!"
                });
                this.$Progress.fail();
              });
          }
        });
    },

    updatePost() {
      // !start progress bar
      this.$Progress.start();
      //   console.log("editing data");
      this.form
        .put("api/post/" + this.form.id)
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
    editModal(post) {
      this.editmode = true;

      this.form.reset();
      $("#addNew").modal("show");

      this.form.fill(post);
    },

    // !Load add new modal
    newModal() {
      this.editmode = false;
      // !Reset the form on click @newModal (v-form function)
      this.form.reset();
      $("#addNew").modal("show");
    },

    addPhoto(e) {
      //   console.log('Uploading Image');
      let file = e.target.files[0];
      // console.log(file);
      let reader = new FileReader();
      // !check uploading file size
      if (file["size"] < 2111775) {
        reader.onloadend = file => {
          // console.log("RESULT", reader.result);
          this.form.photo = reader.result;
          // Fire.$emit("AfterCreated");
        };
        reader.readAsDataURL(file);
        // !fire ater created( load new data to the ui from the database without rereshing)
      } else {
        swal.fire({
          icon: "error",
          title: "Oops...",
          text: "You are uploading a large file!"
        });
      }
    }
  },

  created() {
    //   ! Load Posts 1
    this.loadPost();

    Fire.$on("AfterCreated", () => {
      this.loadPost();
    });
  }
};
</script>
