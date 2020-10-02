<template>
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Users Managment</h3>

                <div class="card-tools">
                    <button class="btn btn-success" data-toggle="modal" data-target="#addNew">Add New User <i class="fas fa-user-plus"></i></button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Type</th>
                      <th>Biography</th>
                      <th>Registerd At</th>
                      <th>Modify</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="user in users" :key="user.id">
                    <td>{{ user.id }}</td>
                    <td>{{ user.name }}</td>
                    <td>{{ user.email }}</td>
                    <td>{{ user.type | upText }}</td>
                    <td>{{ user.created_at | dateFilter }}</td>
                    <td>{{ user.bio }}</td>
                    <td>
                        <a href="" class="btn btn-primary">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="" class="btn btn-danger">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog center" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Add New User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <form @submit.prevent="createUser">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" v-model="form.name" name="name"
                                placeholder="Name and Last Name of User..."
                                class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                            <has-error :form="form" field="name"></has-error>
                        </div>
                        <div class="form-group">
                            <input type="email" v-model="form.email" name="email"
                                placeholder="Email Address..."
                                class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                            <has-error :form="form" field="email"></has-error>
                        </div>
                        <div class="form-group">
                            <textarea name="bio" id="bio" cols="30"
                                    rows="10" v-model="form.bio"
                                    placeholder="Short bio of user (Optional)"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('bio') }">
                            </textarea>
                            <has-error :form="form" field="bio"></has-error>
                        </div>
                        <div class="form-group">
                            <select name="user_type" v-model="form.user_type"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('user_type') }"
                                    id="user_type">
                                <option value="">Select User Role</option>
                                <option value="administrator">Administrator</option>
                                <option value="user">User</option>
                                <option value="author">Author</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input v-model="form.password" type="password" name="password" id="password"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('password') }"
                            placeholder="Enter Your Strong Password">
                            <has-error :form="form" field="password"></has-error>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close <i class="fas fa-times"></i></button>
                        <button type="submit" class="btn btn-success">Create User <i class="fas fa-plus"></i> </button>
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
                users: {},
                form: new Form({
                    name: '',
                    email: '',
                    password: '',
                    user_type: '',
                    bio: '',
                    photo: ''
                })
            }
        },
        methods: {
            loadUsers() {
                axios.get("api/user").then(({ data }) => (this.users = data.data));
            },
            createUser() {
                this.form.post('api/user');
            }
        },
        created() {
            this.loadUsers();
        }
    }
</script>
