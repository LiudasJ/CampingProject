<template>
    <div class="login-container relative">
        <div class="login-form flex flex-col centering">
            <h2 class="text-center">Registration Form</h2>
            <div class="flex flex-col centering">
                <div class="form-element flex flex-col relative centering">
                    <label>Username</label>
                    <input
                        v-bind:class="{ danger : errors.username }" 
                        v-model="user.username" 
                        type="text"
                        name ="username"
                        placeholder="Username">
                    <span class="error-span absolute text-danger" v-if="errors.username">{{errors.username.toString()}}</span>
                </div>
                <div class="form-element flex flex-col relative centering">
                    <label>Email</label>
                    <input
                        v-bind:class="{ danger : errors.email }" 
                        v-model="user.email" 
                        type="text"
                        name ="email"
                        placeholder="Email">
                        <span class="error-span absolute text-danger" v-if="errors.email">{{errors.email.toString()}}</span>
                </div>
                <div class="form-element flex flex-col relative centering">
                    <label>Password</label>
                    <input
                        v-bind:class="{ danger : errors.password }" 
                        v-model="user.password" 
                        type="password"
                        name="password"
                        placeholder="Password">
                    <span class="error-span absolute text-danger" v-if="errors.password">{{errors.password.toString()}}</span>
                </div>           
            </div>
            <div class="login-routes flex flex-col centering">
                <button class="login-btn mb-20 pointer" @click="register()" type="submit">Register</button>
                <div>
                    <span>Have an account?</span>&nbsp;<a class="main-text-color" href="/login">Login</a>
                </div>
                <div>
                    <span class="guest-span main-text-color"><a href="/">Visit as guest</a></span>
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
                    email: '',
                    password: ''
                },
                errors: []
            }
        },
        methods: {
            register() {
                axios.post('/register', {
                    username: this.user.username,
                    email: this.user.email,
                    password: this.user.password,
                })
                .then( response => {
                    if (response.status === 200) {
                        localStorage.setItem('access_token', response.data.access_token);
                        window.location.replace('/');
                    }
                })
                .catch(e => {
                    if (e.response.status === 422) {
                        this.errors = e.response.data.errors
                    }
                })
            }
        }
    }
</script>