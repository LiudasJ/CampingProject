<template>
    <div class="form-container flex flex-col centering space-around" action="POST">
        <h2 class="main-text-color">{{edit ? "Edit Camping" : "Create New Camping"}}</h2>
        <div class="form-wrapper flex mt-20 centering">
            <div class="form-chunk flex flex-col centering flex-start">
                <div class="form-element flex flex-col relative centering">
                    <span class="w-100 main-text-color">Camping Name:</span>
                    <input v-bind:class="{ danger : errors.name }"  type="text" v-model="camping.name" name="name" placeholder="Camping name">
                    <span class="error-span absolute text-danger" v-if="errors.name">{{errors.name.toString()}}</span>
                </div>
                <div class="form-element flex flex-col relative centering">
                    <span class="w-100 main-text-color">Country:</span>
                    <input v-bind:class="{ danger : errors.country }" type="text" name="country" v-model="camping.country" placeholder="Country">
                    <span class="error-span absolute text-danger" v-if="errors.country">{{errors.country.toString()}}</span>
                </div>
                <div class="form-element flex flex-col relative centering">
                    <span class="w-100 main-text-color">Tags:</span>
                    <select v-model="campingTags" name="tags" multiple>
                        <option 
                            v-for="tag in alltags" :key="tag.id" 
                            v-bind:value="tag.id"
                            :selected="campingTags.includes(tag.id) ? true: false">
                            {{tag.name}}
                        </option>
                    </select>
                </div>
            </div>
            <div class="form-chunk flex flex-col centering flex-start">
                <div class="form-element flex flex-col relative centering">
                    <span class="w-100 main-text-color">City:</span>
                    <input v-bind:class="{ danger : errors.city }" type="text" name="city" v-model="camping.city" placeholder="City">
                    <span class="error-span absolute text-danger" v-if="errors.city">{{errors.city.toString()}}</span>
                </div>
                <div class="form-element flex flex-col relative centering">
                    <span class="w-100 main-text-color">Website:</span>
                    <input v-bind:class="{ danger : errors.website }" type="text" name="website" v-model="camping.website" placeholder="Website">
                    <span class="error-span absolute text-danger" v-if="errors.website">{{errors.website.toString()}}</span>
                </div>
                <div class="form-element flex flex-col relative centering">
                    <span class="w-100 main-text-color">Rating:</span>
                    <input v-bind:class="{ danger : errors.rating }" type="text" name="rating" v-model="camping.rating" placeholder="Rating">
                    <span class="error-span absolute text-danger" v-if="errors.rating">{{errors.rating.toString()}}</span>
                </div>
            </div>
        </div>
        <button v-if="!edit" @click="add()" class="form-submit-btn">Create</button>
        <button v-if="edit" @click="update()" class="form-submit-btn">Update</button>
        <input type="hidden" name="_token" :value="csrf">
        <slot></slot>
    </div>
</template>
<script>

export default {
    data: function () {
        return {
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            camping: {
                id: '', 
                name: '',
                country: '',
                city: '',
                website:  '',
                rating: '',
                review: '',
            },
            campingTags: [],
            imgPath: '../images/camping.jpg',
            alltags: [],
            edit: null,
            errors: []
        }
    },
    methods: {
        add() {
            this.$store.dispatch('addCamping', {
                name: this.camping.name,
                country: this.camping.country,
                city: this.camping.city,
                website: this.camping.website,
                rating: this.camping.rating,
                tags: this.campingTags,
                image: this.imgPath
            })
            .then( () => {
                this.$router.push({ path : '/campings' })
            })
            .catch(e => {
                if (e.response.status === 422) {
                    this.errors = e.response.data.errors
                }
            })
        },
        update() {
            axios.put('/campings/' + this.camping.id + '/update', {
                name: this.camping.name,
                country: this.camping.country,
                city: this.camping.city,
                website: this.camping.website,
                review: this.camping.review,
                rating: this.camping.rating,
                tags: this.campingTags
            })
            .then(response => {
                if (response.status === 200) {
                    this.$router.push({ path : '/campings' })
                }
            })
            .catch(e => {
                if (e.response.status === 422) {
                    this.errors = e.response.data.errors;
                }
            })
        },
        fetchTags() {
            axios.get('/tags/all')
            .then (response => {
                if (response.status === 200) {
                    console.log(response.data);
                    this.alltags = response.data
                }
            })
            .catch(error => {
                console.log(error);

            })
        },
        setRouterParams() {
            if (Object.keys(this.$route.params).length > 0) {
                this.camping = this.$route.params.camping;
                this.$route.params.tags.forEach(tag=>{
                    this.campingTags.push(tag.id);
                });
                this.edit = this.$route.params.edit;
            }
        }
    },
    created() {
      this.setRouterParams(); 
      this.fetchTags();
    }
};
</script>