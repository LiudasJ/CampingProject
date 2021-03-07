<template>
    <div class="admin-nav-container flex centering space-around flex-start mt-20 mb-20 relative">
        <div v-if="auth" class="create-btn">
            <a class="btn" href="#/new">Create New</a>
        </div>
        <div v-if="auth" class="import-form flex space-between vertical-align">
            <form action="" class="flex" @submit.prevent="importfile()" method="POST" enctype="multipart/form-data">
                <label class="choose-file text-white main-bg-color flex centering">
                    <span>Import</span>
                    <input ref="myFile" v-on:change="onChange()" class="btn file-upload-btn" type="file" name="image">
                </label>
                <span class="flex vertical-align" style="margin-left: 5px" v-if="success">{{success}}</span>
            </form>
            <span v-if="file" class="main-text-color img-span">{{file.name}}</span>
            <button v-if="file" @click="importFile()" class="upload-btn" type="submit">Upload</button>
        </div>
        <div>
            <div class="log-btn" v-if="auth" @click="logout()">Log out</div>
            <div class="log-btn" v-if="!auth"><a class="main-text-color" href="/">Log in</a></div>
        </div>
    </div>
</template>

<script>

export default {
    props: ['auth'],
    data: function () {
        return {
            file: '',
            success: ''
        }
    },
    methods: {
        logout() {
            this.$router.push({ path : '/' }); 
            this.$store.dispatch('logout')
        },
        onChange() {
            this.file = this.$refs.myFile.files[0];
        },
        importFile () {
            const formData = new FormData();
            formData.set('file', this.file);
            axios.post('/file/import', formData)
            .then(response => {
                if (response.status === 200) {
                    this.file = null;
                    this.success = 'success';
                }
            })
        }
    }   
}
</script>