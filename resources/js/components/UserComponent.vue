<template>
    <div class="container py-5">
        <div class="col-md-12">
            <div class="card" style="background: rgb(2,0,36);
            background: radial-gradient(circle,rgba(213,133,255,1) 0%, rgba(0,212,255,1) 100%);">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h2 class="card-title">Users list</h2>
                        <button class="btn btn-icon btn-round btn-secondary ml-auto" data-bs-toggle="modal"
                            data-bs-target="#modalUser" @click="openCreateModal">
                            <i class="fas fa-user-plus"></i>
                        </button>

                        <div class="modal fade" id="modalUser" tabindex="-1" aria-labelledby="modalUserLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content"
                                    style="background: rgb(94,230,232);
                                    background: radial-gradient(circle, rgba(94,230,232,1) 0%, rgba(236,212,158,1) 84%, rgba(196,192,192,1) 100%);">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="modalUserLabel">{{ title }}</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">

                                        <form>
                                            <div class="form-outline form-black mb-4" align="center">
                                                <label class="form-label" for="name">Name</label>

                                                <input type="text" id="name" name="name" v-model="userData.name"
                                                    class="form-control form-control-lg" />
                                            </div>

                                            <div class="form-outline form-black mb-4" align="center">
                                                <label class="form-label" for="email">Email</label>

                                                <input type="email" id="email" name="email" v-model="userData.email"
                                                    class="form-control form-control-leg" />
                                            </div>

                                            <div class="form-outline form-white mb-4" align="center">
                                                <label class="form-label" for="password">Password</label>

                                                <input type="password" id="password" name="password"
                                                    v-model="userData.password" class="form-control form-control-lg" />
                                            </div>
                                        </form>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger"
                                            data-bs-dismiss="modal">Cancel</button>
                                        <button type="button" class="btn btn-primary" @click.prevent="createUser"
                                            v-if="createBtn">Save user</button>
                                        <button type="button" class="btn btn-primary" @click.prevent="editUser"
                                            v-if="editBtn">Edit user</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="users-table" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Creation date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="user in users">
                                    <td>{{ user.name }}</td>
                                    <td>{{ user.email }}</td>
                                    <td>{{ dateFormat(user.created_at) }}</td>
                                    <td>
                                        <div v-if="user.id != 1">
                                            <button type="button" class="btn btn-icon btn-round btn-warning"
                                                style="margin-right: 10px;" @click="openEditModal(user)">
                                                <i class="fas fa-pencil-alt"></i>
                                            </button>
                                            <button type="button" class="btn btn-icon btn-round btn-danger"
                                                @click="deleteUser(user)">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>



<script>
import axios from 'axios';
import moment from 'moment';
import swal from 'sweetalert';
import datatable from 'datatables.net-bs4';

export default {
    mounted() {
        this.getUsers();
    },
    data() {
        return {
            users: [],
            userData: { name: '', email: '', password: '' },
            title: '',
            createBtn: false,
            editBtn: false,
            userId: ''
        }
    },
    methods: {
        table() {
            this.$nextTick(() => {
                $('#users-table').DataTable();
            });
        },
        dateFormat(date) {
            return moment(date).format('LL');
        },
        openCreateModal() {
            this.userData = { name: '', email: '', password: '' }
            this.title = 'Create new user';
            this.createBtn = true;
            this.editBtn = false;
        },
        openEditModal(user) {
            this.userData = { name: user.name, email: user.email }
            this.title = 'Edit user';
            this.createBtn = false;
            this.editBtn = true;
            this.userId = user.id;
            $('#modalUser').modal('show');
        },
        getUsers() {
            axios.get('users').then(response => {
                this.users = response.data;
                $('#users-table').datatable().destroy();
                this.table();
            });
        },
        createUser() {
            axios.post('user_create', this.userData).then(response => {
                this.userData = { name: '', email: '', password: '' }
                swal('Success!', 'New user created, no cap.', 'success');
                $('#modalUser').modal('hide');
                this.getUsers();
            }).catch(function (error) {
                let array = Object.values(error.response.data.errors);
                array.forEach(error => swal('Error!', error.toString(), 'error'));
            });
        },
        editUser() {
            axios.put('user_edit/' + this.userId, this.userData).then(response => {
                if (response.data != '') {
                    swal('Error!', 'Impossible to edit the logged user.', 'error');
                } else {
                    swal('Success!', 'User edited perfectly.', 'success');
                }
                $('#modalUser').modal('hide');
                this.getUsers();
            }).catch(function (error) {
                let array = Object.values(error.response.data.errors);
                array.forEach(error => swal('Error!', error.toString(), 'error'));
            });
        },
        deleteUser(user) {
            swal({
                title: "Are you sure?, You are about to delete!",
                text: "It will not be able to recover user!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        axios.delete('user_delete/' + user.id).then(response => {
                            if (response.data != '') {
                                swal('Error!', 'Impossible to delete the logged user.', 'error');
                            } else {
                                swal('Success!', 'User  deleted permanently.', 'success');
                            }
                            this.getUsers();
                        }).catch(function (error) {
                            let array = Object.values(error.response.data.errors);
                            array.forEach(error => swal('Error!', error.toString(), 'error'));
                        });
                    }
                });
        }
    },
}
</script>
