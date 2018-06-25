<template>
<div class="users">
    <div class="loading" v-if="loading">
        Loading...
    </div>
    <button @click="addData">Ajouter user</button>
    <button @click="updateData">Modifier user</button>
    <button @click="deleteData">Supprimer user</button>

    <div v-if="error" class="error">
        <p>{{ error }}</p>

        <p>
            <button @click.prevent="fetchData">
            Try Again
        </button>
        </p>
    </div>

    <ul v-if="users">
        <li v-for="{ name, email } in users" :key="email">
            <strong>Name:</strong> {{ name }},
            <strong>Email:</strong> {{ email }}
        </li>
    </ul>
</div>
</template>

<script>
import axios from "axios";
export default {
    data() {
        return {
            loading: false,
            users: null,
            error: null,
            user: {
                name: 'Célia',
                email: 'lilerel@gmail.com',
            }
        };
    },
    created() {
        this.fetchData();
    },
    methods: {
        fetchData() {
            this.error = this.users = null;
            this.loading = true;
            axios
                .get("/api/users")
                .then(response => {
                    this.loading = false;
                    this.users = response.data;
                })
                .catch(error => {
                    this.loading = false;
                    this.error = error.response.data.message || error.message;
                });
        },
        addData() {
            this.error = this.users = null;
            this.loading = true;
          
            axios.post('/api/users', {
                    name: 'John',
                    email: 'john@email.com',
                    password: 'ratatouille'
                })
                .then(function (response) {
                    this.loading = false;
                    console.log(response);
                })
                .catch(function (error) {
                    this.loading = false;
                    console.log(error);
                });
        },
        updateData() {
            this.error = this.users = null;
            this.loading = true;
          
            axios.put('/api/users/4', {
                    name: 'Kevin',
                    // email: 'brigitte@email.com',
                    // password: 'bloub'
                })
                .then(function (response) {
                    this.loading = false;
                    console.log(response);
                })
                .catch(function (error) {
                    this.loading = false;
                    console.log(error);
                });
        },
        deleteData() {
            this.error = this.users = null;
            this.loading = true;
            self = this;
          
            axios.delete('/api/users/4')
                .then(function (response) {
                    self.loading = false;
                    console.log(response);
                })
                .catch(function (error) {
                    self.loading = false;
                    console.log(error);
                });
        },

    }
};
</script>
