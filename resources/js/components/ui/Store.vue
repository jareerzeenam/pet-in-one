<template>
  <div>
    <div class="main-banner" style="background-image: url('/images/main-bg.jpg')">
      <div class="container">
        <div class="main-heading">
          <h1>Our Products</h1>
          <p>
            Lorem ipsum dolor sit amet, consectetur adipisicing
            elit. Quidem, nisi consectetur distinctio nesciunt animi
            qui tempore est voluptatibus quam impedit.
          </p>
          <a href="#" class="btn-common">Read More</a>
        </div>
      </div>
    </div>

    <div class>
      <div class="card card-solid">
        <div class="card-header">
          <h3 class="card-title">Products</h3>

          <div class="card-tools">
            <button class="btn btn-success" @click="newModal">
              Add New
              <i class="fas fa-user-plus fa-fw"></i>
            </button>
          </div>
        </div>

        <div class="card-body pb-0">
          <div class="row d-flex align-items-stretch">
            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
              <div class="card bg-light">
                <div class="card-header text-muted border-bottom-0">Digital Strategist</div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-7">
                      <h2 class="lead">
                        <b>Nicole Pearson</b>
                      </h2>
                      <p class="text-muted text-sm">
                        <b>About:</b> Web Designer / UX
                        / Graphic Artist / Coffee Lover
                      </p>
                      <ul class="ml-4 mb-0 fa-ul text-muted">
                        <li class="small">
                          <span class="fa-li">
                            <i class="fas fa-lg fa-building"></i>
                          </span>
                          Address: Demo Street 123,
                          Demo City 04312, NJ
                        </li>
                        <li class="small">
                          <span class="fa-li">
                            <i class="fas fa-lg fa-phone"></i>
                          </span>
                          Phone #: + 800 - 12 12 23 52
                        </li>
                      </ul>
                    </div>
                    <div class="col-5 text-center">
                      <img src="/images/logo.png" alt class="img-circle img-fluid" />
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="text-right">
                    <a href="#" class="btn btn-sm bg-teal">
                      <i class="fas fa-comments"></i>
                    </a>
                    <a href="#" class="btn btn-sm btn-primary">
                      <i class="fas fa-user"></i> View
                      Profile
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
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
            <h5 v-show="editmode" class="modal-title" id="addNewLabel">Update User</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <!-- <form @submit.prevent="editmode ? updateUser() : createPost()"> -->
          <form @submit.prevent="createPost()">
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
                <input
                  v-model="form.user_id"
                  type="text"
                  name="user_id"
                  placeholder="user_id"
                  class="form-control"
                  :class="{
                            'is-invalid': form.errors.has(
                                'user_id'
                            )
                        }"
                />
                <has-error :form="form" field="user_id"></has-error>
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
  </div>
</template>

<script>
export default {
  data() {
    return {
      editmode: false,
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
    // !Creae Posts
    createPost() {
      this.form.post("api/post");
    },
    // !Load add new modal
    newModal() {
      this.editmode = false;
      // !Reset the form on click @newModal (v-form function)
      this.form.reset();
      $("#addNew").modal("show");
    }
  },
  created() {
    console.log("Component mounted.");
  }
};
</script>
