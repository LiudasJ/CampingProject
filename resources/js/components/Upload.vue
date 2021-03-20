<template>  
    <div>
        <form action="POST" @submit.prevent="upload()" enctype="multipart/form-data">
            <div class="upload-controls flex vertical-align font-sm">
                <label class="choose-file text-white main-bg-color flex centering">
                    <span>Import</span>
                    <input ref="myImg" v-on:change="onChange()" v-bind:id="campId" class="btn file-upload-btn" type="file" name="image">
                </label>
                <span class="text-white img-span" v-if="image">{{image.name}}</span>
                <button class="upload-btn font-sm" v-if="image" type="submit">Upload</button>
            </div>
        </form>
    </div>
</template>
<script>
export default {
    data: function () {
        return {
            campId: this.camping.id,
            image: null,
            success: null
        }
    },
    props: ['camping'],
    methods: {
        onChange() {
            this.image = this.$refs.myImg.files[0];
        },
        upload () {
            const formData = new FormData();
            formData.set('image', this.image);
            formData.set('id', this.campId);
            axios.post('/image/upload', formData)
            .then(response => {
                if (response.status === 200) {
                    this.$emit('imageChanged');
                    this.image = null;
                }
            })
        }
    }
}
</script>