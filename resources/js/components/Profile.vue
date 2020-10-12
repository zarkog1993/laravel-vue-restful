<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 mt-3">
                <div class="card card-widget widget-user">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div
                        class="widget-user-header text-white"
                        style="background-image: url('./img/user-background.jpg')">
                        <h3 class="widget-user-username text-right">
                            {{ form.name }}
                        </h3>
                        <h5 class="widget-user-desc text-right">
                            {{ form.email }}
                        </h5>
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
                                    <span class="description-text"
                                        >FOLLOWERS</span
                                    >
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4">
                                <div class="description-block">
                                    <h5 class="description-header">35</h5>
                                    <span class="description-text"
                                        >PRODUCTS</span
                                    >
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                </div>

                <div class="container-fluid">
                    <div class="row">
                        <!-- /.col -->
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header p-2">
                                    <ul class="nav nav-pills">
                                        <li class="nav-item">
                                            <a
                                                class="nav-link"
                                                href="#activity"
                                                data-toggle="tab"
                                                >Activity</a
                                            >
                                        </li>
                                        <li class="nav-item">
                                            <a
                                                class="nav-link active"
                                                href="#settings"
                                                data-toggle="tab"
                                                >Settings</a
                                            >
                                        </li>
                                    </ul>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div class="tab-pane" id="activity">
                                            <h1 class="center">
                                                User Activities
                                            </h1>
                                        </div>

                                        <div
                                            class="tab-pane active"
                                            id="settings"
                                        >
                                            <form class="form-horizontal">
                                                <div class="form-group row">
                                                    <label
                                                        for="name"
                                                        class="col-sm-2 col-form-label"
                                                        >Name</label
                                                    >
                                                    <div class="col-sm-10">
                                                        <input
                                                            type="email"
                                                            class="form-control"
                                                            id="name"
                                                            placeholder="Name"
                                                            v-model="form.name"
                                                            :class="{ 'is-invalid': form.errors.has('name') }"
                                                        />
                                                        <has-error :form="form" field="name"></has-error>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label
                                                        for="email"
                                                        class="col-sm-2 col-form-label"
                                                        >Email</label
                                                    >
                                                    <div class="col-sm-10">
                                                        <input
                                                            type="email"
                                                            class="form-control"
                                                            id="email"
                                                            placeholder="Email"
                                                            v-model="form.email"
                                                            :class="{ 'is-invalid': form.errors.has('email') }"
                                                        />
                                                        <has-error :form="form" field="email"></has-error>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label
                                                        for="bio"
                                                        class="col-sm-2 col-form-label"
                                                        >Bio</label
                                                    >
                                                    <div class="col-sm-10">
                                                        <textarea
                                                            class="form-control"
                                                            id="bio"
                                                            placeholder="Biography..."
                                                            v-model="form.bio"
                                                        ></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label
                                                        for="bio"
                                                        class="col-sm-2 col-form-label"
                                                        >Image
                                                    </label>
                                                    <div class="col-sm-10">
                                                        <input type="file" @change="updateProfile" class="form-control-file" id="customFile">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="password" class="col-sm-2 col-form-label">Password</label>
                                                    <div class="col-sm-10">
                                                        <input class="form-control" type="password"
                                                               name="password" id="password" placeholder="Password"
                                                               :class="{ 'is-invalid': form.errors.has('password') }"
                                                               v-model="form.password">
                                                        <has-error :form="form" field="password"></has-error>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div
                                                        class="offset-sm-2 col-sm-10"
                                                    >
                                                        <div class="checkbox">
                                                            <label>
                                                                <input
                                                                    type="checkbox"
                                                                />
                                                                I agree to the
                                                                <a href="#"
                                                                    >terms and
                                                                    conditions</a
                                                                >
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div
                                                        class="offset-sm-2 col-sm-10">
                                                        <button
                                                            type="submit"
                                                            class="btn btn-success"
                                                            @click.prevent="updateInfo">
                                                            <i class="fas fa-sync-alt"></i>
                                                            Update
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style>
.widget-user-header {
    background-position: center center;
    background-size: cover;
    height: 250px !important;
}
</style>

<script>
import Form from "vform";
export default {
    data() {
        return {
            form: new Form({
                id: '',
                name: '',
                email: '',
                password: '',
                user_type: '',
                bio: '',
                type: '',
                photo: ''
            })
        }
    },
    mounted() {
        console.log("Component mounted.");
    },
    methods: {
        updateInfo() {
            this.$Progress.start();
            this.form.put('api/profile')
                .then(() => {
                    this.$Progress.finish();
                })
                .catch(() => {
                    this.$Progress.fail();
                })
        },
        // Method for upload file on server
        // We connect it with input file with @change
        updateProfile(e) {
            let file = e.target.files[0];
            let reader = new FileReader();
            if(file['size'] < 2111775) {
                reader.onloadend = (file) => {
                    this.form.photo = reader.result;
                }
                reader.readAsDataURL(file);
            } else {
                swal.fire({
                    title: 'Ooops...',
                    text: 'File too big, you need to upload file less than 2MB \n Please try anoteh one.',
                    icon: 'error'
                })
            }
        },
        getProfilePhoto() {
            return "img/profile/" + this.form.photo
        }
    },
    created() {
        axios.get("api/profile")
             .then(({ data }) => (this.form.fill(data)))
    }
};
</script>
