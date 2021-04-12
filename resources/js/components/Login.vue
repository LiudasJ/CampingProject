<template>
    <div class="login-container relative">
        <div class="login-form flex flex-col centering">
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
                        placeholder ="Username"
                        required>
                    <span class="error-span absolute text-danger" v-if="errors.username">{{errors.username.toString()}}</span>
                </div>
                <div class="form-element flex flex-col relative centering">
                    <label>Password</label>
                    <input
                        v-bind:class="{ danger : errors.password }" 
                        v-model ="user.password" 
                        type ="password" 
                        name ="password" 
                        placeholder ="Password"
                        required>
                    <span class="error-span absolute text-danger" v-if="errors.password">{{errors.password.toString()}}</span>
                    <span v-if="invalidCred" class="error-span absolute text-danger">{{invalidCred}}</span>
                    <span v-if="test" class="error-span absolute text-danger">{{invalidCred}}</span>
                </div>           
            </div>
            <div class="login-routes flex flex-col centering">
                <button class="login-btn mb-20 pointer" @click="login()" type="submit">Log in</button>
                <div>
                    <span>Don't have an account?</span>&nbsp;<a class="main-text-color" href="/register">Register</a>
                </div>
                <div>
                    <span class="guest-span main-text-color"><a href="/">Continue as Guest</a></span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                user: {
                    username: '',
                    password: ''
                },
                errors: [],
                invalidCred: '',
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
                        localStorage.setItem('access_token', response.data.access_token);
                        window.location.replace('/');
                    }
                })
                .catch(e => {
                    this.errors = [];
                    if (e.response.status === 422) {
                        this.errors = e.response.data.errors
                    } else if (e.response.status === 404) {
                        this.invalidCred = e.response.data.denied;
                    }
                })
            }
        },
        mounted() {
        }
    }
</script>