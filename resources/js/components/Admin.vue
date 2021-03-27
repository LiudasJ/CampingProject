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
                    <li @click="all">All Campings</li>
                    <li @click="latest">Latest Campings</li>
                    <li @click="top">Top Rated Campings</li>
                    <li><a href="/admin/add">Create New Camping</a></li>
                    <li>Import CSV</li>
                </ul>
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
                        <li><span class="main-text-color">Review:</span> {{camping.average_review}}</li>
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
                            <a v-bind:href="'/admin/edit/' + camping.id"><i class="fas fa-edit"></i></a>
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
    data: function () {
        return {
            campings: [],
            method: ''
        }
    },
    methods: {
        all() {
            axios.get('/admin/all')
            .then(response => {
                if (response.status === 200) {
                    this.campings = response.data.campings;
                    this.method = 'all';
                }
            })
            .catch(e => {
                console.log(e);
            })
        },
        latest() {
            axios.get('/admin/latest')
            .then(response => {
                if (response.status === 200) {
                    this.campings = response.data.campings.data;
                    this.method = 'latest';
                }
            })
            .catch(e => {
                console.log(e);
            })
        },
        top() {
            axios.get('/admin/top')
            .then(response => {
                if (response.status === 200) {
                    this.campings = response.data.campings;
                    this.method = 'top';
                }
            })
            .catch(e => {
                console.log(e);
            })
        },
        remove(id) {
            axios.post('/admin/delete/' + id)
            .then(response => {
                if (response.status === 200) {
                    this.result = response.data.result;
                    this.refresh(this.method);
                }
            })
            .catch(e => {
                console.log(e);
            })
        },
        refresh(method) {
            switch (method) {
                case 'all':
                    this.all();
                    break;
            }
        }
    },
    created() {
        axios.defaults.headers.common['Authorization'] = "Bearer " + localStorage.getItem('access_token');
    }
}
</script>
     
    