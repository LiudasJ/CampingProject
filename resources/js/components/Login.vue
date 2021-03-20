<template>
    <div class="login-container relative">
        <div class="login-form absolute-center shadow">
            <h2 class="text-center">Please Login</h2>
            <div class="flex flex-col centering">
                <div class="form-element flex flex-col relative centering">
                    <label>Username</label>
                    <input
                        v-bind:class="{ danger : errors.username }" 
                        v-model="user.username" 
                        class ="fname" 
                        type ="text" 
                        name ="username" 
                        placeholder ="Username">
                    <span class="error-span absolute text-danger" v-if="errors.username">{{errors.username.toString()}}</span>
                </div>
                <div class="form-element flex flex-col relative centering">
                    <label>Password</label>
                    <input
                        v-bind:class="{ danger : errors.password }" 
                        v-model ="user.password" 
                        type ="password" 
                        name ="password" 
                        placeholder ="Password">
                    <span class="error-span absolute text-danger" v-if="errors.password">{{errors.password.toString()}}</span>
                    <span v-if="invalidCred" class="error-span absolute text-danger">{{invalidCred}}</span>
                </div>           
            </div>
            <div class="login-routes flex flex-col centering">
                <button class="login-btn mb-20 pointer" @click="login()" type="submit">Log in</button>
                <div v-if="!auth">
                    <span>Don't have an account?</span>&nbsp;<a class="main-text-color" href="#/register">Register</a>
                </div>
                <div>
                    <span @click="guest()" class="guest-span main-text-color"> {{auth ? 'Go to page' : 'Visit as Guest' }} </span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['auth'],
        data: function () {
            return {
                user: {
                    username: '',
                    password: ''
                },
                errors: [],
                invalidCred: ''
            }
        },
        methods: {
            login() {
                axios.post('/login', {
                    username: this.user.username,
                    password: this.user.password
                })
                .then( response => {
                    if (response.status === 200) {
                        console.log('logged in')
                    }
                })
                .catch(e => {
                    if (e.response.status === 422) {
                        this.errors = e.response.data.errors
                    } else if (e.response.status === 404) {
                        this.invalidCred = 'Invalid credentials';
                    }
                })
            },
            guest() {
                this.$router.push({ path : '/campings' });     
            }
        },
        mounted() {
        }
    }
</script>