<template>
    <div class="admin-panel-container flex">
        <div class="admin-panel-nav">
            <div>
                <div class="adm-img-wrapper flex centering mb-20">
                    <div class="adm-img-container flex centering">
                        <i class="fas fa-user adm-img"></i>
                    </div> 
                </div>
                <ul class="adm-nav-ul">
                    <li><a href="/admin/all">All Campings</a></li>
                    <li><a href="/admin/latest">Latest Campings</a></li>
                    <li><a href="/admin/top">Top Rated Campings</a></li>
                    <li><a href="/admin/add" class="alt-text-color">Create New Camping</a></li>
                    <li><a href="/admin/photos" class="alt-text-color">Add more Photos</a></li>
                    <li><a href="/admin/export" class="alt-text-color">Export</a></li>
                </ul>
                <div class="import-container mt-20">
                    <form action="POST" @submit.prevent="upload()" enctype="multipart/form-data">
                        <div>Import CSV</div>
                        <input ref="csvFile" v-on:change="onChange()" type="file" name="image">
                        <button class="upload-btn font-sm" v-if="file" type="submit">Upload</button>
                    </form>
                </div>
            </div>
        </div>
        <div v-if="campings" class="admin-panel-view">
            <div class="flex centering wrap">
                <div class="admin-record-container font-sm relative" v-for="camping in campings" :key="camping.id">
                    <div class="adm-img-wrapper flex centering mb-20 mt-20">
                        <div class="adm-img-container flex centering">
                            <i class="fas fa-campground adm-img"></i>
                        </div> 
                    </div>
                    <ul>
                        <li><span class="main-text-color">Camp id:</span> {{camping.id}}</li>
                        <li><span class="main-text-color">Name:</span> {{camping.name}}</li>
                        <li><span class="main-text-color">City:</span> {{camping.city}}</li>
                        <li><span class="main-text-color">Country:</span> {{camping.country}}</li>
                        <li>
                            <span class="main-text-color">Rating:</span> 
                            <i v-for='index in camping.rating' :key='index' class="fas fa-star"></i>
                        </li>
                        <li><span class="main-text-color">Review:</span> {{parseFloat(camping.average_review).toFixed(1)}}</li>
                    </ul>
                    <span v-if="camping.tags && camping.tags.length > 0">Provided tags:</span>
                    <div v-for="tag in camping.tags" :key="tag.id">
                        <i v-if="tag.name === 'Pool'" class="fas fa-swimmer"></i>
                        <i v-if="tag.name === 'Wifi'" class="fas fa-wifi"></i>
                        <i v-if="tag.name === 'Parking'" class="fas fa-parking"></i>
                        <span class="tag-name">{{tag.name}}</span>
                    </div>
                    <div class="crud-btns-container flex absolute">
                        <div class="crud-btn">
                            <a v-bind:href="'/admin/edit/'+ action + '/' + camping.id"><i class="fas fa-edit"></i></a>
                        </div>
                        <div class="crud-btn">
                            <i @click="remove(camping.id)" class="fas fa-trash"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    props: ['initdata', 'action'],
    data: function () {
        return {
            campings: this.initdata,
            method: '',
            file: ''
        }
    },
    methods: {
        remove(id) {
            axios.post('/admin/delete/' + id)
            .then(response => {
                if (response.status === 200) {
                    window.location.replace('/admin/' + this.action);
                }
            })
            .catch(e => {
                console.log(e);
            })
        },
        upload () {
            const formData = new FormData();
            formData.set('file', this.file);
            axios.post('/admin/import', formData)
            .then(response => {
                if (response.status === 200) {
                    this.file = null;
                }
            })
        },
        onChange() {
            this.file = this.$refs.csvFile.files[0];
        }
    },
    created() {
        axios.defaults.headers.common['Authorization'] = "Bearer " + localStorage.getItem('access_token');
    }
}
</script>
     
    