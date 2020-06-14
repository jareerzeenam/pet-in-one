<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12 pt-3">
        <div class>
          <div class="card card-solid">
            <div class="card-header">
              <h3 class="card-title">Blogs</h3>
              <div class="card-tools">
                <button class="btn btn-success" @click="newModal">
                  Write An Article
                  <i class="fas fa-user-plus fa-fw"></i>
                </button>
              </div>
            </div>

            <div class="card-body pb-0">
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch" v-for="blog in blogs.data" :key="blog.id">
                       <div class="card"   style="width: 18rem;">
                            <img :src="`images/blog/${blog.photo}`" class=" img-fluid image" />
                            <div class="card-body">
                                 <h5 class="card-title">{{ blog.title | upText}}</h5>
                                 <p class="card-text text-muted">{{ blog.category |upText }}</p>
                                <p class="card-text">{{ truncateText(blog.description) }}</p>
                            </div>
                            <div class="card-footer text-muted">
                                <a href="#" @click="editModal(blog)">
                            <i class="fa fa-edit text-green"></i>
                          </a>
                          |
                          <a href="#" @click="deleteArticle(blog.id)">
                            <i class="fa fa-trash text-red"></i>
                          </a>
                           <el-button type="text" @click="viewBlog(blog)" class="button">Read More</el-button>
                            </div>
                        </div>
                    </div>
                </div>

              <br />
              <br />
            </div>
            <div class="card-footer">
              <pagination :data="blogs" @pagination-change-page="getResults"></pagination>
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
                <h5 v-show="!editmode" class="modal-title" id="addNewLabel">Add New Article</h5>
                <h5 v-show="editmode" class="modal-title" id="addNewLabel">Update Article</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <!-- <form @submit.prevent="editmode ? updateUser() : createArticle()"> -->
              <form @submit.prevent="editmode ? updateArticle() : createArticle()">
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

                  <div class="form-group">
                    <label for="inputSkills">Pictures</label>
                    <div class="col-sm-12">
                      <input type="file" @change="addPhoto" name="photo" class="form-input" />
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
                <h5 class="modal-title" id="addNewLabel">Blog</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

              <div class="modal-body">
                  <div class="card ">
                    <div class="card-header">
                        <img :src="'/images/blog/' + form.photo" class="image" />
                    </div>
                    <div class="card-body">
                        <h5 class="">{{ form.title | upText}}</h5>
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

<style>
.time {
  font-size: 13px;
  color: #999;
}

.bottom {
  margin-top: 13px;
  line-height: 12px;
}

.button {
  padding: 0;
  float: right;
}

.image {
  width: 100%;
  display: block;
}

.clearfix:before,
.clearfix:after {
  display: table;
  content: "";
}

.clearfix:after {
  clear: both;
}
</style>


<script>
import { mapState } from "vuex";
export default {
  data() {
    return {
      postDialogVisible: false,
      currentPost: "",
      editmode: false,
      // * Posts object
      blogs: {},

      form: new Form({
        id: "",
        title: "",
        category: "",
        description: "",
        photo: "",
        user_id: "",
        created_at:""
      })
    };
  },

  methods: {

    truncateText(text) {
      if (text.length > 25) {
        return `${text.substr(0, 100)} ...`;
      }
      return text;
    },
    // ! Pagination get Results
    // Our method to GET results from a Laravel endpoint
    getResults(page = 1) {
      axios.get("api/blog?page=" + page).then(response => {
        this.blogs = response.data;
      });
    },
    //   ! Load Posts 1
    loadArticle() {
      axios.get("api/blog").then(({ data }) => (this.blogs = data));
    },

    // !Creae Posts 2
    createArticle() {
      this.$Progress.start();
      this.form
        .post("api/blog")
        .then(() => {
          // ! hide model after creating
          $("#addNew").modal("hide");
          Fire.$emit("AfterCreated");
          toast.fire({
            icon: "success",
            title: "Article Created successfully"
          });
          this.$Progress.finish();
        })
        .catch(() => {
          this.$Progress.fail();
        });
    },
    deleteArticle(id) {
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
              .delete("api/blog/" + id)

              .then(() => {
                this.$Progress.start();
                toast.fire({
                  icon: "success",
                  title: "Article Deleted Successfully"
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

    updateArticle() {
      // !start progress bar
      this.$Progress.start();
      //   console.log("editing data");
      this.form
        .put("api/blog/" + this.form.id)
        .then(() => {
          // Successfull
          $("#addNew").modal("hide");
          Fire.$emit("AfterCreated");
          toast.fire({
            icon: "success",
            title: "Article Updated successfully"
          });
          this.$Progress.finish();
        })
        .catch(() => {
          this.$Progress.fail();
        });
    },

    // ! Load edit modal
    editModal(blog) {
      this.editmode = true;

      this.form.reset();
      $("#addNew").modal("show");

      this.form.fill(blog);
    },

    viewBlog(blog) {
      $("#addShow").modal("show");
      this.form.fill(blog);
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
    this.loadArticle();

    Fire.$on("AfterCreated", () => {
      this.loadArticle();
    });
  }
};
</script>
