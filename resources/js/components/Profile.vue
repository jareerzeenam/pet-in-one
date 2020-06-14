<style>
.widget-user-header {
  background-position: center center;
  background-size: cover;
  height: 250px !important;
}
</style>

<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12 mt-3">
        <div class="card card-widget widget-user">
          <!-- Add the bg color to the header using any of the bg-* classes -->
          <div
            class="widget-user-header text-white"
            style="background: url('./images/user-cover.png') center center;"
          >
            <h3 class="widget-user-username text-right">{{form.name | upText}}</h3>
            <h5 class="widget-user-desc text-right">{{ form.type | upText }}</h5>
          </div>
          <div class="widget-user-image">
            <img class="img-circle" :src="getProfilePhoto()" alt="User Avatar" />
          </div>
          <div class="card-footer">
            <div class="row">
              <div class="col-sm-4 border-right">
                <div class="description-block">
                  <h5 class="description-header">3,200</h5>
                  <span class="description-text">SALES</span>
                </div>
                <!-- /.description-block -->
              </div>
              <!-- /.col -->
              <div class="col-sm-4 border-right">
                <div class="description-block">
                  <h5 class="description-header">13,000</h5>
                  <span class="description-text">FOLLOWERS</span>
                </div>
                <!-- /.description-block -->
              </div>
              <!-- /.col -->
              <div class="col-sm-4">
                <div class="description-block">
                  <h5 class="description-header">35</h5>
                  <span class="description-text">PRODUCTS</span>
                </div>
                <!-- /.description-block -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
        </div>

        <div class="card">
          <div class="card-header p-2">
            <ul class="nav nav-pills">
              <li class="nav-item">
                <a class="nav-link" href="#activity" data-toggle="tab">Activity</a>
              </li>

              <li class="nav-item">
                <a class="nav-link active" href="#settings" data-toggle="tab">Settings</a>
              </li>
            </ul>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="tab-content">
              <div class="tab-pane" id="activity">
                <h1>Display User Activity</h1>
              </div>
              <!-- /.tab-pane -->

              <!-- /.tab-pane -->

              <div class="tab-pane active" id="settings">
                <form class="form-horizontal">
                  <div class="form-group row">
                    <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-12">
                      <input
                        v-model="form.name"
                        type="name"
                        class="form-control"
                        id="inputName"
                        placeholder="Name"
                        :class="{
                        'is-invalid': form.errors.has(
                            'name'
                        )
                    }"
                      />
                      <has-error :form="form" field="name"></has-error>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-12">
                      <input
                        v-model="form.email"
                        type="email"
                        class="form-control"
                        id="inputEmail"
                        placeholder="Email"
                        :class="{
                        'is-invalid': form.errors.has(
                            'email'
                        )
                    }"
                      />
                      <has-error :form="form" field="email"></has-error>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputBio" class="col-sm-2 col-form-label">Bio</label>
                    <div class="col-sm-12">
                      <textarea
                        v-model="form.bio"
                        class="form-control"
                        id="inputBio"
                        placeholder="Bio"
                      ></textarea>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputSkills" class="col-sm-2 col-form-label">Profile Picture</label>
                    <div class="col-sm-12">
                      <input type="file" @change="updateProfile" name="photo" class="form-input" />
                    </div>
                  </div>
                  <div class="form-group row">
                    <label
                      for="inputPassword"
                      class="col-sm-12 col-form-label"
                    >Password (Leave empty if not changing)</label>
                    <div class="col-sm-12">
                      <input
                        v-model="form.password"
                        type="password"
                        class="form-control"
                        id="inputPassword"
                        placeholder="Password"
                        :class="{
                        'is-invalid': form.errors.has(
                            'password'
                        )
                    }"
                      />
                      <has-error :form="form" field="password"></has-error>
                    </div>
                  </div>

                  <div class="form-group row">
                    <div class="col-sm-12">
                      <button
                        @click.prevent="updateInfo"
                        type="submit"
                        class="btn btn-danger"
                      >Update</button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.card-body -->
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
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
  mounted() {
    console.log("Component mounted.");
  },

  methods: {
    loadUser() {
      axios.get("api/profile").then(({ data }) => this.form.fill(data));
    },
    //   ! this function will add the profile photo name with the directry path from the database
    getProfilePhoto() {
      // !ternary operator javascript
      let photo =
        this.form.photo.length > 200
          ? this.form.photo
          : "images/profile/" + this.form.photo;


      return photo;

      // return "images/profile/" + this.form.photo;
    },
    updateInfo() {
      this.$Progress.start();
      this.form
        .put("api/profile")
        .then(() => {
             toast.fire({
            icon: "success",
            title: "Profile Updated Successfully"
          });
          this.$Progress.finish();
        })
        .catch(() => {
          this.$Progress.fail();
        });
    },
    updateProfile(e) {
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
    // axios.get("api/profile").then(({ data }) => this.form.fill(data));
    this.loadUser();
    // !Custome even to load data when an action happened in the form
    Fire.$on("AfterCreated", () => {
      this.loadUser();
    });
  }
};
</script>
